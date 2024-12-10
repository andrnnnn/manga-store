@extends('user.layouts.app')

@section('title', 'Keranjang')

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
            <!-- Tabs Navigation -->
            <div class="bg-gray-50 border-b border-gray-200">
                <nav class="flex">
                    <a href="#" onclick="switchTab('cart')" class="tab-btn w-1/2 py-4 px-6 text-center border-b-2 font-medium text-sm bg-white text-primary border-primary">
                        <div class="flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span>Keranjang Senpai</span>
                        </div>
                    </a>
                    <a href="#" onclick="switchTab('history')" class="tab-btn w-1/2 py-4 px-6 text-center border-b-2 font-medium text-sm text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300">
                        <div class="flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span>Riwayat Belanja</span>
                        </div>
                    </a>
                </nav>
            </div>

            <!-- Tab Contents -->
            <div class="p-6">
                <!-- Tab Keranjang -->
                <div id="cart" class="tab-content block">
                    <div class="space-y-6">
                        <!-- Header Keranjang -->
                        <div class="flex justify-between items-center pb-4 border-b">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" id="select-all" class="rounded border-gray-300 text-primary focus:ring-primary cursor-pointer">
                                <span class="text-sm font-medium text-gray-700">Pilih Semua Manga</span>
                            </label>
                            <button class="text-sm text-red-500 hover:text-red-600 font-medium transition-colors">
                                Hapus yang Dipilih
                            </button>
                        </div>

                        <!-- Daftar Item -->
                        <div class="space-y-6">
                            <!-- Item Keranjang -->
                            <div class="flex items-center justify-between py-4 border-b last:border-0">
                                <div class="flex items-center gap-4">
                                    <input type="checkbox" class="cart-item-checkbox rounded border-gray-300 text-primary focus:ring-primary cursor-pointer">
                                    <img src="https://via.placeholder.com/100x150" alt="Manga Cover" class="w-20 h-28 object-cover rounded-lg shadow">
                                    <div>
                                        <h3 class="font-semibold">One Piece Volume 1</h3>
                                        <p class="text-primary font-medium">Rp {{ number_format(50000, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-6">
                                    <div class="flex items-center border rounded-lg overflow-hidden">
                                        <button class="px-3 py-1 hover:bg-gray-100 text-gray-600 transition-colors">-</button>
                                        <span class="px-4 py-1 border-x bg-gray-50 min-w-[40px] text-center">1</span>
                                        <button class="px-3 py-1 hover:bg-gray-100 text-gray-600 transition-colors">+</button>
                                    </div>
                                    <button class="text-gray-400 hover:text-red-500 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Keranjang -->
                        <div class="mt-6 pt-6 border-t">
                            <div class="flex justify-between items-center mb-4">
                                <div class="space-y-1">
                                    <p class="text-sm text-gray-600">Manga Terpilih: <span id="selected-count" class="font-medium">0</span></p>
                                    <p class="text-lg font-semibold text-gray-800">Total yang Harus Dibayar</p>
                                </div>
                                <span class="text-2xl font-bold text-primary">Rp {{ number_format(95000, 0, ',', '.') }}</span>
                            </div>
                            <button class="w-full bg-primary text-white py-3 rounded-lg hover:bg-primary-dark transition-colors font-medium">
                                Checkout Sekarang desu~
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tab Riwayat -->
                <div id="history" class="tab-content hidden">
                    <div class="space-y-6">
                        <!-- Pembelian 1 -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <p class="font-semibold text-lg">{{ date('Ymd') }}MS001</p>
                                        <span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-800 font-medium">Sudah Sampai</span>
                                    </div>
                                    <p class="text-sm text-gray-500">23 Maret 2024 • 14:30 WIB</p>
                                </div>
                                <a href="#" class="flex items-center gap-2 text-primary hover:text-primary-dark font-medium transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Download Invoice</span>
                                </a>
                            </div>
                            <div class="mt-4 space-y-3 bg-white p-4 rounded-lg">
                                <div class="flex justify-between items-center text-sm">
                                    <div class="flex items-center gap-3">
                                        <img src="https://via.placeholder.com/60x80" alt="Manga Cover" class="w-12 h-16 object-cover rounded shadow">
                                        <span>One Piece Volume 1</span>
                                    </div>
                                    <span>Rp {{ number_format(50000, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm">
                                    <div class="flex items-center gap-3">
                                        <img src="https://via.placeholder.com/60x80" alt="Manga Cover" class="w-12 h-16 object-cover rounded shadow">
                                        <span>Naruto Volume 1</span>
                                    </div>
                                    <span>Rp {{ number_format(45000, 0, ',', '.') }}</span>
                                </div>
                                <div class="pt-3 border-t flex justify-between items-center">
                                    <span class="font-medium">Total Pembayaran</span>
                                    <span class="font-bold text-lg">Rp {{ number_format(95000, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Pembelian 2 -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <div class="flex items-center gap-3 mb-1">
                                        <p class="font-semibold text-lg">{{ date('Ymd') }}MS002</p>
                                        <span class="px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-800 font-medium">Masih Diproses</span>
                                    </div>
                                    <p class="text-sm text-gray-500">22 Maret 2024 • 15:45 WIB</p>
                                </div>
                                <form action="#" method="POST" onsubmit="return confirmCancel(this)" class="flex items-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center gap-2 text-red-500 hover:text-red-600 font-medium transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        <span id="cancelButtonText">Batalkan Pesanan</span>
                                        <svg id="cancelLoadingIcon" class="hidden animate-spin ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <div class="mt-4 space-y-3 bg-white p-4 rounded-lg">
                                <div class="flex justify-between items-center text-sm">
                                    <div class="flex items-center gap-3">
                                        <img src="https://via.placeholder.com/60x80" alt="Manga Cover" class="w-12 h-16 object-cover rounded shadow">
                                        <span>Dragon Ball Volume 1</span>
                                    </div>
                                    <span>Rp {{ number_format(48000, 0, ',', '.') }}</span>
                                </div>
                                <div class="pt-3 border-t flex justify-between items-center">
                                    <span class="font-medium">Total Pembayaran</span>
                                    <span class="font-bold text-lg">Rp {{ number_format(48000, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function switchTab(tabName) {
    // Sembunyikan semua tab content
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.add('hidden');
    });
    
    // Tampilkan tab yang dipilih
    document.getElementById(tabName).classList.remove('hidden');
    
    // Update tampilan tab
    document.querySelectorAll('.tab-btn').forEach(btn => {
        if (btn.getAttribute('onclick').includes(tabName)) {
            btn.classList.add('bg-white', 'text-primary', 'border-primary');
            btn.classList.remove('text-gray-500', 'border-transparent', 'hover:text-gray-700', 'hover:border-gray-300');
        } else {
            btn.classList.remove('bg-white', 'text-primary', 'border-primary');
            btn.classList.add('text-gray-500', 'border-transparent', 'hover:text-gray-700', 'hover:border-gray-300');
        }
    });

    return false;
}

document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select-all');
    const itemCheckboxes = document.querySelectorAll('.cart-item-checkbox');

    selectAllCheckbox.addEventListener('change', function() {
        itemCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateSelectedCount();
    });

    itemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedCount);
    });

    function updateSelectedCount() {
        const selectedCount = document.querySelectorAll('.cart-item-checkbox:checked').length;
        document.getElementById('selected-count').textContent = selectedCount;
    }
});

function confirmCancel(form) {
    if (confirm('Apakah kamu yakin ingin membatalkan pesanan ini?')) {
        const button = form.querySelector('button[type="submit"]');
        const buttonText = button.querySelector('#cancelButtonText');
        const loadingIcon = button.querySelector('#cancelLoadingIcon');

        button.disabled = true;
        buttonText.textContent = 'Membatalkan...';
        loadingIcon.classList.remove('hidden');
        return true;
    }
    return false;
}
</script>
@endsection
