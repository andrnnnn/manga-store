<?php

use App\Http\Controllers\Admins\{
    DashboardController as AdminDashboardController,
    MangaController as AdminMangaController,
    OrderController as AdminOrderController,
    CategoryController as AdminCategoryController
};
use Illuminate\Support\Facades\Route;

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
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
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('index');
        Route::get('/{order}', [AdminOrderController::class, 'show'])->name('show');
        Route::patch('/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('updateStatus');
    });

    // Category Management
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::post('/', [AdminCategoryController::class, 'create'])->name('create');
        Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])->name('destroy');
    });
});
