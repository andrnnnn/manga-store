<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 min-h-screen font-[Poppins] text-gray-100">
    <!-- Sidebar -->
    <div class="fixed left-0 top-0 w-64 h-full bg-gray-800 p-4">
        <div class="flex items-center gap-3 mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8">
            <span class="font-semibold text-lg">Manga Store</span>
        </div>

        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" 
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg bg-primary text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('manga.index') }}" 
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-gray-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Manga
            </a>

            <a href="{{ route('orders.index') }}" 
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg hover:bg-gray-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                Pesanan
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold">Dashboard Admin</h1>
                <p class="text-gray-400">Selamat datang kembali!</p>
            </div>
            <div class="flex items-center gap-4">
                <span>{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-white">Logout</button>
                </form>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gray-800 p-6 rounded-xl">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-gray-400 text-sm">Total Manga</p>
                        <h3 class="text-2xl font-bold">{{ $totalManga }}</h3>
                    </div>
                    <div class="p-2 bg-primary/20 text-primary rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-sm">
                    <span class="text-green-400">↑ 12%</span>
                    <span class="text-gray-400 ml-2">dari bulan lalu</span>
                </div>
            </div>

            <!-- Similar stats cards for Orders and Revenue -->
        </div>

        <!-- Recent Orders Table -->
        <div class="bg-gray-800 rounded-xl p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold">Pesanan Terbaru</h2>
                <a href="{{ route('orders.index') }}" class="text-primary hover:text-primary-dark">
                    Lihat Semua
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-400 text-sm">
                            <th class="pb-4">Order ID</th>
                            <th class="pb-4">Pelanggan</th>
                            <th class="pb-4">Total</th>
                            <th class="pb-4">Status</th>
                            <th class="pb-4">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach($recentOrders as $order)
                            <tr class="border-t border-gray-700">
                                <td class="py-4">#{{ $order->order_id }}</td>
                                <td class="py-4">{{ $order->user->name }}</td>
                                <td class="py-4">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                <td class="py-4">
                                    <span @class([
                                        'px-2 py-1 rounded-full text-xs',
                                        'bg-green-400/20 text-green-400' => $order->status === 'completed',
                                        'bg-yellow-400/20 text-yellow-400' => $order->status === 'pending', 
                                        'bg-red-400/20 text-red-400' => $order->status === 'cancelled'
                                    ])>
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="py-4">{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
