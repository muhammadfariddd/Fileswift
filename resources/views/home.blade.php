<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'Konversi File Online Gratis')

@section('content')
    @include('components.hero')

    @include('components.type')

    @include('components.team')

    @include('components.faq')

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
