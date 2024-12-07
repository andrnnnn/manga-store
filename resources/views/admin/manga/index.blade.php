<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Manga - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
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
    <!-- Sidebar -->
    <div class="fixed left-0 top-0 w-64 h-full bg-gray-800 p-4">
        @include('admin.partials.sidebar')
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold">Daftar Manga</h1>
                <p class="text-gray-400">Kelola koleksi manga toko</p>
            </div>
            <a href="{{ route('manga.create') }}" 
                class="add-btn flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors"
                onclick="handleButtonClick(this)">
                <svg class="spinner w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <div class="btn-text flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Manga
                </div>
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-400/20 text-green-400 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-gray-800 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-400 text-sm border-b border-gray-700">
                            <th class="px-6 py-4">Cover</th>
                            <th class="px-6 py-4">Judul</th>
                            <th class="px-6 py-4">Penulis</th>
                            <th class="px-6 py-4">Harga</th>
                            <th class="px-6 py-4">Stok</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($mangas as $manga)
                            <tr class="hover:bg-gray-700/50">

                                <td class="px-6 py-4">
                                    <img src="{{ asset($manga->cover_url) }}" alt="Cover {{ $manga->title }}" class="w-16 h-20 object-cover rounded">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium">{{ $manga->title }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-300">{{ $manga->author }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center whitespace-nowrap">
                                        <span>Rp</span>
                                        <span class="ml-1">{{ number_format($manga->price, 0, ',', '.') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span @class([
                                        'px-2 py-1 rounded-full text-xs',
                                        'bg-green-400/20 text-green-400' => $manga->stock > 10,
                                        'bg-yellow-400/20 text-yellow-400' => $manga->stock > 0 && $manga->stock <= 10,
                                        'bg-red-400/20 text-red-400' => $manga->stock == 0
                                    ])>
                                        {{ $manga->stock }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($manga->categories as $category)
                                            <span class="px-2 py-1 bg-primary/20 text-primary text-xs rounded-full">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('manga.update.form', $manga) }}" 
                                            class="edit-btn p-2 text-blue-400 hover:bg-blue-400/20 rounded-lg transition-colors"
                                            onclick="handleButtonClick(this)">
                                            <svg class="spinner w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            <svg class="btn-text w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form id="deleteForm{{ $manga->manga_id }}" action="{{ route('manga.destroy', $manga) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                onclick="showDeleteConfirmation('{{ $manga->manga_id }}', '{{ $manga->title }}')"
                                                class="delete-btn p-2 text-red-400 hover:bg-red-400/20 rounded-lg transition-colors">
                                                <svg class="spinner w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                                <svg class="btn-text w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteConfirmationModal" class="modal">
        <div class="bg-gray-800 rounded-xl p-6 max-w-md w-full mx-4">
            <h3 class="text-xl font-semibold mb-4">Konfirmasi Hapus</h3>
            <p class="text-gray-300 mb-2">Apakah Anda yakin ingin menghapus manga:</p>
            <p class="text-primary font-medium mb-6" id="mangaTitleToDelete"></p>
            <div class="flex justify-end gap-4">
                <button onclick="hideDeleteConfirmation()" 
                    class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 transition-colors">
                    Batal
                </button>
                <button onclick="confirmDelete()" 
                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentMangaId = null;

        function handleButtonClick(button) {
            button.classList.add('loading');
        }

        function showDeleteConfirmation(mangaId, mangaTitle) {
            currentMangaId = mangaId;
            document.getElementById('mangaTitleToDelete').textContent = mangaTitle;
            document.getElementById('deleteConfirmationModal').classList.add('show');
        }

        function hideDeleteConfirmation() {
            document.getElementById('deleteConfirmationModal').classList.remove('show');
            currentMangaId = null;
        }

        function confirmDelete() {
            if (currentMangaId) {
                const deleteBtn = document.querySelector(`#deleteForm${currentMangaId} .delete-btn`);
                handleButtonClick(deleteBtn);
                document.getElementById(`deleteForm${currentMangaId}`).submit();
            }
        }
    </script>
</body>
</html> 