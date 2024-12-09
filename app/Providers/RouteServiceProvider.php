<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/user/dashboard'; // Default redirect untuk user biasa
    public const ADMIN_HOME = '/admin/dashboard'; // Default redirect untuk admin

    // ... kode lainnya ...
} 