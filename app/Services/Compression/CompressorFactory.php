<?php

// Lokasi File: app/Services/Compression/CompressorFactory.php

namespace App\Services\Compression;

// Impor semua kelas strategi yang dibutuhkan agar dapat dikenali.
use App\Services\Compression\CompressorStrategy;
use App\Services\Compression\ImageCompressor;
use App\Services\Compression\PassthroughStrategy;
use App\Services\Compression\PdfCompressor;
use App\Services\Compression\VideoAudioCompressor;
use App\Services\Compression\ZipPackager;

/**
 * Class CompressorFactory
 * Bertanggung jawab untuk membuat instance dari CompressorStrategy yang sesuai
 * berdasarkan ekstensi file yang diberikan.
 */
class CompressorFactory
{
    /**
     * Mendapatkan objek kompresor yang sesuai untuk ekstensi file.
     *
     * @param string $extension Ekstensi file dalam huruf kecil (misal: 'jpg', 'pdf', 'mp4').
     * @return CompressorStrategy Mengembalikan objek strategi kompresi yang sesuai.
     * @throws \Exception Jika format file tidak didukung.
     */
    public function getCompressorFor(string $extension): CompressorStrategy
    {
        return match (true) {
            // GRUP 1: Gambar -> Gunakan kompresor gambar khusus
            in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'tiff']) => new ImageCompressor(),

            // GRUP 2: PDF -> Gunakan kompresor PDF khusus (Ghostscript)
            in_array($extension, ['pdf']) => new PdfCompressor(),

            // GRUP 3: Media -> Gunakan kompresor media khusus (FFMpeg)
            in_array($extension, ['mp4', 'mov', 'avi', 'mkv', 'webm', 'mp3', 'wav', 'aac', 'ogg', 'flac']) => new VideoAudioCompressor(),

            // GRUP 4: Dokumen & Teks -> Bungkus semuanya menjadi file .zip
            // Termasuk format Office lama (.doc) dan baru (.docx)
            in_array($extension, [
                // Teks & Data
                'txt',
                'csv',
                'html',
                'htm',
                'json',
                'xml',
                'svg',
                'css',
                'js',
                'log',
                // Dokumen Office (Lama & Baru)
                'doc',
                'docx',
                'xls',
                'xlsx',
                'ppt',
                'pptx',
                'rtf',
                'odt'
            ]) => new ZipPackager(),

            // // GRUP 5: Arsip yang Sudah Ada -> Lewati (jangan kompres ulang)
            // // Ini adalah file yang sudah merupakan hasil kompresi.
            // in_array($extension, ['zip', 'rar', '7z', 'tar', 'gz', 'bz2']) => new PassthroughStrategy(),

            // Jika tidak ada yang cocok, lemparkan error.
            default => throw new \Exception("Format file '{$extension}' tidak didukung untuk kompresi."),
        };
    }
}
