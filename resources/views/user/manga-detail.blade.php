@extends('user.layouts.app')

@section('title', 'Detail Manga')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Tombol Kembali -->
        <div class="mb-6">
            <a href="{{ route('user.dashboard') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium">Kembali ke Halaman Utama</span>
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="md:flex gap-8">
                    <!-- Gambar Manga -->
                    <div class="md:w-1/3">
                        <div class="sticky top-20">
                            <div class="aspect-[3/4] rounded-lg overflow-hidden shadow-lg">
                                <img src="{{ $manga->cover_url ?? asset('default-cover.jpg') }}" 
                                     alt="{{ $manga->title }}" 
                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="mt-4 space-y-4">
                                <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                                    <div>
                                        <p class="text-sm text-gray-600">Harga</p>
                                        <p class="text-2xl font-bold text-primary">Rp {{ number_format($manga->price, 0, ',', '.') }}</p>
                                    </div>
                                    <!-- Form Tambah ke Keranjang -->
                                    <form action="{{ route('user.cart.add', $manga) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="w-full bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition-colors font-medium">
                                            Tambah ke Keranjang
                                        </button>
                                    </form>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h3 class="font-semibold mb-2">Info Tambahan</h3>
                                    <div class="space-y-2 text-sm text-gray-600">
                                        <p>Status: <span class="text-{{ $manga->stock > 0 ? 'green' : 'red' }}-600 font-medium">
                                            {{ $manga->stock > 0 ? 'Tersedia' : 'Stok Habis' }}
                                        </span></p>
                                        <p>Stok: {{ $manga->stock }} buah</p>
                                        <p>Ditambahkan: {{ $manga->created_at->format('d F Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Manga -->
                    <div class="md:w-2/3 mt-6 md:mt-0">
                        <div class="prose max-w-none">
                            <h1 class="text-3xl font-bold mb-2">{{ $manga->title }}</h1>
                            <div class="flex flex-wrap gap-2 mb-6">
                                @foreach($manga->categories as $category)
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $category->name }}
                                </span>
                                @endforeach
                            </div>
                            
                            <div class="space-y-6">
                                <div>
                                    <h2 class="text-xl font-semibold mb-2">Informasi Manga</h2>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="space-y-2">
                                            <div>
                                                <p class="text-gray-600">Penulis</p>
                                                <p class="font-medium">{{ $manga->author }}</p>
                                            </div>
                                            <div>
                                                <p class="text-gray-600">Kategori</p>
                                                <p class="font-medium">{{ $manga->categories->pluck('name')->implode(', ') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($manga->description)
                                <div>
                                    <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="text-gray-600 leading-relaxed">
                                            {{ $manga->description }}
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
