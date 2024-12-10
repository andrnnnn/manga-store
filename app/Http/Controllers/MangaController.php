<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\CartItem;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    public function index()
    {
        $mangas = Manga::latest()->get();
        return view('user.dashboard', compact('mangas'));
    }

    public function show($id)
    {
        $manga = Manga::findOrFail($id);
        return view('user.manga-detail', compact('manga'));
    }

    public function cart()
    {
        $cartItems = CartItem::where('user_id', auth()->user()->user_id)
            ->with('manga')
            ->get();

        return view('user.cart', compact('cartItems'));
    }

    public function addToCart(Request $request, Manga $manga)
    {
        // Logika untuk menambah ke keranjang akan diimplementasikan nanti
        return redirect()->back()->with('success', 'Manga berhasil ditambahkan ke keranjang');
    }

    public function updateCart(Request $request, CartItem $cartItem)
    {
        // Logika untuk update quantity akan diimplementasikan nanti
        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui');
    }

    public function removeFromCart(CartItem $cartItem)
    {
        // Logika untuk menghapus item akan diimplementasikan nanti
        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang');
    }
}
