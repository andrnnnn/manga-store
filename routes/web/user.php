<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\MangaController;
use App\Http\Controllers\Users\CartController;
use App\Http\Controllers\Users\OrderController;

// User Routes
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    // Dashboard & Manga
    Route::get('/dashboard', [MangaController::class, 'index'])->name('dashboard');
    Route::get('/manga/{manga}', [MangaController::class, 'show'])->name('manga.detail');

    // Cart Routes
    Route::controller(CartController::class)->group(function () {
        Route::get('/cart', 'index')->name('cart');
        Route::post('/cart/add/{manga}', 'add')->name('cart.add');
        Route::post('/cart/update/{cartItem}', 'updateQuantity')->name('cart.update');
        Route::delete('/cart/remove/{cartItem}', 'remove')->name('cart.remove');
        Route::delete('/cart/remove-selected', 'removeSelected')->name('cart.remove-selected');
        Route::post('/cart/checkout', 'checkout')->name('cart.checkout');
    });

    // Order Routes
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders/{order}/invoice', 'showInvoice')->name('orders.invoice');
    });
});
