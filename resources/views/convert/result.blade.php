@extends('layouts.app')

@section('content')
    <div class="container mx-auto max-w-4xl p-6 md:p-10 mt-10">

        <div class="bg-[var(--color-primary)] rounded-xl p-4">
            <div
                class="flex flex-col items-center justify-center min-h-[350px] border-2 border-dashed border-white/50 rounded-lg text-center p-8">
                <header class="text-center mb-8">
                    <h2 class="text-3xl font-bold mb-4 text-white">Konversi Berhasil! 🎉</h2>
                    <p class="mb-6 text-lg text-[var(--color-success)]">File Anda sudah siap diunduh.</p>
                </header>

                <div class="flex items-center gap-4 mb-6 bg-white/10 rounded-xl p-4 w-full max-w-md">
                    <svg class="w-10 h-10 text-white/80 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V7a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <div class="flex-1 min-w-0">
                        <div class="font-bold text-lg text-white truncate">{{ $finalName }}</div>
                    </div>
                </div>

                <a href="{{ $downloadUrl }}?name={{ urlencode($finalName) }}&format={{ $toFormat }}"
                    class="w-full max-w-md block px-8 py-3 bg-green-600 text-white rounded-lg font-semibold shadow hover:bg-green-700 transition duration-300 ease-in-out text-lg"
                    download="{{ $finalName }}">
                    <i class="fa fa-download mr-2"></i> Unduh File Sekarang
                </a>

                <p class="text-sm text-white/80 mt-4">Link unduh akan berlaku selama 30 menit.</p>

                <div class="mt-8">
                    <a href="{{ route('convert.index') }}" class="text-white/80 hover:text-white text-lg transition">
                        &#8592; Kembali ke Halaman Konversi
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection
