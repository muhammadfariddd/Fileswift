<?php

// File: app/Services/Compression/ImageCompressor.php

namespace App\Services\Compression;

use Intervention\Image\ImageManager;
// --- PERBAIKAN: Kembali menggunakan driver GD yang lebih umum ---
use Intervention\Image\Drivers\Gd\Driver;

class ImageCompressor implements CompressorStrategy
{
    public function compress(string $inputPath, string $outputPath): void
    {
        // Pastikan driver yang digunakan adalah GD
        $manager = new ImageManager(new Driver());

        $image = $manager->read($inputPath);

        // --- TETAP MENGGUNAKAN RESIZE UNTUK MENGURANGI PENGGUNAAN MEMORI ---
        $image->scaleDown(width: 1920, height: 1920);

        // Simpan dengan kualitas agresif
        $image->save($outputPath, 60);
    }

    public function getOutputExtension(string $originalExtension): string
    {
        // Tetap konversi ke jpg untuk hasil terbaik.
        return 'jpg';
    }
}
