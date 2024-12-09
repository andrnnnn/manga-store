<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'orderItems.manga'])->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function pending()
    {
        $orders = Order::with(['user', 'orderItems.manga'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);
        return view('admin.orders.pending', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.manga']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,cancelled'
        ]);

        $order->update($validated);
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
} 
