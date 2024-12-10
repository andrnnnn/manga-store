<?php

namespace App\Http\Controllers\Admin;

use App\Models\Manga;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController
{
    public function index()
    {
        $totalManga = Manga::count();
        $totalUsers = User::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');

        return view('admin.dashboard', compact('totalManga', 'totalUsers', 'totalRevenue'));
    }
} 