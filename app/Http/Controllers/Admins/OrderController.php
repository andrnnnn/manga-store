<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'orderItems.manga']);

        // Filter berdasarkan status jika ada
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Get data untuk DataTables
        $orders = $query->latest()->get();

        return view('admin.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.manga']);
        return view('admin.order.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        if ($order->status == 'completed' || $order->status == 'cancelled') {
            return redirect()->back()->with('error', 'Status pesanan yang sudah selesai atau dibatalkan tidak dapat diubah');
        }

        $request->validate([
            'status' => 'required|in:pending,completed,cancelled'
        ]);

        if ($order->total_price == 0) {
            $total = $order->orderItems->sum(function($item) {
                return $item->price * $item->quantity;
            });
            
            $order->update([
                'status' => $request->status,
                'total_price' => $total
            ]);
        } else {
            $order->update([
                'status' => $request->status
            ]);
        }

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui');
    }
}
