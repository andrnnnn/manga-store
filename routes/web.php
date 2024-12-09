<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admins\{
    DashboardController as AdminDashboardController,
    MangaController as AdminMangaController,
    OrderController as AdminOrderController,
    CategoryController as AdminCategoryController
};
use App\Http\Controllers\Users\{
    OrderController as UserOrderController,
    CartController as UserCartController
};
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public Routes
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

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Manga Management
    Route::prefix('manga')->name('manga.')->group(function () {
        Route::get('/', [AdminMangaController::class, 'index'])->name('index');
        Route::get('/create', [AdminMangaController::class, 'createForm'])->name('create.form');
        Route::post('/create', [AdminMangaController::class, 'create'])->name('create');
        Route::get('/{manga}/update', [AdminMangaController::class, 'updateForm'])->name('update.form');
        Route::put('/{manga}', [AdminMangaController::class, 'update'])->name('update');
        Route::delete('/{manga}', [AdminMangaController::class, 'destroy'])->name('destroy');
    });

    // Order Management
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('index');
        Route::get('/pending', [AdminOrderController::class, 'pending'])->name('pending');
        Route::get('/{order}', [AdminOrderController::class, 'show'])->name('show');
        Route::patch('/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('updateStatus');
    });

    // Category Management
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::post('/', [AdminCategoryController::class, 'create'])->name('create');
        Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])->name('destroy');
    });
});

// User Routes
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

});
