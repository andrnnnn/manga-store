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
        $cartItems = CartItem::with(['manga' => function($query) {
            $query->whereNull('deleted_at');
        }])
        ->where('user_id', Auth::id())
        ->whereNull('deleted_at')
        ->get();

        $orders = Order::with(['orderItems.manga'])
            ->where('user_id', Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.cart', compact('cartItems', 'orders'));
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

    public function updateQuantity(Request $request, CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:' . $cartItem->manga->stock
            ]
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
        return back()->with('success', 'Manga berhasil dihapus dari keranjang!');
    }

    public function removeSelected(Request $request)
    {
        if (!$request->has('items') || !is_array($request->items)) {
            return back()->with('error', 'Pilih manga yang ingin dihapus');
        }

        CartItem::whereIn('cart_item_id', $request->items)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with('success', 'Manga berhasil dihapus dari keranjang!');
    }

    private function calculateTotal()
    {
        return CartItem::with('manga')
            ->where('user_id', Auth::id())
            ->whereNull('deleted_at')
            ->get()
            ->sum(function($item) {
                return $item->manga->price * $item->quantity;
            });
    }

    public function checkout(Request $request)
    {
        $selectedItems = json_decode($request->selected_items, true);

        if (empty($selectedItems)) {
            return back()->with('error', 'Pilih manga yang ingin dibeli');
        }

        try {
            DB::beginTransaction();

            // Ambil cart items yang dipilih
            $cartItems = CartItem::with('manga')
                ->whereIn('cart_item_id', array_column($selectedItems, 'id'))
                ->where('user_id', Auth::id())
                ->get();

            // Validasi stok
            foreach ($cartItems as $item) {
                $selectedItem = collect($selectedItems)->firstWhere('id', $item->cart_item_id);
                if ($selectedItem['quantity'] > $item->manga->stock) {
                    throw new \Exception("Stok {$item->manga->title} tidak mencukupi!");
                }
            }

            // Hitung total
            $total = $cartItems->sum(function($item) use ($selectedItems) {
                $selectedItem = collect($selectedItems)->firstWhere('id', $item->cart_item_id);
                return $item->manga->price * $selectedItem['quantity'];
            });

            // Buat order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'status' => 'pending',
                'invoice_number' => 'INV-' . time() . '-' . Auth::id()
            ]);

            // Buat order items dan update stok
            foreach ($cartItems as $item) {
                $selectedItem = collect($selectedItems)->firstWhere('id', $item->cart_item_id);

                OrderItem::create([
                    'order_id' => $order->order_id,
                    'manga_id' => $item->manga_id,
                    'quantity' => $selectedItem['quantity'],
                    'price' => $item->manga->price
                ]);

                // Update stok
                $item->manga->decrement('stock', $selectedItem['quantity']);

                // Hapus item dari cart
                $item->delete();
            }

            DB::commit();
            return redirect()->route('user.dashboard')->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
