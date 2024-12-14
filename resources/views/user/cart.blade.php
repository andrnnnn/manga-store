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
                            <form id="removeSelectedForm" action="{{ route('user.cart.remove-selected') }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="removeSelected()" class="text-sm text-red-500 hover:text-red-600 font-medium transition-colors">
                                    Hapus yang Dipilih
                                </button>
                            </form>
                        </div>

                        <!-- Daftar Item -->
                        <div class="space-y-6">
                            @forelse($cartItems as $item)
                            <div class="flex items-center justify-between py-4 border-b last:border-0">
                                <div class="flex items-center gap-4">
                                    <input type="checkbox"
                                           class="cart-item-checkbox rounded border-gray-300 text-primary focus:ring-primary cursor-pointer"
                                           value="{{ $item->cart_item_id }}">
                                    <div class="w-20 h-28 rounded-lg overflow-hidden shadow">
                                        <img src="{{ $item->manga->cover_url ?? asset('default-cover.jpg') }}"
                                             alt="{{ $item->manga->title }}"
                                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                    </div>
                                    <div>
                                        <h3 class="font-semibold">{{ $item->manga->title }}</h3>
                                        <p class="text-primary font-medium">Rp {{ number_format($item->manga->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-6">
                                    <!-- Update Quantity -->
                                    <form action="{{ route('user.cart.update', $item) }}" method="POST" class="flex items-center">
                                        @csrf
                                        <div class="flex items-center border rounded-lg overflow-hidden">
                                            <button type="button"
                                                    onclick="decrementQuantity(this)"
                                                    class="px-3 py-1 hover:bg-gray-100 text-gray-600 transition-colors"
                                                    {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                            <input type="number"
                                                   name="quantity"
                                                   value="{{ $item->quantity }}"
                                                   min="1"
                                                   max="{{ $item->manga->stock }}"
                                                   class="quantity-input px-4 py-1 border-x bg-gray-50 min-w-[40px] text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                                   readonly>
                                            <button type="button"
                                                    onclick="incrementQuantity(this)"
                                                    class="px-3 py-1 hover:bg-gray-100 text-gray-600 transition-colors"
                                                    {{ $item->quantity >= $item->manga->stock ? 'disabled' : '' }}>+</button>
                                        </div>
                                    </form>
                                    <form action="{{ route('user.cart.remove', $item) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus manga ini dari keranjang?')"
                                                class="text-gray-400 hover:text-red-500 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-8">
                                <p class="text-gray-500">Keranjang masih kosong</p>
                            </div>
                            @endforelse
                        </div>

                        <!-- Footer Keranjang -->
                        <div class="mt-6 pt-6 border-t">
                            <div class="flex justify-between items-center mb-4">
                                <div class="space-y-1">
                                    <p class="text-sm text-gray-600">Manga Terpilih: <span id="selected-count" class="font-medium">0</span></p>
                                    <p class="text-lg font-semibold text-gray-800">Total yang Harus Dibayar</p>
                                </div>
                                <span class="text-2xl font-bold text-primary" id="total-price">Rp 0</span>
                            </div>
                            <button id="checkoutButton"
                                    class="w-full bg-primary text-white py-3 rounded-lg hover:bg-primary-dark transition-colors font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                                    disabled>
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

<!-- Checkout Modal -->
<div id="checkoutModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Konfirmasi Checkout</h3>
                
                <!-- Detail Items -->
                <div class="space-y-4 mb-6">
                    <div class="max-h-60 overflow-y-auto pr-2">
                        <div id="checkoutItems" class="space-y-3">
                            <!-- Items will be inserted here by JavaScript -->
                        </div>
                    </div>
                    
                    <!-- Total -->
                    <div class="pt-4 border-t">
                        <div class="flex justify-between items-center">
                            <span class="font-medium">Total Pembayaran</span>
                            <span id="modalTotalPrice" class="font-bold text-lg text-primary"></span>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-4">
                    <button onclick="hideCheckoutModal()" 
                            class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                        Batal
                    </button>
                    <form action="{{ route('user.cart.checkout') }}" method="POST" onsubmit="startCheckoutLoading(this)">
                        @csrf
                        <input type="hidden" name="selected_items" id="selectedItemsInput">
                        <button type="submit" 
                                class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark transition-colors font-medium flex items-center">
                            <span id="checkoutButtonText">Konfirmasi Pembelian</span>
                            <svg id="checkoutLoadingIcon" class="hidden animate-spin ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </form>
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

// Fungsi helper global
function formatPrice(price) {
    return new Intl.NumberFormat('id-ID').format(price);
}

// Fungsi untuk menghitung total (global)
function calculateTotal() {
    let total = 0;
    let selectedCount = 0;
    const itemCheckboxes = document.querySelectorAll('.cart-item-checkbox');

    itemCheckboxes.forEach(checkbox => {
        if (checkbox.checked) {
            selectedCount++;
            const itemDiv = checkbox.closest('.flex.items-center.justify-between');
            const priceText = itemDiv.querySelector('.text-primary.font-medium').textContent;
            const quantity = parseInt(itemDiv.querySelector('.quantity-input').value);
            const price = parseInt(priceText.replace(/\D/g, ''));
            total += price * quantity;
        }
    });

    document.getElementById('selected-count').textContent = selectedCount;
    document.getElementById('total-price').textContent = `Rp ${formatPrice(total)}`;

    // Enable/disable checkout button
    const checkoutButton = document.getElementById('checkoutButton');
    if (checkoutButton) {
        checkoutButton.disabled = selectedCount === 0;
    }

    return { total, selectedCount };
}

document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select-all');
    const itemCheckboxes = document.querySelectorAll('.cart-item-checkbox');
    const checkoutButton = document.getElementById('checkoutButton');

    // Event listener untuk checkbox "Pilih Semua"
    selectAllCheckbox.addEventListener('change', function() {
        itemCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        calculateTotal();
    });

    // Event listener untuk setiap checkbox item
    itemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Update "Pilih Semua" checkbox
            selectAllCheckbox.checked = Array.from(itemCheckboxes).every(cb => cb.checked);
            calculateTotal();
        });
    });

    // Event listener untuk perubahan quantity
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', calculateTotal);
    });

    // Event listener untuk tombol checkout
    if (checkoutButton) {
        checkoutButton.addEventListener('click', showCheckoutModal);
    }
});

// Update fungsi increment/decrement untuk memanggil calculateTotal
function decrementQuantity(btn) {
    const input = btn.parentElement.querySelector('input');
    if (parseInt(input.value) > parseInt(input.min)) {
        input.value = parseInt(input.value) - 1;
        input.closest('form').submit();
        calculateTotal();
    }
}

function incrementQuantity(btn) {
    const input = btn.parentElement.querySelector('input');
    if (parseInt(input.value) < parseInt(input.max)) {
        input.value = parseInt(input.value) + 1;
        input.closest('form').submit();
        calculateTotal();
    }
}

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

// Handle select all
document.getElementById('select-all').addEventListener('change', function() {
    document.querySelectorAll('.cart-item-checkbox').forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    updateSelectedCount();
});

// Update quantity
function updateQuantity(btn, change) {
    const input = btn.parentElement.querySelector('input');
    const newValue = parseInt(input.value) + change;

    if (newValue >= input.min && newValue <= input.max) {
        input.value = newValue;
        quantityChanged(input);
    }
}

// Handle quantity change
function quantityChanged(input) {
    const itemId = input.dataset.itemId;
    const quantity = input.value;

    fetch(`/user/cart/update/${itemId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ quantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('cart-total').textContent = data.new_total;
        }
    });
}

// Hapus item yang dipilih
function removeSelected() {
    const selectedItems = Array.from(document.querySelectorAll('.cart-item-checkbox:checked'))
        .map(checkbox => checkbox.value);

    if (selectedItems.length === 0) {
        alert('Pilih manga yang ingin dihapus');
        return;
    }

    if (confirm('Yakin ingin menghapus manga yang dipilih?')) {
        // Buat input tersembunyi untuk setiap item yang dipilih
        selectedItems.forEach((value, index) => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `items[]`;
            input.value = value;
            document.getElementById('removeSelectedForm').appendChild(input);
        });

        document.getElementById('removeSelectedForm').submit();
    }
}

// Hapus single item
function removeSingleItem(itemId) {
    if (confirm('Yakin ingin menghapus manga ini dari keranjang?')) {
        document.getElementById('singleItem').value = JSON.stringify([itemId]);
        document.getElementById('removeSingleForm').submit();
    }
}

// Update selected count
function updateSelectedCount() {
    const count = document.querySelectorAll('.cart-item-checkbox:checked').length;
    document.getElementById('selected-count').textContent = count;
}

// Initialize
document.querySelectorAll('.cart-item-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', updateSelectedCount);
});

// Pindahkan fungsi showCheckoutModal ke dalam scope global
function showCheckoutModal() {
    const modal = document.getElementById('checkoutModal');
    const checkoutItems = document.getElementById('checkoutItems');
    const selectedItemsInput = document.getElementById('selectedItemsInput');
    const modalTotalPrice = document.getElementById('modalTotalPrice');
    
    if (!modal || !checkoutItems || !selectedItemsInput || !modalTotalPrice) {
        console.error('Required elements not found');
        return;
    }
    
    // Clear previous items
    checkoutItems.innerHTML = '';
    
    let selectedItems = [];
    let total = 0;
    
    // Get all checked items
    document.querySelectorAll('.cart-item-checkbox:checked').forEach(checkbox => {
        const itemDiv = checkbox.closest('.flex.items-center.justify-between');
        const title = itemDiv.querySelector('h3').textContent;
        const priceText = itemDiv.querySelector('.text-primary.font-medium').textContent;
        const quantity = parseInt(itemDiv.querySelector('.quantity-input').value);
        const price = parseInt(priceText.replace(/\D/g, ''));
        const itemTotal = price * quantity;
        total += itemTotal;
        
        selectedItems.push({
            id: checkbox.value,
            quantity: quantity
        });
        
        // Create item element
        const itemElement = document.createElement('div');
        itemElement.className = 'flex justify-between items-center py-2';
        itemElement.innerHTML = `
            <div class="flex items-center gap-3">
                <div>
                    <p class="font-medium">${title}</p>
                    <p class="text-sm text-gray-500">${quantity} x Rp ${formatPrice(price)}</p>
                </div>
            </div>
            <span class="font-medium">Rp ${formatPrice(itemTotal)}</span>
        `;
        
        checkoutItems.appendChild(itemElement);
    });
    
    // Update total and selected items input
    modalTotalPrice.textContent = `Rp ${formatPrice(total)}`;
    selectedItemsInput.value = JSON.stringify(selectedItems);
    
    // Show modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function hideCheckoutModal() {
    document.getElementById('checkoutModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function startCheckoutLoading(form) {
    const button = form.querySelector('button[type="submit"]');
    const buttonText = button.querySelector('#checkoutButtonText');
    const loadingIcon = button.querySelector('#checkoutLoadingIcon');

    button.disabled = true;
    buttonText.textContent = 'Memproses...';
    loadingIcon.classList.remove('hidden');
}

// Close modal when clicking outside
document.getElementById('checkoutModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideCheckoutModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('checkoutModal').classList.contains('hidden')) {
        hideCheckoutModal();
    }
});
</script>
@endsection

