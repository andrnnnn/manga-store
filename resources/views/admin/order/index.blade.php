<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
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

        /* DataTables Custom Styling */
        .dataTables_wrapper {
            padding: 1rem;
            color: #E5E7EB;
        }

        .dataTables_filter input,
        .dataTables_length select {
            background: #374151 !important;
            border: 1px solid #4B5563 !important;
            color: #E5E7EB !important;
            border-radius: 0.375rem;
            padding: 0.5rem;
            margin-left: 0.5rem;
        }

        .dataTables_filter input:focus,
        .dataTables_length select:focus {
            outline: none;
            border-color: #6366F1;
        }

        .dataTables_info,
        .dataTables_paginate {
            margin-top: 1rem;
        }

        .dataTables_paginate .paginate_button {
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 0.375rem;
            background: #374151;
            color: #E5E7EB !important;
        }

        .dataTables_paginate .paginate_button:hover {
            background: #4B5563 !important;
            color: white !important;
        }

        .dataTables_paginate .paginate_button.current {
            background: #6366F1 !important;
            color: white !important;
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
                <h1 class="text-2xl font-bold">Daftar Pesanan</h1>
                <p class="text-gray-400">Kelola pesanan pelanggan</p>
            </div>
            <form action="{{ route('admin.order.index') }}" method="GET" class="flex items-center gap-4">
                <select name="status" onchange="this.form.submit()"
                    class="bg-gray-700 border-gray-600 text-gray-100 rounded-lg focus:ring-primary focus:border-primary">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </form>
        </div>

        <div class="bg-gray-800 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table id="orderTable" class="w-full">
                    <thead>
                        <tr class="text-left text-gray-400 text-sm border-b border-gray-700">
                            <th class="p-4">Invoice</th>
                            <th class="p-4">Pelanggan</th>
                            <th class="p-4">Total</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Tanggal</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-700/50">
                                <td class="p-4">{{ $order->invoice_number }}</td>
                                <td class="p-4">{{ $order->user->name }}</td>
                                <td class="p-4">
                                    <div class="flex items-center">
                                        <span>Rp</span>
                                        <span class="ml-1">{{ number_format($order->total_price, 0, ',', '.') }}</span>
                                    </div>
                                </td>
                                <td class="p-4">
                                    @if($order->status == 'completed' || $order->status == 'cancelled')
                                        <span @class([
                                            'px-2 py-1 rounded-full text-xs',
                                            'bg-green-400/20 text-green-400' => $order->status == 'completed',
                                            'bg-red-400/20 text-red-400' => $order->status == 'cancelled',
                                        ])>
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    @else
                                        <form action="{{ route('admin.order.updateStatus', $order) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" 
                                                onchange="this.form.submit()"
                                                class="bg-gray-700 border-gray-600 text-gray-100 rounded-lg focus:ring-primary focus:border-primary text-sm">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </form>
                                    @endif
                                </td>
                                <td class="p-4">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="p-4">
                                    <a href="{{ route('admin.order.show', $order) }}"
                                        class="detail-btn inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-primary/10 text-primary hover:bg-primary/20 transition-colors"
                                        onclick="handleButtonClick(this)">
                                        <svg class="spinner w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        <span class="btn-text">Detail</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-gray-400">
                                    Tidak ada pesanan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#orderTable').DataTable({
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(disaring dari _MAX_ total data)",
                    zeroRecords: "Tidak ada data yang cocok",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                },
                pageLength: 10,
                ordering: true,
                responsive: true
            });
        });

        function handleButtonClick(button) {
            button.classList.add('loading');
        }

        // Loading state untuk form
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function() {
                const select = this.querySelector('select');
                if (select) {
                    select.classList.add('opacity-50', 'cursor-not-allowed');
                    select.disabled = true;
                }
            });
        });
    </script>
</body>
</html>
