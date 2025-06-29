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
                        Kompres File
                        <span
                            class="bg-gradient-to-r from-(--color-primary) to-(--color-secondary) bg-clip-text text-transparent">
                            Super Mudah
                        </span>
                    </h1>
                    <p class="text-xl text-black mt-6 leading-relaxed">
                        Ubah ukuran file Anda dalam hitungan detik. Semua bisa
                        dikompres gratis tanpa perlu daftar akun!
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('compress.index') }}"
                        class="bg-(--color-secondary) text-white px-4 py-2 rounded-md font-semibold text-lg hover:brightness-85 transition-all duration-300">
                        <i class="fas fa-rocket mr-2"></i>
                        Mulai Kompresi Sekarang
                    </a>
                    <a href="#team"
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
