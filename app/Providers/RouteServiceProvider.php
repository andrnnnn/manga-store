<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/user/dashboard'; // Default redirect untuk user biasa
    public const ADMIN_HOME = '/admin/dashboard'; // Default redirect untuk admin

    public function boot(): void
    {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        // Register custom middlewares
        Route::aliasMiddleware('admin', AdminMiddleware::class);
        Route::aliasMiddleware('user', UserMiddleware::class);
    }
}
