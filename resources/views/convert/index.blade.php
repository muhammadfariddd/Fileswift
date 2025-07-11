@extends('layouts.app')

@section('content')
    <div class="container mx-auto max-w-5xl p-6 md:p-10 mt-5">

        <!-- Judul -->
        <header class="text-center my-8">
            <h1 class="text-3xl md:text-5xl font-bold text-slate-800">Convert Your File</h1>
        </header>

        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <main>
            <form id="convert-form" action="{{ route('convert.process') }}" method="POST" enctype="multipart/form-data"
                class="bg-(--color-primary) rounded-xl p-4">
                @csrf
                <input type="hidden" name="debug" value="1">
                <div class="flex flex-col items-center justify-center min-h-[350px] border-2 border-dashed border-white/50 rounded-lg text-center p-8"
                    id="drop-area">
                    <!-- Ikon Tumpukan File -->
                    <div class="relative w-32 h-24 mb-6">
                        <div
                            class="absolute w-20 h-24 right-0 top-0 bg-(--color-primary) border border-white/80 rounded-md transform -rotate-6">
                        </div>
                        <div
                            class="absolute w-20 h-24 right-4 top-2 bg-(--color-primary) border border-white/80 rounded-md transform rotate-3 flex items-center justify-center">
                            <svg class="w-8 h-8 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V7a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="absolute w-20 h-24 left-0 top-1 bg-(--color-primary) border border-white/80 rounded-md transform -rotate-3 flex items-center justify-center p-2">
                            <div class="w-full text-center">
                                <span class="text-white/80 font-bold text-lg">FILES</span>
                            </div>
                        </div>
                    </div>
                    <input type="file" id="file-input" name="file" class="hidden" required>
                    <div id="file-info" class="hidden mt-4 text-[var(--color-success)]"></div>
                    <div id="format-options" class="hidden mt-4"></div>
                    <button type="submit" id="convert-btn"
                        class="hidden mt-6 px-6 py-3 rounded-md bg-(--color-secondary) text-white font-semibold shadow hover:brightness-85 transition cursor-pointer">Konversi
                        Sekarang</button>
                    <div id="loading-spinner"
                        class="hidden absolute inset-0 flex items-center justify-center bg-white/80 rounded-lg z-10">
                        <svg class="animate-spin h-10 w-10 text-blue-600" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4" fill="none" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z" />
                        </svg>
                    </div>
                    <!-- Tombol Choose Files -->
                    <div class="flex rounded-md shadow-sm mt-4">
                        <button type="button" id="choose-files-btn"
                            class="relative inline-flex items-center gap-x-2 rounded-md bg-white px-4 py-3 text-sm font-semibold text-slate-900 ring-1 ring-inset ring-slate-300 focus:z-10 hover:bg-(--color-success) cursor-pointer">
                            <svg class="w-5 h-5 text-slate-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path
                                    d="M5.25 3A2.25 2.25 0 003 5.25v9.5A2.25 2.25 0 005.25 17h9.5A2.25 2.25 0 0017 14.75v-7.131l-5.021-5.021L7.13 5.25H5.25zM10 8.5a.75.75 0 01.75.75v1.25h1.25a.75.75 0 010 1.5H10.75v1.25a.75.75 0 01-1.5 0V12H8a.75.75 0 010-1.5h1.25V9.25A.75.75 0 0110 8.5z">
                                </path>
                                <path
                                    d="M11 3.75a.75.75 0 01.75.75v2.5a.75.75 0 01-.75.75h-2.5a.75.75 0 010-1.5h1.75V4.5a.75.75 0 01.75-.75z">
                                </path>
                            </svg>
                            CHOOSE FILES
                        </button>
                    </div>
                    <p class="mt-4 text-(--color-success)">or drop files here</p>
                </div>

            </form>
            <!-- Bagian Fitur -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-16">
                <!-- Kolom Kiri: Deskripsi -->
                <div>
                    <p class="text-lg text-slate-600 leading-relaxed">
                        Konversi berbagai jenis file dengan mudah—dari dokumen hingga gambar—langsung dari browser Anda.
                        Fileswift membantu Anda mengubah format file secara cepat dan akurat tanpa perlu aplikasi
                        tambahan.
                    </p>
                </div>
                <!-- Kolom Kanan: Daftar Fitur -->
                <div>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3">
                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-slate-600">Dukung berbagai jenis konversi (dokumen, gambar, dll)</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-slate-600">Aman dan terenkripsi sesuai standar internasional</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-slate-600">Gratis digunakan kapan saja, di perangkat apa saja</span>
                        </li>
                    </ul>
                </div>
            </div>
        </main>
    </div>
@endsection
