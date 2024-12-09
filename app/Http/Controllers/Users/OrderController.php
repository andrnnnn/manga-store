<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function showInvoice(Order $order)
    {
        // Pastikan user hanya bisa melihat invoice mereka sendiri
        if ($order->user_id !== Auth::user()->user_id) {
            abort(403);
        }

        // Pastikan order sudah completed dan memiliki invoice number
        if ($order->status !== 'completed' || !$order->invoice_number) {
            abort(404);
        }

        return view('user.orders.invoice', compact('order'));
    }
} 