<!-- resources/views/components/navbar.blade.php -->
<nav class="fixed top-0 w-full z-50 bg-transparent transition-colors duration-300" id="navbar">
    <div class="container-fluid mx-auto px-6 py-2">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">

                <a href="{{ route('home') }}" class="text-xl font-bold" style="color: var(--color-dark);">
                    <img src="{{ asset('images/fileswift-logo2.png') }}" alt="Fileswift" class="h-16 w-auto mr-2">
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('convert.index') }}"
                    class="nav-link flex items-center space-x-1 font-semibold transition-colors text-(--color-primary) hover:text-(--color-secondary)">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Konversi File</span>
                </a>
                <a href="{{ route('compress.index') }}"
                    class="nav-link flex items-center space-x-1 font-semibold transition-colors text-(--color-primary) hover:text-(--color-secondary)">
                    <i class="fas fa-compress-alt"></i>
                    <span>Kompres File</span>
                </a>
                <a href="{{ route('merge.index') }}"
                    class="nav-link flex items-center space-x-1 font-semibold transition-colors text-(--color-primary) hover:text-(--color-secondary)">
                    <i class="fas fa-object-group"></i>
                    <span>Gabung PDF</span>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('team') }}"
                    class="nav-link flex items-center space-x-1 font-semibold transition-colors text-(--color-primary) hover:text-(--color-secondary)">
                    <i class="fas fa-users"></i>
                    <span>Tim Developer</span>
                </a>
            </div>

            <button id="hamburger-btn" class="md:hidden text-gray-700" type="button">
                <i id="hamburger-icon" class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu"
            class="hidden fixed inset-0 z-50 bg-black/30 flex items-start justify-center md:hidden transition-3000">
            <!-- Close Button (di pojok kanan atas overlay) -->
            <button id="mobile-close-btn" type="button"
                class="absolute top-6 right-6 text-3xl text-gray-700 focus:outline-none" aria-label="Tutup Menu">
                <i class="fas fa-times"></i>
            </button>
            <!-- Card Menu -->
            <div
                class="relative mt-24 w-full max-w-xs mx-auto bg-white rounded-xl shadow-xl p-8 flex flex-col items-center">
                <nav class="w-full flex flex-col items-center gap-5 mt-2">
                    <a href="{{ route('home') }}"
                        class="text-gray-800 text-lg font-medium hover:text-blue-600 transition flex items-center gap-2"><i
                            class="fas fa-home"></i>Beranda</a>
                    <a href="{{ route('convert.index') }}"
                        class="text-gray-800 text-lg font-medium hover:text-blue-600 transition flex items-center gap-2"><i
                            class="fas fa-exchange-alt"></i>Konversi File</a>
                    <a href="{{ route('compress.index') }}"
                        class="text-gray-800 text-lg font-medium hover:text-blue-600 transition flex items-center gap-2"><i
                            class="fas fa-compress-alt"></i>Kompres File</a>
                    <a href="{{ route('merge.index') }}"
                        class="text-gray-800 text-lg font-medium hover:text-blue-600 transition flex items-center gap-2"><i
                            class="fas fa-object-group"></i>Gabung PDF</a>
                    <a href="{{ route('team') }}"
                        class="text-gray-800 text-lg font-medium hover:text-blue-600 transition flex items-center gap-2"><i
                            class="fas fa-users"></i>Tim Developer</a>
                </nav>

            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileCloseBtn = document.getElementById('mobile-close-btn');
        const cardMenu = mobileMenu ? mobileMenu.querySelector('div.relative') : null;
        if (hamburgerBtn && hamburgerIcon && mobileMenu) {
            hamburgerBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                if (!mobileMenu.classList.contains('hidden')) {
                    hamburgerIcon.classList.remove('fa-bars');
                    // hamburgerIcon.classList.add('fa-times');
                } else {
                    hamburgerIcon.classList.remove('fa-times');
                    hamburgerIcon.classList.add('fa-bars');
                }
            });
        }
        if (mobileCloseBtn && mobileMenu && hamburgerIcon) {
            mobileCloseBtn.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
                hamburgerIcon.classList.remove('fa-times');
                hamburgerIcon.classList.add('fa-bars');
            });
        }
        // Close menu if click outside card
        if (mobileMenu && cardMenu) {
            mobileMenu.addEventListener('mousedown', function(e) {
                if (!cardMenu.contains(e.target) && !e.target.closest('#mobile-close-btn')) {
                    mobileMenu.classList.add('hidden');
                    hamburgerIcon.classList.remove('fa-times');
                    hamburgerIcon.classList.add('fa-bars');
                }
            });
        }
    });
</script>
