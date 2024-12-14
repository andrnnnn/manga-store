<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->invoice_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #374151;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #E5E7EB;
        }
        .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #6366F1;
            margin-bottom: 5px;
        }
        .invoice-number {
            font-size: 16px;
            color: #6B7280;
        }
        .invoice-details {
            margin-bottom: 40px;
        }
        .invoice-details table {
            width: 100%;
        }
        .invoice-details td {
            padding: 8px 0;
            vertical-align: top;
        }
        .label {
            font-weight: bold;
            color: #374151;
            margin-bottom: 5px;
            display: block;
        }
        .value {
            color: #6B7280;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th {
            background-color: #F3F4F6;
            padding: 12px;
            text-align: left;
            font-weight: bold;
            color: #374151;
            border-bottom: 2px solid #E5E7EB;
        }
        .items-table td {
            padding: 12px;
            border-bottom: 1px solid #E5E7EB;
            color: #6B7280;
        }
        .items-table tr:last-child td {
            border-bottom: none;
        }
        .total {
            text-align: right;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #E5E7EB;
        }
        .total-label {
            font-size: 16px;
            font-weight: bold;
            color: #374151;
        }
        .total-amount {
            font-size: 24px;
            font-weight: bold;
            color: #6366F1;
            margin-top: 5px;
        }
        .footer {
            margin-top: 60px;
            text-align: center;
            color: #9CA3AF;
            font-size: 12px;
            padding-top: 20px;
            border-top: 1px solid #E5E7EB;
        }
        .status, .status-completed {
            display: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="brand">
            <div class="logo">MangaStore</div>
        </div>
        <div class="invoice-number">Invoice #{{ $order->invoice_number }}</div>
    </div>

    <div class="invoice-details">
        <table>
            <tr>
                <td width="50%">
                    <span class="label">Dari:</span>
                    <div class="value">
                        <strong style="color: #6366F1;">MangaStore</strong><br>
                        Jl. Manga No. 123<br>
                        Jakarta, Indonesia<br>
                        info@mangastore.com
                    </div>
                </td>
                <td width="50%">
                    <span class="label">Kepada:</span>
                    <div class="value">
                        <strong style="color: #374151;">{{ $order->user->name }}</strong><br>
                        {{ $order->user->email }}<br>
                        Tanggal Order: {{ $order->created_at->format('d F Y') }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>Manga</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
            <tr>
                <td><strong style="color: #374151;">{{ $item->manga->title }}</strong></td>
                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td>{{ $item->quantity }}</td>
                <td><strong>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <div class="total-label">Total Pembayaran</div>
        <div class="total-amount">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
    </div>

    <div class="footer">
        <div style="color: #6366F1; font-weight: bold; margin-bottom: 5px;">Terima kasih telah berbelanja di MangaStore!</div>
        © {{ date('Y') }} MangaStore. All rights reserved.
    </div>
</body>
</html> 