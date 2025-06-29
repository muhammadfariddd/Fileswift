<?php

namespace App\Services\Compression;

class PassthroughStrategy implements CompressorStrategy
{
    public function compress(string $inputPath, string $outputPath): void
    {
        if (!copy($inputPath, $outputPath)) {
            throw new \Exception('Gagal menyalin file.');
        }
    }

    public function getOutputExtension(string $originalExtension): string
    {
        return $originalExtension;
    }
}
