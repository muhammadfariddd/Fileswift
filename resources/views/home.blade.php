<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'Konversi File Online Gratis')

@section('content')
    <!-- Hero Section -->
    <section id="beranda" class="gradient-bg min-h-screen flex items-center relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full floating"></div>
        <div class="absolute top-40 right-20 w-16 h-16 bg-white/10 rounded-full floating" style="animation-delay: -1s;"></div>
        <div class="absolute bottom-40 left-20 w-12 h-12 bg-white/10 rounded-full floating" style="animation-delay: -2s;">
        </div>

        <div class="container mx-auto px-6 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-black space-y-8">
                    <div class="hero-text">
                        <h1 class="text-5xl lg:text-6xl font-bold leading-tight">
                            Konversi File
                            <span
                                class="bg-gradient-to-r from-(--color-primary) to-(--color-secondary) bg-clip-text text-transparent">
                                Super Mudah
                            </span>
                        </h1>
                        <p class="text-xl text-black mt-6 leading-relaxed">
                            Ubah format file Anda dalam hitungan detik. Semua bisa
                            dikonversi gratis tanpa perlu daftar akun!
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('convert.index') }}"
                            class="bg-(--color-secondary) text-white px-4 py-2 rounded-md font-semibold text-lg hover:brightness-85 transition-all duration-300">
                            <i class="fas fa-rocket mr-2"></i>
                            Mulai Konversi Sekarang
                        </a>
                        <a href="{{ route('team') }}"
                            class="border-1 border-(--color-secondary) text-(--color-secondary) px-4 py-2 rounded-md font-semibold text-lg hover:bg-(--color-secondary) hover:text-white transition-all duration-300 cursor-pointer">
                            <i class="fas fa-envelope mr-2"></i>
                            Tentang Kami
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold counter text-(--color-dark)"
                                data-target="{{ $stats['files_converted'] ?? 50000 }}">0
                            </div>
                            <div class="text-(--color-dark)">File Dikonversi</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold counter text-(--color-dark)"
                                data-target="{{ $stats['formats_supported'] ?? 15 }}">0
                            </div>
                            <div class="text-(--color-dark)">Format Didukung</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-(--color-dark)">100%</div>
                            <div class="text-(--color-dark)">Gratis</div>
                        </div>
                    </div>
                </div>

                <!-- Hero Visual -->
                <div class="relative">
                    <div class="hero-visual bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20">
                        {{-- <div class="space-y-4"> --}}
                        <!-- File Icons -->
                        <img src="{{ asset('images/home.png') }}" alt="Hero Visual" class="w-auto h-auto">
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="md:py-15 bg-white">
        <div class="container mx-auto px-6">

            <!-- Header Section -->
            <div class="text-center">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">
                    Semua Alat Konversi File dalam Satu Tempat
                </h1>
                <p class="mt-4 text-lg text-gray-600">
                    Gunakan Fileswift untuk mengonversi, mengompres, dan mengelola berbagai jenis file dengan cepat dan aman
                    — gratis.
                </p>
            </div>

            <!-- Grid of Tools -->
            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Tool Card: Konversi File -->
                <a href="#"
                    class="group flex items-center p-4 bg-gray-50 rounded-xl shadow-sm hover:shadow-md hover:bg-gray-100 transition-all duration-300">
                    <div class="flex-shrink-0 p-3 bg-blue-500 rounded-lg">
                        <!-- Icon -->
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="ml-4 flex-grow">
                        <h3 class="font-semibold text-gray-900">Konversi File</h3>
                        <p class="text-sm text-gray-600">Ubah dokumen, gambar, audio, dan video ke berbagai format populer.
                        </p>
                    </div>
                    <svg class="h-5 w-5 text-gray-400 ml-auto mb-auto transform transition-transform group-hover:translate-x-1"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                <!-- Tool Card: Kompres File -->
                <a href="#"
                    class="group flex items-center p-4 bg-gray-50 rounded-xl shadow-sm hover:shadow-md hover:bg-gray-100 transition-all duration-300">
                    <div class="flex-shrink-0 p-3 bg-red-500 rounded-lg">
                        <!-- Icon -->
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 8V4m0 0h4M4 4l5 5m11-1V8m0 0h-4m4-4l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 0h-4m4 0l-5-5" />
                        </svg>
                    </div>
                    <div class="ml-4 flex-grow">
                        <h3 class="font-semibold text-gray-900">Kompres File</h3>
                        <p class="text-sm text-gray-600">Perkecil ukuran file PDF, gambar, atau video tanpa mengurangi
                            kualitas.</p>
                    </div>
                    <svg class="h-5 w-5 text-gray-400 ml-auto mb-auto transform transition-transform group-hover:translate-x-1"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

                <!-- Tool Card: Gabung PDF -->
                <a href="#"
                    class="group flex items-center p-4 bg-gray-50 rounded-xl shadow-sm hover:shadow-md hover:bg-gray-100 transition-all duration-300">
                    <div class="flex-shrink-0 p-3 bg-purple-500 rounded-lg">
                        <!-- Icon -->
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                    </div>
                    <div class="ml-4 flex-grow">
                        <h3 class="font-semibold text-gray-900">Gabung PDF</h3>
                        <p class="text-sm text-gray-600">Satukan beberapa file PDF menjadi satu dokumen yang rapi dan utuh.
                        </p>
                    </div>
                    <svg class="h-5 w-5 text-gray-400 ml-auto mb-auto transform transition-transform group-hover:translate-x-1"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

            </div>

        </div>

    </section>

    <!-- Conversion Types -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <!-- Section Header -->
            <div class="text-center">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 tracking-tight">
                    Mengapa Memilih Fileswift?
                </h2>
            </div>

            <!-- Features Grid -->
            <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-16">

                <!-- Feature 1: Digunakan oleh Jutaan Pengguna -->
                <div class="text-center">
                    <div class="flex justify-center items-center mb-3">
                        <svg class="h-20 w-auto" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M8 3.5C8 4.88071 6.88071 6 5.5 6C4.11929 6 3 4.88071 3 3.5C3 2.11929 4.11929 1 5.5 1C6.88071 1 8 2.11929 8 3.5Z"
                                    fill="#0f4c75"></path>
                                <path d="M3 8C1.34315 8 0 9.34315 0 11V15H8V8H3Z" fill="#0f4c75"></path>
                                <path d="M13 8H10V15H16V11C16 9.34315 14.6569 8 13 8Z" fill="#0f4c75"></path>
                                <path
                                    d="M12 6C13.1046 6 14 5.10457 14 4C14 2.89543 13.1046 2 12 2C10.8954 2 10 2.89543 10 4C10 5.10457 10.8954 6 12 6Z"
                                    fill="#0f4c75"></path>
                            </g>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        Digunakan oleh Banyak Pengguna
                    </h3>
                    <p class="mt-2 text-base text-gray-600">
                        Fileswift telah membantu banyak pengguna untuk mengelola dan mengonversi file mereka
                        dengan cepat dan mudah.
                    </p>
                </div>

                <!-- Feature 2: Kualitas Terpercaya -->
                <div class="text-center">
                    <div class="flex justify-center items-center mb-3">
                        <svg class="h-20 w-auto" fill="#0f4c75" version="1.1" id="Layer_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 472.623 472.623" xml:space="preserve" stroke="#0f4c75">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <g>
                                        <path
                                            d="M157.062,56.669c-0.985-3.151-3.545-5.514-6.794-6.4l-40.271-11.028L87.056,4.287c-3.643-5.514-12.898-5.514-16.542,0 L47.573,39.241L7.302,50.269c-3.249,0.886-5.809,3.249-6.794,6.4c-1.083,3.151-0.394,6.695,1.674,9.255l26.191,32.591 l-2.068,41.748c-0.098,3.348,1.378,6.498,4.135,8.468c2.659,1.969,6.105,2.462,9.255,1.28l39.089-14.868l39.089,14.868 c1.182,0.394,2.363,0.591,3.545,0.591c1.969,0,4.037-0.591,5.711-1.871c2.757-1.969,4.234-5.12,4.135-8.468l-2.068-41.748 l26.191-32.591C157.456,63.364,158.145,59.819,157.062,56.669z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="196.931" y="49.058" width="167.385" height="19.692"></rect>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="196.931" y="98.288" width="275.692" height="19.692"></rect>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M157.062,217.653c-0.985-3.151-3.545-5.612-6.794-6.498l-40.271-11.028l-22.942-34.954 c-3.643-5.514-12.898-5.514-16.542,0l-22.942,34.954L7.302,211.155c-3.249,0.886-5.809,3.348-6.794,6.498 c-1.083,3.151-0.394,6.597,1.674,9.157l26.191,32.591l-2.068,41.846c-0.098,3.249,1.378,6.498,4.135,8.369 c2.659,1.969,6.105,2.462,9.255,1.28l39.089-14.769l39.089,14.769c1.182,0.394,2.363,0.689,3.545,0.689 c1.969,0,4.037-0.689,5.711-1.969c2.757-1.871,4.234-5.12,4.135-8.369l-2.068-41.846l26.191-32.591 C157.456,224.25,158.145,220.804,157.062,217.653z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="196.931" y="206.596" width="167.385" height="19.692"></rect>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="196.931" y="255.827" width="275.692" height="19.692"></rect>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M157.062,378.539c-0.985-3.151-3.545-5.612-6.794-6.498l-40.271-10.929l-22.942-35.052 c-3.643-5.514-12.898-5.514-16.542,0l-22.942,35.052L7.302,372.041c-3.249,0.886-5.809,3.348-6.794,6.498 c-1.083,3.151-0.394,6.597,1.674,9.157l26.191,32.689l-2.068,41.748c-0.098,3.348,1.378,6.498,4.135,8.468 c2.659,1.871,6.105,2.363,9.255,1.182l39.089-14.769l39.089,14.769c1.182,0.492,2.363,0.689,3.545,0.689 c1.969,0,4.037-0.689,5.711-1.871c2.757-1.969,4.234-5.12,4.135-8.468l-2.068-41.748l26.191-32.689 C157.456,385.136,158.145,381.69,157.062,378.539z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="196.931" y="373.981" width="167.385" height="19.692"></rect>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="196.931" y="423.211" width="275.692" height="19.692"></rect>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        Kualitas Terpercaya
                    </h3>
                    <p class="mt-2 text-base text-gray-600">
                        Fileswift menjadi pilihan utama bagi individu dan profesional dalam menangani dokumen digital secara
                        efisien dan aman.
                    </p>
                </div>

                <!-- Feature 3: Dukungan Berbagai Format -->
                <div class="text-center">
                    <div class="flex justify-center items-center mb-3">
                        <svg class="h-20 w-auto" fill="#0f4c75" height="200px" width="200px" version="1.1"
                            id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 512 512" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <g>
                                        <path
                                            d="M93.091,360.727c-25.67,0-46.545,20.876-46.545,46.545c0,25.67,20.876,46.545,46.545,46.545 c25.67,0,46.545-20.876,46.545-46.545C139.636,381.603,118.761,360.727,93.091,360.727z M93.091,430.545 c-12.835,0-23.273-10.438-23.273-23.273c0-12.835,10.438-23.273,23.273-23.273c12.835,0,23.273,10.438,23.273,23.273 C116.364,420.108,105.926,430.545,93.091,430.545z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M128,81.455H58.182c-6.435,0-11.636,5.201-11.636,11.636c0,6.435,5.201,11.636,11.636,11.636H128 c6.435,0,11.636-5.201,11.636-11.636C139.636,86.656,134.435,81.455,128,81.455z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M128,128H58.182c-6.435,0-11.636,5.201-11.636,11.636c0,6.435,5.201,11.636,11.636,11.636H128 c6.435,0,11.636-5.201,11.636-11.636C139.636,133.201,134.435,128,128,128z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M128,174.545H58.182c-6.435,0-11.636,5.201-11.636,11.636s5.201,11.636,11.636,11.636H128 c6.435,0,11.636-5.201,11.636-11.636S134.435,174.545,128,174.545z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M302.545,0H197.818c-19.247,0-34.909,15.663-34.909,34.909v442.182c0,6.423-5.213,11.636-11.636,11.636H34.909 c-6.423,0-11.636-5.213-11.636-11.636V34.909c0-6.423,5.213-11.636,11.636-11.636H128c6.435,0,11.636-5.201,11.636-11.636 C139.636,5.201,134.435,0,128,0H34.909C15.663,0,0,15.663,0,34.909v442.182C0,496.337,15.663,512,34.909,512h116.364 c19.247,0,34.909-15.663,34.909-34.909V34.909c0-6.423,5.213-11.636,11.636-11.636h104.727c6.435,0,11.636-5.201,11.636-11.636 C314.182,5.201,308.98,0,302.545,0z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M256,360.727c-25.67,0-46.545,20.876-46.545,46.545c0,25.67,20.876,46.545,46.545,46.545s46.545-20.876,46.545-46.545 C302.545,381.603,281.67,360.727,256,360.727z M256,430.545c-12.835,0-23.273-10.438-23.273-23.273 C232.727,394.438,243.165,384,256,384s23.273,10.438,23.273,23.273C279.273,420.108,268.835,430.545,256,430.545z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M290.909,81.455h-69.818c-6.435,0-11.636,5.201-11.636,11.636c0,6.435,5.201,11.636,11.636,11.636h69.818 c6.435,0,11.636-5.201,11.636-11.636C302.545,86.656,297.344,81.455,290.909,81.455z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M290.909,128h-69.818c-6.435,0-11.636,5.201-11.636,11.636c0,6.435,5.201,11.636,11.636,11.636h69.818 c6.435,0,11.636-5.201,11.636-11.636C302.545,133.201,297.344,128,290.909,128z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M290.909,174.545h-69.818c-6.435,0-11.636,5.201-11.636,11.636s5.201,11.636,11.636,11.636h69.818 c6.435,0,11.636-5.201,11.636-11.636S297.344,174.545,290.909,174.545z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M477.091,0H360.727c-19.247,0-34.909,15.663-34.909,34.909v34.909v407.273c0,6.423-5.213,11.636-11.636,11.636h-93.091 c-6.435,0-11.636,5.201-11.636,11.636S214.656,512,221.091,512h93.091c19.247,0,34.909-15.663,34.909-34.909V69.818V34.909 c0-6.423,5.213-11.636,11.636-11.636h116.364c6.423,0,11.636,5.213,11.636,11.636v442.182c0,6.423-5.213,11.636-11.636,11.636H384 c-6.435,0-11.636,5.201-11.636,11.636S377.565,512,384,512h93.091C496.337,512,512,496.337,512,477.091V34.909 C512,15.663,496.337,0,477.091,0z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M418.909,360.727c-25.67,0-46.545,20.876-46.545,46.545c0,25.67,20.876,46.545,46.545,46.545 c25.67,0,46.545-20.876,46.545-46.545C465.455,381.603,444.579,360.727,418.909,360.727z M418.909,430.545 c-12.835,0-23.273-10.438-23.273-23.273c0-12.835,10.438-23.273,23.273-23.273c12.835,0,23.273,10.438,23.273,23.273 C442.182,420.108,431.744,430.545,418.909,430.545z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M453.818,81.455H384c-6.435,0-11.636,5.201-11.636,11.636c0,6.435,5.201,11.636,11.636,11.636h69.818 c6.435,0,11.636-5.201,11.636-11.636C465.455,86.656,460.253,81.455,453.818,81.455z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M453.818,128H384c-6.435,0-11.636,5.201-11.636,11.636c0,6.435,5.201,11.636,11.636,11.636h69.818 c6.435,0,11.636-5.201,11.636-11.636C465.455,133.201,460.253,128,453.818,128z">
                                        </path>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path
                                            d="M453.818,174.545H384c-6.435,0-11.636,5.201-11.636,11.636s5.201,11.636,11.636,11.636h69.818 c6.435,0,11.636-5.201,11.636-11.636S460.253,174.545,453.818,174.545z">
                                        </path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        Dukungan Berbagai Format
                    </h3>
                    <p class="mt-2 text-base text-gray-600">
                        Fileswift mendukung konversi dokumen, gambar, audio, hingga video dalam berbagai format umum seperti
                        PDF, Word, JPG, MP4, dan lainnya.
                    </p>
                </div>

                <!-- Feature 4: Mudah Digunakan -->
                <div class="text-center">
                    <div class="flex justify-center items-center mb-3">
                        <svg class="h-20 w-auto" fill="#0f4c75" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            stroke="#0f4c75">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M2,3H6A1,1,0,0,1,6,5H2A1,1,0,0,1,2,3ZM22,3H11V2A1,1,0,0,0,9,2V6a1,1,0,0,0,2,0V5H22a1,1,0,0,0,0-2ZM2,21H9a1,1,0,0,0,0-2H2a1,1,0,0,0,0,2Zm20-2H14V18a1,1,0,0,0-2,0v4a1,1,0,0,0,2,0V21h8a1,1,0,0,0,0-2Zm0-8H19V10a1,1,0,0,0-2,0v4a1,1,0,0,0,2,0V13h3a1,1,0,0,0,0-2ZM2,13H14a1,1,0,0,0,0-2H2a1,1,0,0,0,0,2Z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        Mudah Digunakan
                    </h3>
                    <p class="mt-2 text-base text-gray-600">
                        Tampilan antarmuka yang bersih dan intuitif memudahkan siapa pun untuk menggunakan Fileswift tanpa
                        perlu keahlian teknis.
                    </p>
                </div>

                <!-- Feature 5: Keamanan Terjamin -->
                <div class="text-center">
                    <div class="flex justify-center items-center mb-3">
                        <svg class="h-20 w-auto" version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"
                            enable-background="new 0 0 64 64" xml:space="preserve" fill="#0f4c75">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <path fill="#0f4c75" d="M8,56v4c0,2.211,1.789,4,4,4h40c2.211,0,4-1.789,4-4v-4H8z">
                                    </path>
                                    <path fill="#0f4c75"
                                        d="M56,54V34H8v20H56z M32,36c2.762,0,5,2.238,5,5c0,1.631-0.791,3.066-2,3.979V49c0,1.657-1.343,3-3,3 s-3-1.343-3-3v-4.021c-1.209-0.912-2-2.348-2-3.979C27,38.238,29.238,36,32,36z">
                                    </path>
                                    <path fill="#0f4c75"
                                        d="M31,43.816V49c0,0.553,0.447,1,1,1s1-0.447,1-1v-5.184c1.163-0.413,2-1.512,2-2.816c0-1.657-1.343-3-3-3 s-3,1.343-3,3C29,42.305,29.837,43.403,31,43.816z">
                                    </path>
                                    <path fill="#0f4c75"
                                        d="M56,32v-4c0-2.211-1.789-4-4-4h-6V14c0-7.732-6.268-14-14-14S18,6.268,18,14v10h-6c-2.211,0-4,1.789-4,4v4 H56z M38,24H26V14c0-3.313,2.687-6,6-6s6,2.687,6,6V24z M20,14c0-6.627,5.373-12,12-12s12,5.373,12,12v10h-4V14 c0-4.418-3.582-8-8-8s-8,3.582-8,8v10h-4V14z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        Keamanan Terjamin
                    </h3>
                    <p class="mt-2 text-base text-gray-600">
                        Setiap proses konversi dan unggah file dijalankan secara aman dengan standar enkripsi tinggi untuk
                        menjaga privasi Anda.
                    </p>
                </div>

                <!-- Feature 6: Gratis dan Tanpa Registrasi -->
                <div class="text-center">
                    <div class="flex justify-center items-center mb-3">
                        <svg class="h-20 w-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path opacity="0.4"
                                    d="M21.0901 21.5C21.0901 21.78 20.8701 22 20.5901 22H3.41016C3.13016 22 2.91016 21.78 2.91016 21.5C2.91016 17.36 6.99015 14 12.0002 14C13.0302 14 14.0302 14.14 14.9502 14.41C14.3602 15.11 14.0002 16.02 14.0002 17C14.0002 17.75 14.2101 18.46 14.5801 19.06C14.7801 19.4 15.0401 19.71 15.3401 19.97C16.0401 20.61 16.9702 21 18.0002 21C19.1202 21 20.1302 20.54 20.8502 19.8C21.0102 20.34 21.0901 20.91 21.0901 21.5Z"
                                    fill="#0f4c75"></path>
                                <path
                                    d="M21.8807 16.04C21.7807 15.65 21.6207 15.26 21.4007 14.91C21.2507 14.65 21.0507 14.4 20.8307 14.17C20.1107 13.45 19.1707 13.06 18.2107 13.01C17.1207 12.94 16.0107 13.34 15.1707 14.17C14.3807 14.96 13.9807 16.01 14.0007 17.06C14.0107 18.06 14.4107 19.06 15.1707 19.83C15.7007 20.36 16.3507 20.71 17.0407 20.87C17.4207 20.97 17.8207 21.01 18.2207 20.98C19.1707 20.94 20.1007 20.56 20.8307 19.83C21.8607 18.8 22.2107 17.35 21.8807 16.04ZM19.6007 18.6C19.3107 18.89 18.8307 18.89 18.5407 18.6L17.9907 18.05L17.4607 18.58C17.1707 18.87 16.6907 18.87 16.4007 18.58C16.1107 18.28 16.1107 17.81 16.4007 17.52L16.9307 16.99L16.4207 16.49C16.1307 16.19 16.1307 15.72 16.4207 15.42C16.7207 15.13 17.1907 15.13 17.4907 15.42L17.9907 15.93L18.5207 15.4C18.8107 15.11 19.2807 15.11 19.5807 15.4C19.8707 15.69 19.8707 16.17 19.5807 16.46L19.0507 16.99L19.6007 17.54C19.8907 17.83 19.8907 18.31 19.6007 18.6Z"
                                    fill="#0f4c75"></path>
                                <path
                                    d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z"
                                    fill="#0f4c75"></path>
                            </g>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        Gratis dan Tanpa Registrasi
                    </h3>
                    <p class="mt-2 text-base text-gray-600">
                        Gunakan semua fitur Fileswift secara gratis, tanpa perlu membuat akun atau login — langsung unggah
                        dan konversi.
                    </p>
                </div>

            </div>

        </div>
    </section>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        // GSAP Animations
        gsap.registerPlugin();

        // Hero text animation
        gsap.from(".hero-text h1", {
            duration: 1,
            y: 50,
            opacity: 0,
            ease: "power3.out"
        });

        gsap.from(".hero-text p", {
            duration: 1,
            y: 30,
            opacity: 0,
            delay: 0.3,
            ease: "power3.out"
        });

        // Hero visual animation
        gsap.from(".hero-visual", {
            duration: 1.2,
            scale: 0.8,
            opacity: 0,
            delay: 0.5,
            ease: "power3.out"
        });

        // File icons animation
        gsap.from(".file-icon", {
            duration: 0.8,
            scale: 0,
            opacity: 0,
            delay: 0.8,
            stagger: 0.1,
            ease: "back.out(1.7)"
        });

        // Counter animation
        function animateCounter() {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                let current = 0;
                const increment = target / 100;

                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = Math.floor(current).toLocaleString();
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target.toLocaleString();
                    }
                };

                updateCounter();
            });
        }

        // Start counter animation when hero section is visible
        setTimeout(animateCounter, 1500);

        // Add scroll effect to navbar
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 100) {
                nav.classList.add('bg-white/95');
            } else {
                nav.classList.remove('bg-white/95');
            }
        });

        // Mobile menu toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Demo function
        function playDemo() {
            alert('Demo akan segera hadir! 🚀');
        }

        // Add click effects to conversion cards
        document.querySelectorAll('.conversion-card').forEach(card => {
            card.addEventListener('click', (e) => {
                gsap.to(card, {
                    duration: 0.1,
                    scale: 0.95,
                    yoyo: true,
                    repeat: 1,
                    ease: "power2.inOut"
                });
            });
        });
    </script>
@endpush
