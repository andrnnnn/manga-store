<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen font-[Poppins]">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ auth()->user()->name }}!</h1>
                <div class="flex items-center gap-4">
                    <a href="{{ url('/cart') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition-colors">
                        Keranjang ({{ \App\Models\CartItem::where('user_id', auth()->user()->user_id)->sum('quantity') }})
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Riwayat Pesanan -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4">Riwayat Pesanan</h2>
                @php
                    $orders = \App\Models\Order::where('user_id', auth()->user()->user_id)
                        ->with('orderItems.manga')
                        ->latest()
                        ->get();
                @endphp

                @if($orders->count() > 0)
                    <div class="grid gap-4">
                        @foreach($orders as $order)
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="flex justify-between items-center mb-2">
                                    <div>
                                        <span class="font-medium">Invoice: {{ $order->invoice_number }}</span>
                                        <span class="text-sm text-gray-500 ml-4">{{ $order->created_at->format('d M Y H:i') }}</span>
                                    </div>
                                    <span @class([
                                        'px-3 py-1 rounded-full text-sm',
                                        'bg-green-100 text-green-800' => $order->status === 'completed',
                                        'bg-yellow-100 text-yellow-800' => $order->status === 'pending',
                                        'bg-red-100 text-red-800' => $order->status === 'cancelled'
                                    ])>
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>

                                <div class="space-y-2">
                                    @foreach($order->orderItems as $item)
                                        <div class="flex justify-between items-center text-sm">
                                            <span>{{ $item->manga->title }} ({{ $item->quantity }}x)</span>
                                            <span>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-4 flex justify-between items-center border-t pt-2">
                                    <span class="font-medium">Total:</span>
                                    <span class="font-medium">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                </div>

                                @if($order->status === 'completed')
                                    <div class="mt-2">
                                        <a href="{{ route('user.orders.invoice', $order->order_id) }}"
                                           class="text-primary hover:text-primary-dark text-sm">
                                            Lihat Invoice
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Belum ada pesanan</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
