<?php
// File: app/Services/Compression/PdfCompressor.php

namespace App\Services\Compression;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class PdfCompressor implements CompressorStrategy
{
    /**
     * Cari path absolut ke Ghostscript yang bisa dieksekusi.
     * @return string|null Path absolut atau null jika tidak ditemukan.
     */
    private function findGhostscriptPath(): ?string
    {
        // --- PERBAIKAN: Menambahkan path spesifik sebagai prioritas utama ---
        // Ganti path ini jika lokasi instalasi Anda berbeda.
        $hardcodedPath = 'C:\Program Files (x86)\gs\gs10.05.1\bin\gswin32c.exe';

        if (file_exists($hardcodedPath)) {
            return $hardcodedPath;
        }

        // Jika path yang di-hardcode tidak ada, coba cari di PATH sistem (sebagai fallback).
        $commands = ['gswin64c', 'gswin32c', 'gs'];
        foreach ($commands as $command) {
            $testProcess = Process::fromShellCommandline("command -v $command || where $command");
            try {
                $testProcess->mustRun();
                // Jika perintah ditemukan, kembalikan nama perintahnya
                return $command;
            } catch (ProcessFailedException $e) {
                // Lanjutkan ke perintah berikutnya jika tidak ditemukan
                continue;
            }
        }
        return null;
    }

    public function compress(string $inputPath, string $outputPath): void
    {
        $gsPath = $this->findGhostscriptPath();

        if ($gsPath === null) {
            // Pesan error yang lebih jelas
            throw new \Exception('Ghostscript tidak ditemukan. Pastikan path di PdfCompressor.php sudah benar atau Ghostscript sudah terinstal dan ditambahkan ke PATH sistem.');
        }

        $qualityLevel = '/screen';

        // Membuat array perintah untuk keamanan dan kejelasan
        $command = [
            $gsPath, // Menggunakan path absolut atau perintah yang ditemukan
            '-sDEVICE=pdfwrite',
            '-dCompatibilityLevel=1.4',
            "-dPDFSETTINGS={$qualityLevel}",
            '-dNOPAUSE',
            '-dBATCH',
            '-dQUIET',
            "-sOutputFile={$outputPath}",
            $inputPath,
        ];

        $process = new Process($command);
        $process->setTimeout(300); // Timeout 5 menit

        try {
            $process->mustRun();
        } catch (ProcessFailedException $exception) {
            throw new \Exception(
                'Kompresi PDF gagal. Pesan error dari Ghostscript: ' .
                    $exception->getProcess()->getErrorOutput()
            );
        }

        if (!file_exists($outputPath) || filesize($outputPath) === 0) {
            throw new \Exception('Kompresi PDF selesai tanpa error, tetapi file output tidak berhasil dibuat.');
        }
    }

    public function getOutputExtension(string $originalExtension): string
    {
        return $originalExtension;
    }
}
