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
        $lastMonthUsers = User::where('role', '!=', 'admin')
            ->where('created_at', '<', Carbon::now()->startOfMonth())
            ->count();
        $userGrowth = $lastMonthUsers > 0 
            ? round((($totalUsers - $lastMonthUsers) / $lastMonthUsers) * 100, 1)
            : 0;

        // Hitung total manga
        $totalManga = Manga::count();

        // Hitung total manga bulan lalu untuk persentase
        $lastMonthManga = Manga::where('created_at', '<', Carbon::now()->startOfMonth())->count();
        $mangaGrowth = $lastMonthManga > 0 
            ? round((($totalManga - $lastMonthManga) / $lastMonthManga) * 100, 1)
            : 0;

        // Hitung total pesanan
        $totalOrders = Order::count();
        $lastMonthOrders = Order::where('created_at', '<', Carbon::now()->startOfMonth())->count();
        $orderGrowth = $lastMonthOrders > 0
            ? round((($totalOrders - $lastMonthOrders) / $lastMonthOrders) * 100, 1)
            : 0;

        // Hitung total pendapatan
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');
        $lastMonthRevenue = Order::where('status', 'completed')
            ->where('created_at', '<', Carbon::now()->startOfMonth())
            ->sum('total_price');
        $revenueGrowth = $lastMonthRevenue > 0
            ? round((($totalRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1)
            : 0;

        // Ambil pesanan terbaru
        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'userGrowth',
            'totalManga',
            'mangaGrowth',
            'totalOrders',
            'orderGrowth',
            'totalRevenue',
            'revenueGrowth',
            'recentOrders'
        ));
    }
} 