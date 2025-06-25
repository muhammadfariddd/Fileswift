@extends('layouts.app')

@section('title', 'Hasil Gabung PDF')

@section('content')
    <div class="container mx-auto max-w-2xl p-6 md:p-10 mt-15">
        <div class="bg-(--color-primary) rounded-xl shadow-lg p-8 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">PDF Berhasil Digabung!</h2>
            @if (session('conversion_failures'))
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-md">
                    <b>Beberapa file gagal diproses dan tidak ikut digabung:</b>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach (session('conversion_failures') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="flex flex-col items-center justify-center mb-6">
                <svg class="w-16 h-16 text-(--color-success) mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <div class="bg-white/90 rounded-lg px-6 py-4 shadow mt-2 w-full max-w-md">
                    <div class="font-semibold text-lg text-slate-800 mb-1">{{ $finalName }}</div>
                    <div class="text-sm text-gray-500 mb-2">File hasil gabungan PDF</div>
                    <a href="{{ $downloadUrl }}?name={{ $finalName }}"
                        class="inline-block mt-2 px-6 py-2 rounded-md bg-(--color-secondary) text-white font-semibold shadow hover:brightness-90 transition">Download
                        PDF</a>
                </div>
            </div>
            <div class="mt-6 text-left bg-white/80 rounded-lg p-4 max-w-md mx-auto">
                <div class="font-semibold text-slate-700 mb-1">File Sumber:</div>
                <ul class="text-sm text-gray-600 list-disc list-inside">
                    @foreach ($originalFiles as $file)
                        <li>{{ $file }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-8">
                <a href="{{ route('merge.index') }}" class="text-(--color-success) hover:underline font-semibold">Gabung PDF
                    Lainnya</a>
            </div>
        </div>
    </div>
@endsection
