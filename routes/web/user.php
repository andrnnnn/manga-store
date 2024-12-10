<?php

use Illuminate\Support\Facades\Route;

// User Routes
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    // Detail manga
    Route::get('/manga/{id}', function() {
        return view('user.manga-detail');
    })->name('manga.detail');

    // Keranjang
    Route::get('/cart', function() {
        return view('user.cart');
    })->name('cart');
});
