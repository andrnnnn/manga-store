<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - {{ config('app.name') }}</title>
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
    </style>
</head>
<body class="bg-gray-900 min-h-screen font-[Poppins] text-gray-100">
    <!-- Sidebar -->
    <div class="fixed left-0 top-0 w-64 h-full bg-gray-800 p-4">
        @include('admin.partials.sidebar')
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.order.index') }}"
                class="back-btn inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-gray-700 hover:bg-gray-600 transition-colors"
                onclick="handleButtonClick(this)">
                <svg class="spinner w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <div class="btn-text flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
                </div>
        </a>
    </div>

    <div class="grid grid-cols-2 gap-6">
        <!-- Informasi Pelanggan -->
        <div class="bg-gray-700/50 rounded-xl p-6">
            <h2 class="text-lg font-semibold mb-4">Informasi Pelanggan</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-gray-400 text-sm">Nama</p>
                    <p>{{ $order->user->name }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Email</p>
                    <p>{{ $order->user->email }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Invoice</p>
                    <p>{{ $order->invoice_number }}</p>
                </div>
            </div>
        </div>
        <!-- Informasi Pesanan -->
        <div class="bg-gray-700/50 rounded-xl p-6">
            <h2 class="text-lg font-semibold mb-4">Informasi Pesanan</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-gray-400 text-sm">Status</p>
                    <span @class([
                        'px-2 py-1 rounded-full text-xs inline-block',
                        'bg-yellow-400/20 text-yellow-400' => $order->status == 'pending',
                        'bg-blue-400/20 text-blue-400' => $order->status == 'processing',
                        'bg-green-400/20 text-green-400' => $order->status == 'completed',
                        'bg-red-400/20 text-red-400' => $order->status == 'cancelled'
                    ])>
                        {{ $order->status }}
                    </span>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Tanggal</p>
                    <p>{{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Total</p>
                    <p class="text-lg font-semibold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Item -->
    <div class="mt-6 bg-gray-700/50 rounded-xl p-6">
        <h2 class="text-lg font-semibold mb-4">Detail Item</h2>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-gray-400 text-sm border-b border-gray-600">
                        <th class="text-left py-3">Manga</th>
                        <th class="text-right py-3">Harga</th>
                        <th class="text-right py-3">Jumlah</th>
                        <th class="text-right py-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-600">
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td class="py-4">{{ $item->manga->title }}</td>
                        <td class="text-right py-4">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="text-right py-4">{{ $item->quantity }}</td>
                        <td class="text-right py-4">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t border-gray-600">
                        <td colspan="3" class="py-4 text-right font-semibold">Total</td>
                        <td class="py-4 text-right font-semibold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script>
            function handleButtonClick(button) {
                button.classList.add('loading');
            }

        // Loading state untuk form
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', () => {
                const button = form.querySelector('button[type="submit"]');
                if (button) {
                    button.disabled = true;
                    button.innerHTML = `
                        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Loading...
                    `;
                }
            });
        });
    </script>
    </div>
</body>
</html>
