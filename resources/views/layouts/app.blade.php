<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FileConvert Pro') }} - @yield('title', 'Konversi File Online Gratis')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* .gradient-bg {
            background: linear-gradient(135deg, #3282B8 0%, #0F4C75 100%);
        } */

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

        /* Hero Visual Animations */
        .hero-visual {
            animation: heroVisual 1.5s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes heroVisual {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .file-icon {
            transition: all 0.3s ease;
            animation: fileIconPulse 2s infinite;
        }

        @keyframes fileIconPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .file-icon:hover {
            transform: scale(1.1) translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Counter Animation */
        .counter {
            transition: all 0.5s ease;
        }

        /* Bounce Animation */
        .animate-bounce {
            animation: bounce 1s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(-25%);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }

            50% {
                transform: translateY(0);
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50 overflow-x-hidden">

    <!-- Navigation -->
    @include('components.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('navbar');
            const navLinks = document.querySelectorAll('#navbar .nav-link');

            function updateNavbarStyle() {
                if (window.scrollY < 80) {
                    navbar.classList.remove('bg-white', 'shadow');
                    navbar.classList.add('bg-transparent');
                    // navLinks.forEach(link => {
                    //     link.style.color = 'var(--color-success)';
                    // });
                } else {
                    navbar.classList.remove('bg-transparent');
                    navbar.classList.add('bg-white', 'shadow');
                    // navLinks.forEach(link => {
                    //     link.style.color = 'var(--color-primary)';
                    // });
                }
            }

            updateNavbarStyle();
            window.addEventListener('scroll', updateNavbarStyle);
        });
    </script>
</body>

</html>
