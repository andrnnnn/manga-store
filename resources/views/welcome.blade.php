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
            background-color: #6366F1;
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
            background-color: #6366F1;
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
            flex: 0 0 220px;
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
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-20 h-20">
                    <span class="font-semibold text-lg text-primary-dark hover:text-primary transition-colors">Manga Store</span>
                </div>

                <!-- Navigation Links -->
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

                <!-- Auth Buttons -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-primary hover:text-primary-dark transition-colors hover:scale-105">
                        <i class="fas fa-sign-in-alt mr-1"></i> Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition-all hover:scale-105 hover:shadow-lg">
                        <i class="fas fa-user-plus mr-1"></i> Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-b from-primary/10 to-transparent py-20 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-primary-dark mb-4">Yokoso! Manga Store e Youkoso!</h1>
            <p class="text-primary max-w-2xl mx-auto">Tempat nongkrong para wibu sejati! Koleksi manga terlengkap dengan harga kawaii~</p>
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
                    <i class="fas fa-sign-in-alt"></i> Masuk untuk melihat lebih banyak
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
                        <form class="space-y-4">
                            <div>
                                <label class="block text-primary mb-2">Nama</label>
                                <input type="text" class="w-full px-4 py-2 rounded-lg border border-primary" required>
                            </div>
                            <div>
                                <label class="block text-primary mb-2">Email</label>
                                <input type="email" class="w-full px-4 py-2 rounded-lg border border-primary" required>
                            </div>
                            <div>
                                <label class="block text-primary mb-2">Pesan</label>
                                <textarea class="w-full px-4 py-2 rounded-lg border border-primary h-32" required></textarea>
                            </div>
                            <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark transition-colors">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary-dark py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center text-white">
                <p class="mb-4">Manga Store - Toko manga terpercaya dengan koleksi berkualitas</p>
                <p class="mb-4">
                    <i class="fas fa-envelope"></i> info@mangastore.com |
                    <i class="fas fa-phone"></i> (021) 1234-5678 |
                    <i class="fas fa-map-marker-alt"></i> Jl. Akihabara No. 123, Jakarta
                </p>
                <div class="mb-4">
                    <a href="https://www.facebook.com" class="text-white hover:text-gray-300 transition-colors mx-2">
                        <i class="fab fa-facebook fa-lg"></i>
                    </a>
                    <a href="https://www.twitter.com" class="text-white hover:text-gray-300 transition-colors mx-2">
                        <i class="fab fa-twitter fa-lg"></i>
                    </a>
                    <a href="https://www.instagram.com" class="text-white hover:text-gray-300 transition-colors mx-2">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                </div>
                <p class="text-gray-300">&copy; {{ date('Y') }} Manga Store. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const backToTopButton = document.getElementById('backToTop');
            
            // Show/hide button based on scroll position
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) { // Show button after scrolling 300px
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
        });
    </script>
</body>
</html>
