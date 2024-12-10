@extends('user.layouts.app')

@section('title', 'Dashboard - MangaStore')

@push('styles')
<style>
    /* Hover dan transisi seperti login.blade.php */
    input:hover, select:hover {
        border-color: #6366F1;
        transition-colors: 0.3s;
    }

    input:focus, select:focus {
        ring: 1;
        ring-color: #6366F1;
        border-color: #6366F1;
        outline: none;
    }
</style>
@endpush

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <!-- Search and Filter Section -->
                <div class="mb-8">
                    <!-- Search and Sort Bar -->
                    <div class="flex flex-col md:flex-row gap-4 mb-6">
                        <!-- Search Bar -->
                        <div class="relative flex-1">
                            <input type="text"
                                id="searchInput"
                                class="w-full px-4 py-3 pl-12 rounded-lg border border-primary-light focus:ring-1 focus:ring-primary focus:border-primary focus:outline-none hover:border-primary transition-colors"
                                placeholder="Manga apa yang kamu cari, Senpai?">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Sort Dropdown -->
                        <div class="relative min-w-[200px]">
                            <select id="sortSelect" class="w-full px-4 py-3 rounded-lg border border-primary-light focus:ring-1 focus:ring-primary focus:border-primary focus:outline-none hover:border-primary transition-colors appearance-none cursor-pointer bg-white">
                                <option value="default">Sort by apa nih, Senpai?</option>
                                <option value="price_asc">Yang murah dulu dong~</option>
                                <option value="price_desc">Yang mahal juga boleh!</option>
                                <option value="date_desc">Yang baru release desu~</option>
                                <option value="date_asc">Yang lama-lama dulu</option>
                                <option value="title_asc">A-Z no Jutsu!</option>
                                <option value="title_desc">Z-A no Jutsu!</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Category Tags -->
                    <div class="flex flex-wrap gap-2" id="categoryTags">
                        @php
                        $categories = [
                            'all' => 'Semua Genre',
                            'action' => 'Shōnen',
                            'romance' => 'Romance',
                            'comedy' => 'Comedy',
                            'fantasy' => 'Isekai',
                            'horror' => 'Horror',
                            'slice-of-life' => 'Slice of Life'
                        ];
                        @endphp

                        @foreach($categories as $value => $label)
                        <button
                            data-category="{{ $value }}"
                            class="category-tag {{ $value === 'all' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700' }} px-4 py-2 rounded-full text-sm font-medium hover:bg-opacity-90 transition-all">
                            {{ $label }}
                        </button>
                        @endforeach
                    </div>
                </div>

                <!-- Daftar Manga -->
                <div id="mangaList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Manga Card 1 -->
                    <div class="manga-card bg-white rounded-xl shadow overflow-hidden"
                         data-category="action fantasy"
                         data-title="One Piece"
                         data-price="50000"
                         data-date="2024-03-23">
                        <img src="https://via.placeholder.com/300x400" alt="Manga Cover" class="w-full h-64 object-cover">
                        <div class="p-4">
                            <div class="flex flex-wrap gap-1 mb-2">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Action</span>
                                <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">Fantasy</span>
                            </div>
                            <h3 class="text-lg font-semibold mb-2">One Piece</h3>
                            <p class="text-gray-600 text-sm mb-2">Penulis: Eiichiro Oda</p>
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-primary">Rp {{ number_format(50000, 0, ',', '.') }}</span>
                                <a href="{{ route('user.manga.detail', 1) }}" class="bg-gray-100 text-gray-600 px-3 py-1 rounded-lg text-sm hover:bg-gray-200">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Manga Card 2 -->
                    <div class="manga-card bg-white rounded-xl shadow overflow-hidden"
                         data-category="romance comedy"
                         data-title="Kimi ni Todoke"
                         data-price="45000"
                         data-date="2024-03-22">
                        <img src="https://via.placeholder.com/300x400" alt="Manga Cover" class="w-full h-64 object-cover">
                        <div class="p-4">
                            <div class="flex flex-wrap gap-1 mb-2">
                                <span class="px-2 py-1 bg-pink-100 text-pink-800 rounded-full text-xs">Romance</span>
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Comedy</span>
                            </div>
                            <h3 class="text-lg font-semibold mb-2">Kimi ni Todoke</h3>
                            <p class="text-gray-600 text-sm mb-2">Penulis: Karuho Shiina</p>
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-primary">Rp {{ number_format(45000, 0, ',', '.') }}</span>
                                <a href="{{ route('user.manga.detail', 2) }}" class="bg-gray-100 text-gray-600 px-3 py-1 rounded-lg text-sm hover:bg-gray-200">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Manga Card 3 -->
                    <div class="manga-card bg-white rounded-xl shadow overflow-hidden"
                         data-category="slice-of-life comedy"
                         data-title="Yotsuba"
                         data-price="40000"
                         data-date="2024-03-21">
                        <img src="https://via.placeholder.com/300x400" alt="Manga Cover" class="w-full h-64 object-cover">
                        <div class="p-4">
                            <div class="flex flex-wrap gap-1 mb-2">
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Slice of Life</span>
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Comedy</span>
                            </div>
                            <h3 class="text-lg font-semibold mb-2">Yotsuba&!</h3>
                            <p class="text-gray-600 text-sm mb-2">Penulis: Kiyohiko Azuma</p>
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-primary">Rp {{ number_format(40000, 0, ',', '.') }}</span>
                                <a href="{{ route('user.manga.detail', 3) }}" class="bg-gray-100 text-gray-600 px-3 py-1 rounded-lg text-sm hover:bg-gray-200">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Manga Card 4 -->
                    <div class="manga-card bg-white rounded-xl shadow overflow-hidden"
                         data-category="horror"
                         data-title="Junji Ito Collection"
                         data-price="55000"
                         data-date="2024-03-20">
                        <img src="https://via.placeholder.com/300x400" alt="Manga Cover" class="w-full h-64 object-cover">
                        <div class="p-4">
                            <div class="flex flex-wrap gap-1 mb-2">
                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Horror</span>
                            </div>
                            <h3 class="text-lg font-semibold mb-2">Junji Ito Collection</h3>
                            <p class="text-gray-600 text-sm mb-2">Penulis: Junji Ito</p>
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-primary">Rp {{ number_format(55000, 0, ',', '.') }}</span>
                                <a href="{{ route('user.manga.detail', 4) }}" class="bg-gray-100 text-gray-600 px-3 py-1 rounded-lg text-sm hover:bg-gray-200">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- No Results Message -->
                <div id="noResults" class="hidden text-center py-8">
                    <p class="text-gray-500">Gomenasai, manga yang kamu cari tidak ditemukan</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const sortSelect = document.getElementById('sortSelect');
    const mangaCards = document.querySelectorAll('.manga-card');
    const noResults = document.getElementById('noResults');
    const categoryTags = document.querySelectorAll('.category-tag');
    let activeCategories = new Set(['all']);

    // Search functionality
    searchInput.addEventListener('input', filterAndSortManga);

    // Sort functionality
    sortSelect.addEventListener('change', filterAndSortManga);

    // Category filter functionality
    categoryTags.forEach(tag => {
        tag.addEventListener('click', function() {
            const category = this.dataset.category;

            if (category === 'all') {
                activeCategories.clear();
                activeCategories.add('all');
                categoryTags.forEach(t => {
                    if (t.dataset.category === 'all') {
                        t.classList.remove('bg-gray-100', 'text-gray-700');
                        t.classList.add('bg-primary', 'text-white');
                    } else {
                        t.classList.remove('bg-primary', 'text-white');
                        t.classList.add('bg-gray-100', 'text-gray-700');
                    }
                });
            } else {
                if (activeCategories.has('all')) {
                    activeCategories.clear();
                    document.querySelector('[data-category="all"]').classList.remove('bg-primary', 'text-white');
                    document.querySelector('[data-category="all"]').classList.add('bg-gray-100', 'text-gray-700');
                }

                if (activeCategories.has(category)) {
                    activeCategories.delete(category);
                    this.classList.remove('bg-primary', 'text-white');
                    this.classList.add('bg-gray-100', 'text-gray-700');

                    if (activeCategories.size === 0) {
                        activeCategories.add('all');
                        document.querySelector('[data-category="all"]').classList.remove('bg-gray-100', 'text-gray-700');
                        document.querySelector('[data-category="all"]').classList.add('bg-primary', 'text-white');
                    }
                } else {
                    activeCategories.add(category);
                    this.classList.remove('bg-gray-100', 'text-gray-700');
                    this.classList.add('bg-primary', 'text-white');
                }
            }

            filterAndSortManga();
        });
    });

    function filterAndSortManga() {
        const searchTerm = searchInput.value.toLowerCase();
        const sortValue = sortSelect.value;
        let visibleCards = [];

        // Filter
        mangaCards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const author = card.querySelector('p').textContent.toLowerCase();
            const categories = card.dataset.category.split(' ');

            const matchesSearch = title.includes(searchTerm) || author.includes(searchTerm);
            const matchesCategory = activeCategories.has('all') ||
                                  categories.some(cat => activeCategories.has(cat));

            if (matchesSearch && matchesCategory) {
                card.classList.remove('hidden');
                visibleCards.push(card);
            } else {
                card.classList.add('hidden');
            }
        });

        // Sort
        visibleCards.sort((a, b) => {
            switch(sortValue) {
                case 'price_asc':
                    return parseInt(a.dataset.price) - parseInt(b.dataset.price);
                case 'price_desc':
                    return parseInt(b.dataset.price) - parseInt(a.dataset.price);
                case 'date_desc':
                    return new Date(b.dataset.date) - new Date(a.dataset.date);
                case 'date_asc':
                    return new Date(a.dataset.date) - new Date(b.dataset.date);
                case 'title_asc':
                    return a.dataset.title.localeCompare(b.dataset.title);
                case 'title_desc':
                    return b.dataset.title.localeCompare(a.dataset.title);
                default:
                    return 0;
            }
        });

        // Reorder DOM
        const mangaList = document.getElementById('mangaList');
        visibleCards.forEach(card => {
            mangaList.appendChild(card);
        });

        // Show/hide no results message
        noResults.classList.toggle('hidden', visibleCards.length > 0);
    }
});
</script>
@endsection
