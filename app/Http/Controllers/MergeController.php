<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use iio\libmergepdf\Merger;
use Illuminate\Support\Facades\Log;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\PdfParserException;

class MergeController extends Controller
{
    public function index()
    {
        return view('merge.index');
    }

    public function merge(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|max:51200', // max 50MB per file
        ]);

        $files = $request->file('files');
        if (!$files) $files = [];
        if (!is_array($files)) $files = [$files];
        Log::info('MergeController@merge', [
            'files_count' => count($files),
            'files' => array_map(function ($f) {
                return $f ? $f->getClientOriginalName() : null;
            }, $files)
        ]);
        if (count($files) < 2) {
            return back()->with('error', 'Minimal 2 file untuk digabung.');
        }

        $tempPdfPaths = [];
        $unsupportedFiles = [];
        $errorMessages = [];

        try {
            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName();
                $ext = strtolower($file->getClientOriginalExtension());
                $mime = $file->getMimeType();
                $tempPath = $file->store('temp_uploads', 'local');
                $fullTempPath = Storage::disk('local')->path($tempPath);

                if ($ext === 'pdf' && $mime === 'application/pdf') {
                    // Cek apakah PDF terenkripsi
                    $isEncrypted = false;
                    try {
                        $fpdi = new Fpdi();
                        $fpdi->setSourceFile($fullTempPath);
                    } catch (PdfParserException $e) {
                        if (strpos($e->getMessage(), 'encrypted') !== false) {
                            $isEncrypted = true;
                        }
                    }
                    if ($isEncrypted) {
                        $unsupportedFiles[] = $originalName;
                        $errorMessages[] = "File {$originalName}: PDF terenkripsi/password, tidak bisa digabung.";
                        Log::warning("File terenkripsi: {$originalName}");
                        continue;
                    }
                    $tempPdfPaths[] = $fullTempPath;
                } else {
                    $unsupportedFiles[] = $originalName;
                    $errorMessages[] = "File {$originalName}: Hanya file PDF asli yang didukung untuk penggabungan.";
                    Log::warning("File tidak didukung untuk merge: {$originalName} (ext: {$ext}, mime: {$mime})");
                }
            }

            if (count($unsupportedFiles) > 0) {
                $errorMsg = 'Beberapa file tidak dapat diproses karena alasan berikut:<br>';
                foreach ($errorMessages as $error) {
                    $errorMsg .= '• ' . $error . '<br>';
                }
                session()->flash('conversion_failures', $errorMessages);
                return back()->with('error', $errorMsg);
            }

            if (count($tempPdfPaths) < 2) {
                $errorMsg = 'Minimal 2 file PDF valid yang bisa digabung.';
                if (!empty($unsupportedFiles)) {
                    $errorMsg .= '<br>File gagal: ' . implode(', ', $unsupportedFiles);
                }
                if (!empty($tempPdfPaths)) {
                    $errorMsg .= '<br>File valid: ' . implode(', ', array_map(function ($p) {
                        return basename($p);
                    }, $tempPdfPaths));
                }
                return back()->with('error', $errorMsg);
            }

            $merger = new Merger;
            foreach ($tempPdfPaths as $pdfPath) {
                $merger->addFile($pdfPath);
            }

            $outputFilename = 'merged-' . Str::random(10) . '.pdf';
            $outputPath = storage_path('app/public/merged/' . $outputFilename);
            if (!file_exists(dirname($outputPath))) {
                mkdir(dirname($outputPath), 0777, true);
            }

            $createdPdf = $merger->merge();
            file_put_contents($outputPath, $createdPdf);

            $originalFilenames = [];
            foreach ($files as $file) {
                $originalFilenames[] = $file->getClientOriginalName();
            }

            session([
                'merged_filename' => $outputFilename,
                'merged_original_files' => $originalFilenames,
            ]);

            return redirect()->route('merge.result', ['id' => $outputFilename]);
        } catch (\Exception $e) {
            Log::error('Merge Error: ' . $e->getMessage() . '\n' . $e->getTraceAsString());
            return back()->with('error', 'Terjadi kesalahan saat menggabungkan file: ' . $e->getMessage());
        } finally {
            // Hapus seluruh direktori sementara
            Storage::disk('local')->deleteDirectory('temp_uploads');
        }
    }

    public function result($id)
    {
        $outputFile = storage_path('app/public/merged/' . $id);
        if (!file_exists($outputFile)) {
            abort(404, 'File tidak ditemukan');
        }

        $originalFiles = session('merged_original_files', []);
        $downloadUrl = route('merge.download', ['id' => $id]);
        $finalName = $id;

        return view('merge.result', compact('finalName', 'downloadUrl', 'originalFiles'));
    }

    public function download($id)
    {
        $outputFile = storage_path('app/public/merged/' . $id);
        if (!file_exists($outputFile)) {
            abort(404, 'File tidak ditemukan');
        }

        $finalName = 'merged-files.pdf';
        return response()->download($outputFile, $finalName)->deleteFileAfterSend(true);
    }
}
