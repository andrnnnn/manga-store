<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function cancelOrder(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'pending') {
            return back()->with('error', 'Hanya pesanan dengan status pending yang dapat dibatalkan!');
        }

        try {
            DB::beginTransaction();

            // Kembalikan stok untuk setiap item
            foreach ($order->orderItems as $item) {
                $item->manga->increment('stock', $item->quantity);
            }

            // Update status order menjadi cancelled
            $order->update(['status' => 'cancelled']);

            DB::commit();
            return back()->with('success', 'Pesanan berhasil dibatalkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat membatalkan pesanan!');
        }
    }
} 