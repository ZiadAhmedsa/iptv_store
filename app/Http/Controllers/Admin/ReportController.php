<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $stats = Cache::remember('admin_report_stats', 300, function () {
            $oneMonthAgo = Carbon::now()->subMonth();

            // Daily sales for the last 15 days
            $dailySales = [];
            for ($i = 14; $i >= 0; $i--) {
                $date = Carbon::today()->subDays($i);
                $dailySales[] = [
                    'date' => $date->format('Y-m-d'),
                    'total' => Order::where('status', 'completed')->whereDate('created_at', $date)->sum('total_amount')
                ];
            }

            return [
                'monthly_sales' => Order::where('status', 'completed')->where('created_at', '>=', $oneMonthAgo)->sum('total_amount'),
                'completed_orders' => Order::where('status', 'completed')->count(),
                'new_users' => User::where('created_at', '>=', $oneMonthAgo)->count(),
                'pending_orders' => Order::where('status', 'pending')->count(),
                'average_order_value' => Order::where('created_at', '>=', $oneMonthAgo)->avg('total_amount') ?? 0,
                'top_categories' => Category::withCount('products')->orderByDesc('products_count')->take(5)->get(),
                'daily_sales_data' => $dailySales,
            ];
        });

        return view('admin.reports.index', compact('stats'));
    }
}
