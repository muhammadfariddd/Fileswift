<?php

namespace App\Services\Compression;

use App\Services\Compression\CompressorStrategy;

class ZipPackager implements CompressorStrategy
{
    public function compress(string $inputPath, string $outputPath): void
    {
        $zip = new \ZipArchive();

        if ($zip->open($outputPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== TRUE) {
            throw new \Exception('Tidak dapat membuat file arsip ZIP.');
        }

        $filename = basename($inputPath);
        $zip->addFile($inputPath, $filename);

        // --- OPTIMASI MAKSIMAL: Atur level kompresi tertinggi ---
        // Angka 9 adalah level kompresi 'DEFLATE' yang paling kuat.
        $zip->setCompressionName($filename, \ZipArchive::CM_DEFLATE, 9);

        $zip->close();
    }

    public function getOutputExtension(string $originalExtension): string
    {
        return 'zip';
    }
}
