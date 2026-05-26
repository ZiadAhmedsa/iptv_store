<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = Cache::remember('admin_dashboard_stats', 30, function () {
            $hasOrders = Order::exists();
            $totalSales = $hasOrders ? (Order::where('status', 'completed')->sum('total_amount') ?: 0) : 0;
            return [
                'total_sales' => $totalSales,
                'total_orders' => Order::count(),
                'total_products' => Product::count(),
                'total_users' => User::count(),
                'pending_orders' => Order::where('status', 'pending')->count(),
                'total_categories' => Category::count(),
                'pending_claims' => \App\Models\UserFreeSubscription::where('status', 'requested')->count(),
            ];
        });

        $recent_orders = Order::with('user')->latest()->take(8)->get();
        $recent_claims = \App\Models\UserFreeSubscription::with(['user', 'plan'])->where('status', 'requested')->latest()->take(5)->get();
        $latest_users = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_orders', 'recent_claims', 'latest_users'));
    }

    public function realtimeStats()
    {
        $hasOrders = Order::exists();
        $totalSales = $hasOrders ? (Order::where('status', 'completed')->sum('total_amount') ?: 0) : 0;
        return response()->json([
            'total_sales' => $totalSales,
            'total_orders' => Order::count(),
            'total_products' => Product::count(),
            'total_users' => User::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'pending_claims' => \App\Models\UserFreeSubscription::where('status', 'requested')->count(),
        ]);
    }
}
