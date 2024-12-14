<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Manga;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total users (exclude admin)
        $totalUsers = User::where('role', '!=', 'admin')->count();

        // Hitung total manga
        $totalManga = Manga::count();

        // Hitung total pendapatan dari pesanan yang completed
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');

        // Hitung pesanan pending
        $pendingOrders = Order::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalManga',
            'totalRevenue',
            'pendingOrders'
        ));
    }
} 