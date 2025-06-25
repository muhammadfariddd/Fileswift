<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use CloudConvert\CloudConvert;
use CloudConvert\Models\Job;
use CloudConvert\Models\Task;
use Illuminate\Support\Facades\Validator;

class ConvertController extends Controller
{
    /**
     * Tampilkan halaman kategori konversi.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('convert.index');
    }

    /**
     * Proses konversi file yang diunggah.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $type
     * @return \Illuminate\Http\RedirectResponse
     */
    public function convert(Request $request)
    {
        Log::info('ConvertController@convert called', [
            'ajax' => $request->ajax(),
            'wantsJson' => $request->wantsJson(),
            'hasFile' => $request->hasFile('file'),
            'toFormat' => $request->input('to_format'),
            'debug' => $request->input('debug'),
            'method' => $request->method(),
            'url' => $request->url()
        ]);

        try {
            $validator = Validator::make($request->all(), [
                'file' => 'required|file|max:51200', // max 50MB
                'to_format' => 'required|string',
            ]);
            if ($validator->fails()) {
                $msg = $validator->errors()->first('file') ?: 'Format file tidak didukung atau ukuran file terlalu besar (maksimal 50MB).';
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['error' => $msg], 422);
                }
                return back()->withErrors($validator)->withInput();
            }

            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $fromExt = strtolower($file->getClientOriginalExtension());
            $toFormat = strtolower($request->input('to_format'));

            // Buat nama file output dengan ekstensi yang benar
            $originalNameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);
            $filename = Str::random(16) . '.' . $toFormat;
            $outputPath = storage_path('app/public/converted');
            if (!file_exists($outputPath)) {
                mkdir($outputPath, 0777, true);
            }
            $outputFile = $outputPath . '/' . $filename;

            // Daftar konversi yang HARUS pakai CloudConvert
            $cloudconvert_required = [
                ['from' => 'doc', 'to' => ['pdf', 'txt', 'jpg', 'png']],
                ['from' => 'docx', 'to' => ['pdf', 'txt', 'jpg', 'png']],
                ['from' => 'pdf', 'to' => ['jpg', 'png', 'docx']],
                // Gambar ke PDF tidak perlu CloudConvert, bisa pakai lokal
            ];
            $useCloudConvert = false;
            foreach ($cloudconvert_required as $rule) {
                if ($fromExt === $rule['from'] && in_array($toFormat, $rule['to'])) {
                    $useCloudConvert = true;
                    break;
                }
            }

            if ($useCloudConvert) {
                $this->handleCloudConvertConversion($file, $outputFile, $originalName, $fromExt, $toFormat, $request);
            } else {
                $this->handleLocalConversion($file, $outputFile, $fromExt, $toFormat, $request);
            }

            // Simpan info ke session dan redirect ke result
            $resultUrl = route('convert.result', [
                'id' => $filename,
                'original' => urlencode($originalNameWithoutExt . '.' . $toFormat),
                'format' => $toFormat
            ]);

            Log::info('ConvertController@convert redirecting', [
                'resultUrl' => $resultUrl,
                'filename' => $filename,
                'originalName' => $originalName,
                'toFormat' => $toFormat,
                'isAjax' => $request->ajax() || $request->wantsJson()
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['redirect' => $resultUrl]);
            }
            return redirect($resultUrl);
        } catch (\Exception $e) {
            // Friendly error message for user
            $errorMsg = 'Terjadi kesalahan saat konversi. '; // default
            if (stripos($e->getMessage(), 'cloudconvert') !== false) {
                $errorMsg = 'Penggunaan Fitur ini telah mencapai batas. Silahkan coba lagi nanti.';
            } elseif (stripos($e->getMessage(), 'file') !== false) {
                $errorMsg = 'File tidak valid atau format tidak didukung.';
            }
            if ($request->ajax() || $request->wantsJson() || $request->isJson()) {
                return response()->json(['error' => $errorMsg], 429);
            }
            return back()->with('error', $errorMsg);
        }
    }

    /**
     * Tampilkan halaman hasil konversi.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function result($id)
    {
        $outputFile = storage_path('app/public/converted/' . $id);
        if (!file_exists($outputFile)) {
            abort(404, 'File tidak ditemukan');
        }
        $originalName = request('original', $id);
        $toFormat = request('format', '');
        $downloadUrl = route('convert.download', ['id' => $id]);

        // Pastikan nama file final menggunakan ekstensi yang benar
        if (!empty($toFormat) && !str_ends_with($originalName, '.' . $toFormat)) {
            $originalName = pathinfo($originalName, PATHINFO_FILENAME) . '.' . $toFormat;
        }

        $finalName = 'converted-' . $originalName;
        return view('convert.result', compact('finalName', 'downloadUrl', 'toFormat'));
    }

    /**
     * Download converted file.
     *
     * @param  string  $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($id)
    {
        $outputFile = storage_path('app/public/converted/' . $id);
        if (!file_exists($outputFile)) {
            abort(404, 'File tidak ditemukan');
        }

        $finalName = request('name', $id);
        $toFormat = request('format', '');

        // Pastikan nama file download menggunakan ekstensi yang benar
        if (!empty($toFormat) && !str_ends_with($finalName, '.' . $toFormat)) {
            $finalName = pathinfo($finalName, PATHINFO_FILENAME) . '.' . $toFormat;
        }

        return response()->download($outputFile, $finalName)->deleteFileAfterSend(false);
    }

    private function handleCloudConvertConversion($file, $outputFile, $originalName, $fromExt, $toFormat, $request)
    {
        try {
            $apiKey = $_ENV['CLOUDCONVERT_API_KEY'] ?? env('CLOUDCONVERT_API_KEY');
            Log::info('CloudConvert API Key check', [
                'apiKey' => $apiKey ? 'set' : 'not set',
                'apiKeyLength' => $apiKey ? strlen($apiKey) : 0,
                'envValue' => $_ENV['CLOUDCONVERT_API_KEY'] ?? 'not found',
                'envFunction' => env('CLOUDCONVERT_API_KEY') ? 'found' : 'not found'
            ]);

            if (empty($apiKey)) {
                Log::error('CloudConvert API Key not set');
                Log::info('Falling back to local conversion for non-image files');

                // Fallback ke konversi lokal untuk format tertentu
                if ($fromExt === 'txt' && $toFormat === 'pdf') {
                    $this->handleLocalConversion($file, $outputFile, $fromExt, $toFormat, $request);
                    return; // Exit method after successful local conversion
                } else {
                    throw new \Exception('CloudConvert API Key belum disetel.');
                }
            }

            Log::info('Using CloudConvert for conversion', ['from' => $fromExt, 'to' => $toFormat]);

            $cloudConvert = new CloudConvert(['api_key' => $apiKey]);
            $tempPath = $file->store('temp_uploads', 'local');
            $fullTempPath = Storage::disk('local')->path($tempPath);

            $job = (new Job())
                ->addTask(
                    (new Task('import/upload', 'upload-my-file'))
                )
                ->addTask(
                    (new Task('convert', 'convert-my-file'))
                        ->set('input', 'upload-my-file')
                        ->set('output_format', $toFormat)
                )
                ->addTask(
                    (new Task('export/url', 'export-my-file'))
                        ->set('input', 'convert-my-file')
                );

            $job = $cloudConvert->jobs()->create($job);
            $uploadTask = $job->getTasks()->whereName('upload-my-file')[0];
            $cloudConvert->tasks()->upload($uploadTask, fopen($fullTempPath, 'r'), $originalName);
            $job = $cloudConvert->jobs()->wait($job);
            $fileTask = $job->getExportUrls()[0];
            $source = $cloudConvert->getHttpTransport()->download($fileTask->url)->getContents();
            file_put_contents($outputFile, $source);
            Storage::disk('local')->delete($tempPath);

            Log::info('CloudConvert conversion successful', ['outputFile' => $outputFile]);
        } catch (\Exception $e) {
            Log::error('CloudConvert Error: ' . $e->getMessage(), [
                'from' => $fromExt,
                'to' => $toFormat,
                'trace' => $e->getTraceAsString()
            ]);

            // Cek apakah error karena limit kredit
            if (
                strpos($e->getMessage(), 'conversion credits') !== false ||
                strpos($e->getMessage(), 'payment required') !== false ||
                strpos($e->getMessage(), 'quota exceeded') !== false
            ) {
                throw new \Exception('Akun CloudConvert sudah habis kredit konversi. Silakan upgrade akun atau gunakan format yang didukung secara lokal.');
            }

            // Coba fallback ke konversi lokal jika memungkinkan
            if ($fromExt === 'txt' && $toFormat === 'pdf') {
                Log::info('Falling back to local conversion for txt to pdf');
                $this->handleLocalConversion($file, $outputFile, $fromExt, $toFormat, $request);
                return;
            }

            throw new \Exception('Konversi gagal: ' . $e->getMessage());
        }
    }

    private function handleLocalConversion($file, $outputFile, $fromExt, $toFormat, $request)
    {
        try {
            Log::info('Using local conversion', ['from' => $fromExt, 'to' => $toFormat]);

            if ($fromExt === 'txt' && $toFormat === 'pdf') {
                $text = file_get_contents($file->getRealPath());
                $pdf = new \TCPDF();
                $pdf->AddPage();
                $pdf->SetFont('dejavusans', '', 10);
                $pdf->Write(0, $text);
                $pdf->Output($outputFile, 'F');
            } elseif (in_array($fromExt, ['jpg', 'jpeg', 'png', 'webp', 'bmp', 'gif']) && $toFormat === 'pdf') {
                // Konversi gambar ke PDF menggunakan TCPDF
                try {
                    Log::info('Mulai konversi gambar ke PDF', [
                        'file' => $file->getClientOriginalName(),
                        'realPath' => $file->getRealPath(),
                        'fromExt' => $fromExt,
                        'toFormat' => $toFormat
                    ]);
                    $pdf = new \TCPDF();
                    $pdf->AddPage();
                    $pdf->SetFont('dejavusans', '', 10);

                    // Baca file gambar
                    $imagePath = $file->getRealPath();
                    if (!file_exists($imagePath)) {
                        throw new \Exception('File gambar tidak ditemukan');
                    }

                    // Cek apakah file gambar valid
                    $imageInfo = @getimagesize($imagePath);
                    if ($imageInfo === false) {
                        throw new \Exception('File bukan gambar yang valid atau rusak');
                    }

                    // Hitung ukuran gambar untuk PDF (maksimal 190mm lebar)
                    $maxWidth = 190;
                    $maxHeight = 250;
                    $imgWidth = $imageInfo[0];
                    $imgHeight = $imageInfo[1];

                    // Hitung rasio aspek
                    $ratio = min($maxWidth / $imgWidth, $maxHeight / $imgHeight);
                    $newWidth = $imgWidth * $ratio;
                    $newHeight = $imgHeight * $ratio;

                    // Tambahkan gambar ke PDF
                    $pdf->Image($imagePath, 10, 10, $newWidth, $newHeight, '', '', '', false, 300);
                    $pdf->Output($outputFile, 'F');

                    Log::info('Image to PDF conversion successful', [
                        'outputFile' => $outputFile,
                        'originalSize' => $imageInfo,
                        'pdfSize' => [$newWidth, $newHeight]
                    ]);
                } catch (\Throwable $e) {
                    Log::error('Image to PDF conversion failed: ' . $e->getMessage(), [
                        'imagePath' => $file->getRealPath(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    throw new \Exception('Gagal mengkonversi gambar ke PDF: ' . $e->getMessage());
                }
            } elseif (
                in_array($fromExt, ['jpg', 'jpeg', 'png', 'webp', 'bmp', 'gif']) &&
                in_array($toFormat, ['jpg', 'jpeg', 'png', 'webp'])
            ) {
                // Konversi gambar menggunakan Intervention Image
                try {
                    $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
                    $img = $manager->read($file->getRealPath());

                    switch ($toFormat) {
                        case 'jpg':
                        case 'jpeg':
                            $img->toJpeg()->save($outputFile);
                            break;
                        case 'png':
                            $img->toPng()->save($outputFile);
                            break;
                        case 'webp':
                            $img->toWebp()->save($outputFile);
                            break;
                    }

                    Log::info('Image format conversion successful', [
                        'from' => $fromExt,
                        'to' => $toFormat,
                        'outputFile' => $outputFile
                    ]);
                } catch (\Exception $e) {
                    Log::error('Image format conversion failed: ' . $e->getMessage());
                    throw new \Exception('Gagal mengkonversi format gambar: ' . $e->getMessage());
                }
            } else {
                // Jika tidak didukung, throw exception
                $errorMsg = 'Konversi dari ' . $fromExt . ' ke ' . $toFormat . ' belum didukung secara lokal.';
                Log::warning('Unsupported local conversion', ['from' => $fromExt, 'to' => $toFormat]);
                throw new \Exception($errorMsg);
            }

            Log::info('Local conversion successful', ['outputFile' => $outputFile]);

            // Verifikasi file berhasil dibuat
            if (!file_exists($outputFile)) {
                throw new \Exception('File output tidak berhasil dibuat');
            }

            // Verifikasi file tidak kosong
            if (filesize($outputFile) === 0) {
                throw new \Exception('File output kosong');
            }
        } catch (\Exception $e) {
            Log::error('Local Convert Error: ' . $e->getMessage(), [
                'from' => $fromExt,
                'to' => $toFormat,
                'trace' => $e->getTraceAsString()
            ]);
            throw $e; // Re-throw exception agar ditangkap di method utama
        }
    }
}
