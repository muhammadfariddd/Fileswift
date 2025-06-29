@extends('layouts.app')

@section('title', 'Kompres File')

@section('content')
    <div class="container mx-auto max-w-5xl p-6 md:p-8">

        <!-- Judul -->
        <header class="text-center my-8">
            <h1 class="text-3xl md:text-5xl font-bold text-slate-800">Kompres File Anda</h1>
        </header>

        @if (session('error'))
            <div id="toast-alert" class="toast-container" role="alert">
                <div class="toast-icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span>{{ session('error') }}</span>
                <button type="button" class="toast-close-button"
                    onclick="this.parentElement.style.display='none'">&times;</button>
            </div>
        @endif

        <main>
            <!-- Form Upload & Dropzone -->
            <form id="compress-form" action="{{ route('compress.process') }}" method="POST" enctype="multipart/form-data"
                class=" bg-(--color-primary) rounded-xl p-4">
                @csrf
                <div id="drop-area"
                    class="flex flex-col items-center justify-center min-h-[350px] border-2 border-dashed border-white/50 rounded-lg text-center p-8">
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

                    <!-- Input File (hidden) -->
                    <input type="file" id="file-input" name="file" class="hidden" />

                    <!-- Tombol Unggah -->
                    <div class="flex rounded-md shadow-sm">
                        <button type="button" onclick="document.getElementById('file-input').click()"
                            class="relative inline-flex items-center gap-x-2 rounded-md bg-white px-4 py-3 text-sm font-semibold text-slate-900 ring-1 ring-inset ring-slate-300 hover:bg-(--color-success) cursor-pointer focus:z-10">
                            <!-- Ikon Tambah File -->
                            <svg class="w-5 h-5 text-slate-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path
                                    d="M5.25 3A2.25 2.25 0 003 5.25v9.5A2.25 2.25 0 005.25 17h9.5A2.25 2.25 0 0017 14.75v-7.131l-5.021-5.021L7.13 5.25H5.25zM10 8.5a.75.75 0 01.75.75v1.25h1.25a.75.75 0 010 1.5H10.75v1.25a.75.75 0 01-1.5 0V12H8a.75.75 0 010-1.5h1.25V9.25A.75.75 0 0110 8.5z">
                                </path>
                                <path
                                    d="M11 3.75a.75.75 0 01.75.75v2.5a.75.75 0 01-.75.75h-2.5a.75.75 0 010-1.5h1.75V4.5a.75.75 0 01.75-.75z">
                                </path>
                            </svg>
                            PILIH FILE
                        </button>
                        {{-- <button type="button"
                            class="relative -ml-px inline-flex items-center rounded-r-md bg-white px-3 py-3 text-sm font-semibold text-slate-900 ring-1 ring-inset ring-slate-300 hover:bg-(--color-success) cursor-pointer focus:z-10">
                            <!-- Ikon Dropdown -->
                            <svg class="h-5 w-5 text-slate-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button> --}}
                    </div>

                    <!-- Teks "Drag and Drop" -->
                    <p class="mt-4 text-(--color-success)">atau seret dan lepaskan file di sini</p>

                    <!-- Catatan tentang ukuran file -->
                    <p class="mt-2 text-white/70 text-sm">Maksimal ukuran file: 500MB</p>


                    <!-- Info File -->
                    <div id="file-info" class="hidden mt-4"></div>

                    <!-- Tombol Compress -->
                    <button type="submit" id="compress-btn"
                        class="hidden mt-6 px-6 py-3 rounded-md bg-(--color-secondary) text-white font-semibold shadow hover:brightness-85 transition cursor-pointer">Kompress
                        Sekarang</button>

                    <!-- Spinner Loading -->
                    <div id="loading-spinner"
                        class="hidden absolute inset-0 flex items-center justify-center bg-white/80 rounded-lg z-10">
                        <svg class="animate-spin h-10 w-10 text-blue-600" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4" fill="none" />
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z" />
                        </svg>
                    </div>
                </div>
            </form>

            <!-- Bagian Fitur -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-16">
                <!-- Kolom Kiri: Deskripsi -->
                <div>
                    <p class="text-lg text-slate-600 leading-relaxed">
                        Kompres file Anda secara online untuk berbagi lebih cepat, unggahan yang ringan, dan penyimpanan
                        yang efisien—tanpa mengorbankan kualitas. Tools kami bisa digunakan gratis langsung di browser Anda.
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
                            <span class="text-slate-600">Kompres ukuran file hingga 99%</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-slate-600">Aman dan sesuai standar privasi (GDPR & ISO/IEC 27001)</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-slate-600">Kompresi langsung tanpa instalasi</span>
                        </li>
                    </ul>
                </div>
            </div>
        </main>
    </div>

@endsection
