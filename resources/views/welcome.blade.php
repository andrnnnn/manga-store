<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Surga Para Wibu</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #backToTop {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99;
            cursor: pointer;
            padding: 15px;
            border-radius: 50%;
            background-color: #3538dd;
            color: white;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        #backToTop.visible {
            opacity: 1;
            visibility: visible;
        }

        #backToTop:hover {
            background-color: #080a83;
            transform: translateY(-3px);
        }

            .manga-slider {
            overflow: hidden;
            position: relative;
            width: 100%;
        }

        .manga-track {
            display: flex;
            animation: slide 40s linear infinite;
        }

        .manga-card {
            flex: 0 0 280px;
            margin-right: 20px;
        }

        @keyframes slide {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-100%);
            }
        }

        .manga-track:hover {
            animation-play-state: paused;
        }

        /* Responsif untuk manga slider */
        .manga-card {
            flex: 0 0 280px;
            margin-right: 20px;
        }

        @media (max-width: 640px) {
            .manga-card {
                flex: 0 0 220px;
            }
        }

        /* Responsif untuk about section */
        @media (max-width: 768px) {
            .grid-cols-2 {
                grid-template-columns: 1fr;
            }
        }

        /* Responsif untuk contact form */
        @media (max-width: 768px) {
            .contact-form input,
            .contact-form textarea {
                font-size: 16px;
            }
        }

        /* Hover dan transisi seperti login.blade.php */
        input:hover, textarea:hover {
            border-color: #6366F1;
            transition-colors: 0.3s;
        }

        input:focus, textarea:focus {
            ring: 1;
            ring-color: #6366F1;
            border-color: #6366F1;
            outline: none;
        }

        button[type="submit"]:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .loading-icon {
            display: none;
        }

        button[type="submit"]:disabled .loading-icon {
            display: inline-block;
        }
    </style>
</head>
<body class="bg-primary-light min-h-screen font-[Poppins]">
    <!-- Back to Top Button -->
    <button id="backToTop" title="Kembali ke atas">
        <i class="fas fa-arrow-up fa-lg"></i>
    </button>

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 bg-surface-light shadow-md backdrop-blur-sm bg-opacity-90 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Brand -->
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-16">
                    <span class="font-semibold text-base sm:text-lg text-primary-dark hover:text-primary transition-colors">{{ config('app.name') }}</span>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobileMenuBtn" class="text-primary p-2">
                        <i class="fas fa-bars fa-lg"></i>
                    </button>
                </div>

                <!-- Navigation Links - Desktop -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#manga" class="text-primary hover:text-primary-dark transition-colors nav-link relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-primary-dark after:left-0 after:-bottom-1 after:transition-all after:duration-300 hover:after:w-full">
                        Koleksi Manga
                    </a>
                    <a href="#about" class="text-primary hover:text-primary-dark transition-colors nav-link relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-primary-dark after:left-0 after:-bottom-1 after:transition-all after:duration-300 hover:after:w-full">
                        Tentang Kami
                    </a>
                    <a href="#contact" class="text-primary hover:text-primary-dark transition-colors nav-link relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-primary-dark after:left-0 after:-bottom-1 after:transition-all after:duration-300 hover:after:w-full">
                        Hubungi Kami
                    </a>
                </div>

                <!-- Auth Buttons - Desktop -->
                <div class="hidden md:flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-primary hover:text-primary-dark transition-colors hover:scale-105">
                        <i class="fas fa-sign-in-alt mr-1"></i> Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition-all hover:scale-105 hover:shadow-lg">
                        <i class="fas fa-user-plus mr-1"></i> Register
                    </a>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="#manga" class="block px-3 py-2 text-primary hover:text-primary-dark transition-colors">
                        Koleksi Manga
                    </a>
                    <a href="#about" class="block px-3 py-2 text-primary hover:text-primary-dark transition-colors">
                        Tentang Kami
                    </a>
                    <a href="#contact" class="block px-3 py-2 text-primary hover:text-primary-dark transition-colors">
                        Hubungi Kami
                    </a>
                    <div class="border-t border-gray-200 my-2"></div>
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-primary hover:text-primary-dark transition-colors">
                        <i class="fas fa-sign-in-alt mr-1"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 text-primary hover:text-primary-dark transition-colors">
                        <i class="fas fa-user-plus mr-1"></i> Register
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-b from-primary/10 to-transparent py-12 sm:py-20 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-primary-dark mb-4">Yokoso! MangaStore e Youkoso!</h1>
            <p class="text-primary text-sm sm:text-base max-w-2xl mx-auto">Tempat nongkrong para wibu sejati! Koleksi manga terlengkap dengan harga kawaii~</p>
        </div>
    </div>

    <!-- Featured Manga Section -->
    <section id="manga" class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-primary-dark mb-8">Manga Pilihan</h2>

            <div class="manga-slider">
                <div class="manga-track">
                    @foreach($featuredMangas as $manga)
                        <div class="manga-card bg-surface-light rounded-xl shadow-lg overflow-hidden">
                            <img src="{{ asset($manga->cover_url) }}" alt="{{ $manga->title }}"
                                class="w-full h-[320px] object-cover">
                            <div class="p-4">
                                <h3 class="font-semibold text-primary-dark">{{ $manga->title }}</h3>
                                <p class="text-primary mt-2">Rp {{ number_format($manga->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                    @foreach($featuredMangas as $manga)
                        <div class="manga-card bg-surface-light rounded-xl shadow-lg overflow-hidden">
                            <img src="{{ asset($manga->cover_url) }}" alt="{{ $manga->title }}"
                                class="w-full h-[320px] object-cover">
                            <div class="p-4">
                                <h3 class="font-semibold text-primary-dark">{{ $manga->title }}</h3>
                                <p class="text-primary mt-2">Rp {{ number_format($manga->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('login') }}"
                    class="inline-block bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary-dark transition-colors">
                    Masuk untuk melihat lebih banyak
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-surface-light">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-primary-dark mb-8">Tentang Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md transform hover:scale-105 transition-transform">
                    <div class="flex items-center justify-center mb-6">
                        <i class="fas fa-book-open text-5xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary-dark text-center mb-4">Koleksi Terlengkap</h3>
                    <p class="text-primary text-center">
                        Nikmati ribuan koleksi manga dari berbagai genre. Dari manga klasik hingga terbaru, semuanya tersedia untuk Anda.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md transform hover:scale-105 transition-transform">
                    <div class="flex items-center justify-center mb-6">
                        <i class="fas fa-tags text-5xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary-dark text-center mb-4">Harga Bersahabat</h3>
                    <p class="text-primary text-center">
                        Dapatkan manga favorit Anda dengan harga terbaik. Nikmati juga berbagai promo menarik dan diskon spesial setiap bulannya.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md transform hover:scale-105 transition-transform">
                    <div class="flex items-center justify-center mb-6">
                        <i class="fas fa-shipping-fast text-5xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary-dark text-center mb-4">Pengiriman Cepat</h3>
                    <p class="text-primary text-center">
                        Kami menjamin pengiriman yang cepat dan aman ke seluruh Indonesia. Lacak pesanan Anda secara real-time.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md transform hover:scale-105 transition-transform">
                    <div class="flex items-center justify-center mb-6">
                        <i class="fas fa-users text-5xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary-dark text-center mb-4">Komunitas</h3>
                    <p class="text-primary text-center">
                        Bergabunglah dengan komunitas pecinta manga kami. Diskusikan manga favorit dan dapatkan rekomendasi terbaik.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-primary-dark mb-8">Hubungi Kami Senpai~</h2>
            <div class="bg-surface-light rounded-xl p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="font-semibold text-primary-dark mb-4">Info Kontak</h3>
                        <div class="space-y-4 text-primary">
                            <p><i class="fas fa-envelope"></i> Email: info@mangastore.com</p>
                            <p><i class="fas fa-phone"></i> Telepon: (021) 1234-5678</p>
                            <p><i class="fas fa-map-marker-alt"></i> Alamat: Jl. Akihabara No. 123, Jakarta</p>
                        </div>
                        <div class="mt-6">
                            <h3 class="font-semibold text-primary-dark mb-4">Jam Operasional</h3>
                            <div class="space-y-2 text-primary">
                                <p><i class="fas fa-clock"></i> Senin - Jumat: 09:00 - 21:00</p>
                                <p><i class="fas fa-clock"></i> Sabtu - Minggu: 10:00 - 22:00</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-primary-dark mb-4">Kirim Pesan</h3>
                        <form class="space-y-4" id="contactForm">
                            <div>
                                <label class="block text-sm font-medium text-primary mb-2">Nama</label>
                                <input type="text" class="w-full px-4 py-2 rounded-lg border border-primary-light focus:ring-1 focus:ring-primary focus:border-primary focus:outline-none hover:border-primary transition-colors" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-primary mb-2">Email</label>
                                <input type="email" class="w-full px-4 py-2 rounded-lg border border-primary-light focus:ring-1 focus:ring-primary focus:border-primary focus:outline-none hover:border-primary transition-colors" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-primary mb-2">Pesan</label>
                                <textarea class="w-full px-4 py-2 rounded-lg border border-primary-light focus:ring-1 focus:ring-primary focus:border-primary focus:outline-none hover:border-primary transition-colors h-32" required></textarea>
                            </div>
                            <button type="submit" id="submitButton" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark transition-colors">
                                <span id="buttonText">Kirim Pesan</span>
                                <i id="loadingIcon" class="fas fa-spinner fa-spin ml-2 hidden"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary-dark mt-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand & Description -->
                <div class="col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="MangaStore Logo" class="h-8 w-auto">
                        <span class="text-xl font-bold text-white">MangaStore</span>
                    </div>
                    <p class="text-gray-300 mb-4">
                        Temukan koleksi manga terlengkap dan terbaru. Jelajahi dunia manga dengan berbagai genre menarik.
                    </p>
                    <div class="flex gap-4">
                        <a href="https://www.facebook.com" class="text-gray-300 hover:text-white transition-colors">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="https://www.twitter.com" class="text-gray-300 hover:text-white transition-colors">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="https://www.instagram.com" class="text-gray-300 hover:text-white transition-colors">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-4">
                        Quick Links
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#manga" class="text-gray-300 hover:text-white transition-colors">
                                Koleksi Manga
                            </a>
                        </li>
                        <li>
                            <a href="#about" class="text-gray-300 hover:text-white transition-colors">
                                Tentang Kami
                            </a>
                        </li>
                        <li>
                            <a href="#contact" class="text-gray-300 hover:text-white transition-colors">
                                Hubungi Kami
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-4">
                        Contact
                    </h3>
                    <ul class="space-y-3">
                        <li class="text-gray-300">
                            <span class="block">Email:</span>
                            info@mangastore.com
                        </li>
                        <li class="text-gray-300">
                            <span class="block">Phone:</span>
                            (021) 1234-5678
                        </li>
                        <li class="text-gray-300">
                            <span class="block">Address:</span>
                            Jl. Akihabara No. 123<br>
                            Jakarta, Indonesia
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-600">
                <p class="text-gray-300 text-sm text-center">
                    © {{ date('Y') }} MangaStore. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const backToTopButton = document.getElementById('backToTop');
            const contactForm = document.getElementById('contactForm');
            const submitButton = document.getElementById('submitButton');
            const buttonText = document.getElementById('buttonText');
            const loadingIcon = document.getElementById('loadingIcon');

            // Show/hide button based on scroll position
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.add('visible');
                } else {
                    backToTopButton.classList.remove('visible');
                }
            });

            // Scroll to top when button is clicked
            backToTopButton.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Contact form submission
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                submitButton.disabled = true;
                buttonText.textContent = 'Tunggu sebentar ya...';
                loadingIcon.classList.remove('hidden');

                // Simulate form submission
                setTimeout(() => {
                    submitButton.disabled = false;
                    buttonText.textContent = 'Kirim Pesan';
                    loadingIcon.classList.add('hidden');
                    contactForm.reset();
                }, 2000);
            });

            // Smooth scroll for navigation links
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Mobile Menu Toggle
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');

            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenu.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });

            // Close mobile menu when clicking on a link
            const mobileLinks = mobileMenu.querySelectorAll('a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                });
            });
        });
    </script>
</body>
</html>
