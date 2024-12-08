<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);
// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Admin Routes
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // User Routes
    Route::get('/user/dashboard', function () {
        if (Auth::user()->role !== 'user') {
            return redirect('/login');
        }
        return view('user.dashboard');
    })->name('user.dashboard');

    // Manga Routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/manga', [MangaController::class, 'index'])->name('manga.index');
        Route::get('/admin/manga/create', [MangaController::class, 'createForm'])->name('manga.create.form');
        Route::post('/admin/manga/create', [MangaController::class, 'create'])->name('manga.create');

        Route::get('/admin/manga/{manga}/update', [MangaController::class, 'updateForm'])->name('manga.update.form');
        Route::put('/admin/manga/{manga}', [MangaController::class, 'update'])->name('manga.update');
        Route::delete('/admin/manga/{manga}', [MangaController::class, 'destroy'])->name('manga.destroy');
    });

    // Order Routes
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/admin/orders/pending', [OrderController::class, 'pending'])->name('orders.pending');
    Route::get('/admin/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Category Routes
    Route::post('/categories', [CategoryController::class, 'create'])->name('category.create');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
});
