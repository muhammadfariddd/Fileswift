<?php

// File: app/Http/Controllers/CompressController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\Compression\CompressorFactory; // Pastikan path ini benar

class CompressController extends Controller
{
    protected $compressorFactory;

    // Gunakan dependency injection untuk memasukkan factory kita
    public function __construct(CompressorFactory $compressorFactory)
    {
        $this->compressorFactory = $compressorFactory;
    }

    public function index()
    {
        return view('compress.index');
    }

    public function compress(Request $request)
    {
        // Validasi file. 2GB = 2097152 KB.
        $request->validate([
            'file' => 'required|file|max:2097152',
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $ext = strtolower($file->getClientOriginalExtension());

        // Dapatkan strategi kompresi yang sesuai dari factory
        try {
            $compressor = $this->compressorFactory->getCompressorFor($ext);
        } catch (\Exception $e) {
            // Pesan untuk format yang tidak didukung
            $customMessage = 'Format file tidak didukung. Hanya gambar, PDF, video, audio, dan dokumen teks yang diperbolehkan.';
            return back()->with('error', $customMessage);
        }

        // Siapkan path output
        $filename = Str::random(16) . '.' . $compressor->getOutputExtension($ext);
        $outputPath = storage_path('app/public/compressed');
        if (!file_exists($outputPath)) {
            mkdir($outputPath, 0777, true);
        }
        $outputFile = $outputPath . '/' . $filename;
        $beforeSize = $file->getSize();

        // Lakukan kompresi menggunakan strategi yang dipilih
        try {
            $compressor->compress($file->getRealPath(), $outputFile);
        } catch (\Exception $e) {
            // Pesan error yang lebih ramah pengguna jika proses kompresi gagal
            $customMessage = 'Maaf, terjadi kesalahan saat memproses file Anda. Silakan coba lagi.';
            // Untuk debugging, Anda bisa mencatat error asli ke log: \Log::error($e->getMessage());
            return back()->with('error', $customMessage);
        }

        $afterSize = file_exists($outputFile) ? filesize($outputFile) : 0;

        return redirect()->route('compress.result', ['id' => $filename])->with([
            'compressed_original_name' => $originalName,
            'compressed_before_size' => $beforeSize,
            'compressed_after_size' => $afterSize,
        ]);
    }

    public function result($id)
    {
        $originalName = session()->get('compressed_original_name', 'file');
        $beforeSize = session()->get('compressed_before_size', 0);
        $afterSize = session()->get('compressed_after_size', 0);

        if ($beforeSize === 0 && !session()->has('compressed_original_name')) {
            abort(404, 'File tidak ditemukan atau sesi telah berakhir.');
        }

        $downloadUrl = route('compress.download', ['id' => $id, 'name' => 'compressed-' . $originalName]);
        $finalName = 'compressed-' . $originalName;

        return view('compress.result', compact('finalName', 'downloadUrl', 'beforeSize', 'afterSize'));
    }

    public function download($id)
    {
        $outputFile = storage_path('app/public/compressed/' . $id);
        if (!file_exists($outputFile)) {
            abort(404, 'File tidak ditemukan.');
        }

        $finalName = request('name', $id);
        return response()->download($outputFile, $finalName)->deleteFileAfterSend(false);
    }
}
