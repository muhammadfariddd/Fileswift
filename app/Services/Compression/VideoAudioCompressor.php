<?php
// File: app/Services/Compression/VideoAudioCompressor.php

// --- PERBAIKAN: Menambahkan namespace yang hilang ---
namespace App\Services\Compression;

use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use FFMpeg\Format\Audio\Mp3;

class VideoAudioCompressor implements CompressorStrategy
{
    public function compress(string $inputPath, string $outputPath): void
    {
        try {
            $ffmpeg = FFMpeg::create([
                'timeout' => 3600, // Menambah timeout untuk file besar
                'ffmpeg.threads' => 12, // Menambah thread jika server mendukung
            ]);
            $media = $ffmpeg->open($inputPath);
            $ext = strtolower(pathinfo($outputPath, PATHINFO_EXTENSION));

            if (in_array($ext, ['mp4', 'mov', 'avi', 'mkv', 'webm'])) {
                $format = new X264('libmp3lame', 'libx264');
                // BITRATE DIUBAH: dari 1000 menjadi 500 untuk ukuran lebih kecil.
                $format->setKiloBitrate(500);
            } elseif (in_array($ext, ['mp3', 'wav', 'aac', 'ogg', 'flac'])) {
                $format = new Mp3();
                // BITRATE DIUBAH: dari 128 menjadi 96.
                $format->setAudioKiloBitrate(96);
            } else {
                throw new \Exception("Format media tidak didukung.");
            }

            $media->save($format, $outputPath);
        } catch (\Exception $e) {
            throw new \Exception('Gagal mengompresi file media. Pastikan FFMpeg terinstal. Error: ' . $e->getMessage());
        }
    }

    public function getOutputExtension(string $originalExtension): string
    {
        if (in_array($originalExtension, ['mp4', 'mov', 'avi', 'mkv', 'webm'])) return 'mp4';
        if (in_array($originalExtension, ['mp3', 'wav', 'aac', 'ogg', 'flac'])) return 'mp3';
        return $originalExtension;
    }
}
