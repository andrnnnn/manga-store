<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Manga;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('manga')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum(function($item) {
            return $item->manga->price * $item->quantity;
        });

        return view('user.cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Manga $manga)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $manga->stock
        ], [
            'quantity.max' => 'Stok tidak mencukupi!'
        ]);

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('manga_id', $manga->manga_id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($newQuantity > $manga->stock) {
                return back()->with('error', 'Stok tidak mencukupi!');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'manga_id' => $manga->manga_id,
                'quantity' => $request->quantity
            ]);
        }

        return back()->with('success', 'Manga berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cartItem->manga->stock
        ]);

        $cartItem->update(['quantity' => $request->quantity]);
        return back()->with('success', 'Jumlah berhasil diperbarui!');
    }

    public function remove(CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();
        return back()->with('success', 'Item berhasil dihapus dari keranjang!');
    }

    public function checkout()
    {
        $cartItems = CartItem::with('manga')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Keranjang kosong!');
        }

        // Cek stok
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->manga->stock) {
                return back()->with('error', "Stok {$item->manga->title} tidak mencukupi!");
            }
        }

        try {
            DB::beginTransaction();

            // Buat order baru
            $total = $cartItems->sum(function($item) {
                return $item->manga->price * $item->quantity;
            });

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'status' => 'pending',
                'invoice_number' => 'INV-' . time() . '-' . Auth::id()
            ]);

            // Buat order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'manga_id' => $item->manga_id,
                    'quantity' => $item->quantity,
                    'price' => $item->manga->price
                ]);

                // Update stok manga
                $item->manga->decrement('stock', $item->quantity);
            }

            // Kosongkan keranjang
            CartItem::where('user_id', Auth::id())->delete();

            DB::commit();
            return redirect()->route('user.dashboard')->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat checkout!');
        }
    }
} 
