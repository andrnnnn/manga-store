<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use PDF;

class OrderController extends Controller
{
    public function showInvoice(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'completed' || !$order->invoice_number) {
            abort(404);
        }

        $pdf = PDF::loadView('user.invoice-pdf', compact('order'));
        return $pdf->download('Invoice-' . $order->invoice_number . '.pdf');
    }
} 