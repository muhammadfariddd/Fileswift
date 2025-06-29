<?php
// File: app/Services/Compression/VideoAudioCompressor.php

namespace App\Services\Compression;

use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use FFMpeg\Format\Audio\Mp3;

class VideoAudioCompressor implements CompressorStrategy
{
    public function compress(string $inputPath, string $outputPath): void
    {
        try {
            // Konfigurasi ini secara eksplisit menunjuk ke lokasi standar
            // ffmpeg dan ffprobe di server Linux setelah diinstal via apt-get.
            $config = [
                'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
                'ffprobe.binaries' => '/usr/bin/ffprobe',
                'timeout'          => 3600, // Timeout 1 jam
                'ffmpeg.threads'   => 4,    // Batasi thread agar tidak membebani server
            ];

            $ffmpeg = FFMpeg::create($config);
            $media = $ffmpeg->open($inputPath);
            $ext = strtolower(pathinfo($outputPath, PATHINFO_EXTENSION));

            if (in_array($ext, ['mp4', 'mov', 'avi', 'mkv', 'webm'])) {
                // --- PERBAIKAN: Mengganti codec audio ---
                // Menggunakan 'aac' yang lebih standar daripada 'libmp3lame' untuk video MP4.
                // Ini jauh lebih mungkin tersedia di server hosting.
                $format = new X264('aac', 'libx264');
                $format->setKiloBitrate(400);
            } elseif (in_array($ext, ['mp3', 'wav', 'aac', 'ogg', 'flac'])) {
                $format = new Mp3();
                $format->setAudioKiloBitrate(80);
            } else {
                throw new \Exception("Format media tidak didukung.");
            }

            $media->save($format, $outputPath);
        } catch (\Exception $e) {
            // Lemparkan lagi error dengan pesan yang lebih spesifik
            throw new \Exception('Gagal mengompresi file media. Pastikan FFMpeg terinstal dengan benar di server. Error: ' . $e->getMessage());
        }
    }

    public function getOutputExtension(string $originalExtension): string
    {
        if (in_array($originalExtension, ['mp4', 'mov', 'avi', 'mkv', 'webm'])) return 'mp4';
        if (in_array($originalExtension, ['mp3', 'wav', 'aac', 'ogg', 'flac'])) return 'mp3';
        return $originalExtension;
    }
}
