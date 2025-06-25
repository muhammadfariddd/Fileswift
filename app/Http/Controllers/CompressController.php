<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Intervention\Image\ImageManager;



class CompressController extends Controller
{
    public function index()
    {
        return view('compress.index');
    }

    public function compress(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:51200', // max 50MB
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $ext = strtolower($file->getClientOriginalExtension());
        $filename = Str::random(16) . '.' . $ext;
        $outputPath = storage_path('app/public/compressed');
        if (!file_exists($outputPath)) {
            mkdir($outputPath, 0777, true);
        }
        $outputFile = $outputPath . '/' . $filename;
        $beforeSize = $file->getSize();
        $afterSize = 0;

        // Kompresi untuk gambar
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            try {
                $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
                $img = $manager->read($file->getRealPath());
                $quality = 60;
                $img->toJpeg()->save($outputFile, $quality);
                $afterSize = filesize($outputFile);
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal mengompres gambar: ' . $e->getMessage());
            }
        } else {
            // Untuk file non-gambar, hanya simpan ulang (simulasi kompresi)
            $file->move($outputPath, $filename);
            $afterSize = filesize($outputFile);
        }

        // Simpan info ke session dan redirect ke result
        session([
            'compressed_original_name' => $originalName,
            'compressed_filename' => $filename,
            'compressed_before_size' => $beforeSize,
            'compressed_after_size' => $afterSize,
        ]);
        return redirect()->route('compress.result', ['id' => $filename]);
    }

    public function result($id)
    {
        $outputFile = storage_path('app/public/compressed/' . $id);
        if (!file_exists($outputFile)) {
            abort(404, 'File tidak ditemukan');
        }
        $originalName = session('compressed_original_name', $id);
        $beforeSize = session('compressed_before_size', 0);
        $afterSize = session('compressed_after_size', 0);
        $downloadUrl = route('compress.download', ['id' => $id]);
        $finalName = 'compressed-' . $originalName;
        return view('compress.result', compact('finalName', 'downloadUrl', 'beforeSize', 'afterSize'));
    }

    public function download($id)
    {
        $outputFile = storage_path('app/public/compressed/' . $id);
        if (!file_exists($outputFile)) {
            abort(404, 'File tidak ditemukan');
        }
        $finalName = request('name', $id);
        return response()->download($outputFile, $finalName)->deleteFileAfterSend(false);
    }
}
