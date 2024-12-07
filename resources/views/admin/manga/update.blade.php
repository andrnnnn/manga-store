<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Manga - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Menghilangkan arrow/spinner untuk input number */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield; /* Firefox */
        }

        .loading {
            pointer-events: none;
            opacity: 0.7;
        }
        .spinner {
            display: none;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .loading .spinner {
            display: inline-block;
        }
        .loading .btn-text {
            display: none;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 50;
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body class="bg-gray-900 min-h-screen font-[Poppins] text-gray-100">
    @include('admin.partials.sidebar')

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold">Edit Manga</h1>
                <p class="text-gray-400">Edit informasi manga</p>
            </div>
            <a href="{{ route('manga.index') }}"
                class="back-btn flex items-center gap-2 px-4 py-2 border border-gray-600 text-gray-300 rounded-lg hover:bg-gray-800 transition-colors"
                onclick="handleButtonClick(this)">
                <svg class="spinner w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <div class="btn-text flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </div>
            </a>
        </div>

        <div class="bg-gray-800 rounded-xl p-6">
            <form id="mangaForm" action="{{ route('manga.update', $manga) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Judul Manga</label>
                        <input type="text" name="title" value="{{ old('title', $manga->title) }}"
                            class="w-full h-11 px-4 rounded-lg bg-gray-700 border-gray-600 text-gray-100 focus:border-primary focus:ring-primary">
                        @error('title')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Penulis</label>
                        <input type="text" name="author" value="{{ old('author', $manga->author) }}"
                            class="w-full h-11 px-4 rounded-lg bg-gray-700 border-gray-600 text-gray-100 focus:border-primary focus:ring-primary">
                        @error('author')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Harga</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">Rp</span>
                            <input type="text" name="price" value="{{ old('price', number_format($manga->price, 0, ',', '.')) }}"
                                oninput="this.value = this.value.replace(/[^0-9]/g, ''); formatRupiah(this);"
                                class="w-full h-11 pl-12 pr-4 rounded-lg bg-gray-700 border-gray-600 text-gray-100 focus:border-primary focus:ring-primary">
                        </div>
                        @error('price')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Stok</label>
                        <input type="text" name="stock" value="{{ old('stock', number_format($manga->stock, 0, ',', '.')) }}"
                            oninput="this.value = this.value.replace(/[^0-9]/g, ''); formatNumber(this);"
                            class="w-full h-11 px-4 rounded-lg bg-gray-700 border-gray-600 text-gray-100 focus:border-primary focus:ring-primary">
                        @error('stock')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Deskripsi</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-2 rounded-lg bg-gray-700 border-gray-600 text-gray-100 focus:border-primary focus:ring-primary">{{ old('description', $manga->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Cover Manga</label>
                        <div class="flex items-start gap-4">
                            <!-- Preview Image -->
                            <div class="w-32 h-44 bg-gray-700/50 rounded-lg overflow-hidden">
                                <img id="coverPreview" src="{{ asset($manga->cover_url) }}" 
                                    class="w-full h-full object-cover"
                                    alt="Preview Cover">
                            </div>
                            
                            <!-- Input File -->
                            <div class="flex-1">
                                <input type="file" name="cover" accept="image/*"
                                    onchange="previewImage(this)"
                                    class="w-full px-4 py-2 rounded-lg bg-gray-700 border-gray-600 text-gray-100 focus:border-primary focus:ring-primary file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:bg-primary file:text-white hover:file:bg-primary-dark">
                                <p class="mt-1 text-sm text-gray-400">Format: JPG, JPEG, PNG, GIF (Max. 2MB)</p>
                                @error('cover')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="text-sm text-gray-300">Kategori</label>
                        <div class="mt-1">
                            <select id="categorySelect"
                                class="w-full px-4 py-2 rounded-lg bg-gray-700/50 border-0 text-gray-100">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}" data-name="{{ $category->name }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Container untuk tags -->
                            <div class="mt-3 p-4 bg-gray-700/50 rounded-lg min-h-[100px]">
                                <div id="selectedCategories" class="flex flex-wrap gap-2">
                                    @foreach($manga->categories as $category)
                                        <div class="inline-flex items-center px-3 py-1 bg-gray-600 text-gray-200 rounded-full text-sm">
                                            <span>{{ $category->name }}</span>
                                            <button type="button" class="ml-2 text-gray-400 hover:text-gray-200" 
                                                onclick="removeCategory(this, '{{ $category->category_id }}')">×</button>
                                            <input type="hidden" name="categories[]" value="{{ $category->category_id }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="button"
                        class="save-btn px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors"
                        onclick="showConfirmationModal()">
                        <svg class="spinner w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span class="btn-text">Update Manga</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div id="confirmationModal" class="modal">
        <div class="bg-gray-800 rounded-xl p-6 max-w-md w-full mx-4">
            <h3 class="text-xl font-semibold mb-4">Konfirmasi Update</h3>
            <p class="text-gray-300 mb-6">Apakah Anda yakin ingin mengupdate manga ini?</p>
            <div class="flex justify-end gap-4">
                <button onclick="hideConfirmationModal()" 
                    class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 transition-colors">
                    Batal
                </button>
                <button onclick="submitForm()" 
                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                    Ya, Update
                </button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('categorySelect');
        const selectedCategories = document.getElementById('selectedCategories');
            
        categorySelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const id = selectedOption.value;
            const name = selectedOption.dataset.name;
            
            if (!id || id === '') return;
            
            // Cek duplikasi
            if (document.querySelector(`input[value="${id}"]`)) {
                this.value = '';
                return;
            }
            
            // Buat tag
            const tag = document.createElement('div');
            tag.className = 'inline-flex items-center px-3 py-1 bg-gray-600 text-gray-200 rounded-full text-sm';
            tag.innerHTML = `
                <span>${name}</span>
                <button type="button" class="ml-2 text-gray-400 hover:text-gray-200" onclick="removeCategory(this, '${id}')">×</button>
                <input type="hidden" name="categories[]" value="${id}">
            `;
            
            selectedCategories.appendChild(tag);
            this.value = '';
        });
    });

    function removeCategory(button, id) {
        button.closest('div').remove();
    }

    // Fungsi untuk format Rupiah
    function formatRupiah(input) {
        let number = input.value.replace(/[^0-9]/g, '');
        if (number) {
            input.value = number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    }

    // Fungsi untuk format angka biasa (stok)
    function formatNumber(input) {
        let number = input.value.replace(/[^0-9]/g, '');
        if (number) {
            input.value = number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    }

    // Event listener untuk input harga dan stok
    document.querySelectorAll('input[name="price"], input[name="stock"]').forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value === '') {
                this.value = '0';
            }
        });
    });

    // Fungsi untuk preview image
    function previewImage(input) {
        const preview = document.getElementById('coverPreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "{{ asset($manga->cover_url) }}";
        }
    }

    function handleButtonClick(button) {
        button.classList.add('loading');
    }

    // Fungsi untuk modal konfirmasi
    function showConfirmationModal() {
        document.getElementById('confirmationModal').classList.add('show');
    }

    function hideConfirmationModal() {
        document.getElementById('confirmationModal').classList.remove('show');
    }

    function submitForm() {
        const saveBtn = document.querySelector('.save-btn');
        handleButtonClick(saveBtn);
        document.getElementById('mangaForm').submit();
    }
    </script>
</body>
</html> 