<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fileswift - Konversi File Online Gratis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
        }

        .hover-lift {
            transition: transform 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .pulse-glow {
            animation: pulse-glow 2s infinite;
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
            }

            50% {
                box-shadow: 0 0 30px rgba(102, 126, 234, 0.6);
            }
        }
    </style>
</head>

<body class="bg-gray-50 overflow-x-hidden">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-effect border-b border-white/20">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div
                        class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-exchange-alt text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-800">Fileswift</span>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#beranda" class="text-gray-700 hover:text-blue-600 transition-colors">Beranda</a>
                    <a href="#fitur" class="text-gray-700 hover:text-blue-600 transition-colors">Fitur</a>
                    <a href="#tentang" class="text-gray-700 hover:text-blue-600 transition-colors">Tentang</a>
                    <a href="#kontak" class="text-gray-700 hover:text-blue-600 transition-colors">Kontak</a>
                </div>
                <button class="md:hidden text-gray-700">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="gradient-bg min-h-screen flex items-center relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full floating"></div>
        <div class="absolute top-40 right-20 w-16 h-16 bg-white/10 rounded-full floating" style="animation-delay: -1s;">
        </div>
        <div class="absolute bottom-40 left-20 w-12 h-12 bg-white/10 rounded-full floating"
            style="animation-delay: -2s;"></div>

        <div class="container mx-auto px-6 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-white space-y-8">
                    <div class="hero-text">
                        <h1 class="text-5xl lg:text-6xl font-bold leading-tight">
                            Konversi File
                            <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">
                                Super Mudah
                            </span>
                        </h1>
                        <p class="text-xl text-white/90 mt-6 leading-relaxed">
                            Ubah format file Anda dalam hitungan detik. PDF, Word, Excel, Gambar, Audio, Video - semua
                            bisa dikonversi gratis tanpa perlu daftar akun!
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <button onclick="scrollToConverter()"
                            class="bg-white text-blue-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transition-all duration-300 pulse-glow hover-lift">
                            <i class="fas fa-rocket mr-2"></i>
                            Mulai Konversi Sekarang
                        </button>
                        <button
                            class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300">
                            <i class="fas fa-play mr-2"></i>
                            Lihat Demo
                        </button>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 pt-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold counter" data-target="50000">0</div>
                            <div class="text-white/80">File Dikonversi</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold counter" data-target="15">0</div>
                            <div class="text-white/80">Format Didukung</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold">100%</div>
                            <div class="text-white/80">Gratis</div>
                        </div>
                    </div>
                </div>

                <!-- Hero Visual -->
                <div class="relative">
                    <div class="hero-visual bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20">
                        <div class="space-y-4">
                            <!-- File Icons -->
                            <div class="grid grid-cols-3 gap-4">
                                <div class="file-icon bg-red-500 text-white p-4 rounded-xl text-center hover-lift">
                                    <i class="fas fa-file-pdf text-2xl mb-2"></i>
                                    <div class="text-sm">PDF</div>
                                </div>
                                <div class="file-icon bg-blue-500 text-white p-4 rounded-xl text-center hover-lift">
                                    <i class="fas fa-file-word text-2xl mb-2"></i>
                                    <div class="text-sm">Word</div>
                                </div>
                                <div class="file-icon bg-green-500 text-white p-4 rounded-xl text-center hover-lift">
                                    <i class="fas fa-file-excel text-2xl mb-2"></i>
                                    <div class="text-sm">Excel</div>
                                </div>
                            </div>
                            <div class="text-center text-white/80">
                                <i class="fas fa-arrows-alt-v text-2xl animate-bounce"></i>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="file-icon bg-purple-500 text-white p-4 rounded-xl text-center hover-lift">
                                    <i class="fas fa-image text-2xl mb-2"></i>
                                    <div class="text-sm">JPG</div>
                                </div>
                                <div class="file-icon bg-orange-500 text-white p-4 rounded-xl text-center hover-lift">
                                    <i class="fas fa-music text-2xl mb-2"></i>
                                    <div class="text-sm">MP3</div>
                                </div>
                                <div class="file-icon bg-pink-500 text-white p-4 rounded-xl text-center hover-lift">
                                    <i class="fas fa-video text-2xl mb-2"></i>
                                    <div class="text-sm">MP4</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Fitur Unggulan</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Semua yang Anda butuhkan untuk konversi file dalam satu platform
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Cards -->
                <div
                    class="feature-card bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl hover-lift border border-blue-200">
                    <div class="w-16 h-16 bg-blue-500 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">100% Aman</h3>
                    <p class="text-gray-600">File Anda diproses dengan enkripsi SSL dan otomatis dihapus setelah 30
                        menit.</p>
                </div>

                <div
                    class="feature-card bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-2xl hover-lift border border-green-200">
                    <div class="w-16 h-16 bg-green-500 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-rocket text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Super Cepat</h3>
                    <p class="text-gray-600">Konversi file dalam hitungan detik dengan teknologi cloud processing
                        terdepan.</p>
                </div>

                <div
                    class="feature-card bg-gradient-to-br from-purple-50 to-purple-100 p-8 rounded-2xl hover-lift border border-purple-200">
                    <div class="w-16 h-16 bg-purple-500 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-magic text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Tanpa Daftar</h3>
                    <p class="text-gray-600">Langsung pakai tanpa perlu registrasi atau memberikan email pribadi Anda.
                    </p>
                </div>

                <div
                    class="feature-card bg-gradient-to-br from-orange-50 to-orange-100 p-8 rounded-2xl hover-lift border border-orange-200">
                    <div class="w-16 h-16 bg-orange-500 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-mobile-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Responsive</h3>
                    <p class="text-gray-600">Berfungsi sempurna di semua perangkat - desktop, tablet, maupun
                        smartphone.</p>
                </div>

                <div
                    class="feature-card bg-gradient-to-br from-red-50 to-red-100 p-8 rounded-2xl hover-lift border border-red-200">
                    <div class="w-16 h-16 bg-red-500 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-infinity text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Unlimited</h3>
                    <p class="text-gray-600">Tidak ada batasan jumlah file yang bisa Anda konversi setiap harinya.</p>
                </div>

                <div
                    class="feature-card bg-gradient-to-br from-indigo-50 to-indigo-100 p-8 rounded-2xl hover-lift border border-indigo-200">
                    <div class="w-16 h-16 bg-indigo-500 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-star text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Kualitas Terbaik</h3>
                    <p class="text-gray-600">Hasil konversi berkualitas tinggi dengan kompresi optimal tanpa mengurangi
                        kualitas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Conversion Types -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Jenis Konversi</h2>
                <p class="text-xl text-gray-600">Pilih kategori konversi yang Anda butuhkan</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="conversion-card bg-white p-6 rounded-2xl shadow-lg hover-lift cursor-pointer group">
                    <div class="text-center">
                        <div
                            class="w-20 h-20 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-file-alt text-white text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">📄 Dokumen</h3>
                        <p class="text-gray-600 text-sm mb-4">PDF ↔ Word, Excel, PowerPoint</p>
                        <div class="text-blue-600 text-sm font-semibold">5 Format →</div>
                    </div>
                </div>

                <div class="conversion-card bg-white p-6 rounded-2xl shadow-lg hover-lift cursor-pointer group">
                    <div class="text-center">
                        <div
                            class="w-20 h-20 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-image text-white text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">📷 Gambar</h3>
                        <p class="text-gray-600 text-sm mb-4">JPG, PNG, WEBP, PDF</p>
                        <div class="text-green-600 text-sm font-semibold">4 Format →</div>
                    </div>
                </div>

                <div class="conversion-card bg-white p-6 rounded-2xl shadow-lg hover-lift cursor-pointer group">
                    <div class="text-center">
                        <div
                            class="w-20 h-20 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-music text-white text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">🎵 Audio</h3>
                        <p class="text-gray-600 text-sm mb-4">MP3, WAV, M4A, OGG</p>
                        <div class="text-purple-600 text-sm font-semibold">4 Format →</div>
                    </div>
                </div>

                <div class="conversion-card bg-white p-6 rounded-2xl shadow-lg hover-lift cursor-pointer group">
                    <div class="text-center">
                        <div
                            class="w-20 h-20 bg-gradient-to-r from-red-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <i class="fas fa-video text-white text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">🎞️ Video</h3>
                        <p class="text-gray-600 text-sm mb-4">MP4, WEBM, AVI</p>
                        <div class="text-red-600 text-sm font-semibold">3 Format →</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 gradient-bg relative overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center text-white">
                <h2 class="text-4xl font-bold mb-6">Siap Memulai Konversi?</h2>
                <p class="text-xl mb-8 text-white/90 max-w-2xl mx-auto">
                    Bergabung dengan ribuan pengguna yang sudah merasakan kemudahan konversi file bersama FileConvert
                    Pro
                </p>
                <button onclick="scrollToConverter()"
                    class="bg-white text-blue-600 px-10 py-5 rounded-full font-bold text-xl hover:bg-gray-100 transition-all duration-300 pulse-glow hover-lift">
                    <i class="fas fa-arrow-right mr-3"></i>
                    Mulai Konversi Gratis
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div
                            class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-exchange-alt text-white text-sm"></i>
                        </div>
                        <span class="text-xl font-bold">FileConvert Pro</span>
                    </div>
                    <p class="text-gray-400">Platform konversi file online terpercaya dan gratis untuk semua kebutuhan
                        Anda.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Konversi</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">PDF ke Word</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">JPG ke PNG</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">MP4 ke WEBM</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">MP3 ke WAV</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Bantuan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Tutorial</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Kontak</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-400 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-pink-600 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 FileConvert Pro. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

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

        // Feature cards animation on scroll
        gsap.from(".feature-card", {
            scrollTrigger: {
                trigger: ".feature-card",
                start: "top 80%",
            },
            duration: 0.8,
            y: 50,
            opacity: 0,
            stagger: 0.1,
            ease: "power3.out"
        });

        // Conversion cards animation
        gsap.from(".conversion-card", {
            scrollTrigger: {
                trigger: ".conversion-card",
                start: "top 80%",
            },
            duration: 0.8,
            scale: 0.8,
            opacity: 0,
            stagger: 0.1,
            ease: "power3.out"
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

        // Smooth scroll function
        function scrollToConverter() {
            // For now, just scroll to features section
            document.getElementById('fitur').scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Add scroll effect to navbar
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 100) {
                nav.classList.add('bg-white/95');
            } else {
                nav.classList.remove('bg-white/95');
            }
        });

        // Add click effects to conversion cards
        document.querySelectorAll('.conversion-card').forEach(card => {
            card.addEventListener('click', () => {
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
</body>

</html>
