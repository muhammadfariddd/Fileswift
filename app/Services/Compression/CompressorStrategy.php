<?php

namespace App\Services\Compression;

interface CompressorStrategy
{
    /**
     * Kompres file dari inputPath dan simpan ke outputPath.
     * @param string $inputPath Path absolut ke file asli.
     * @param string $outputPath Path absolut untuk menyimpan file hasil kompresi.
     */
    public function compress(string $inputPath, string $outputPath): void;

    /**
     * Dapatkan ekstensi file output.
     * @param string $originalExtension Ekstensi file asli.
     * @return string Ekstensi file output.
     */
    public function getOutputExtension(string $originalExtension): string;
}
