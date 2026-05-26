<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($qu) use ($search) {
                      $qu->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('phone', 'LIKE', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Calculate counts based on the whole table/filtered query, not paginated collection!
        $totalOrders = $query->count();
        $completedCount = (clone $query)->where('status', 'completed')->count();
        $pendingCount = (clone $query)->where('status', 'pending')->count();

        $orders = $query->latest()->paginate(15);
        return view('admin.orders.index', compact('orders', 'totalOrders', 'completedCount', 'pendingCount'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'delivery_status' => 'required|in:pending,processing,completed',
            'payment_status' => 'nullable|in:pending,paid,failed,refunded',
            'payment_method' => 'nullable|string|max:50',
        ]);

        $data = [
            'delivery_status' => $request->delivery_status,
        ];

        if ($request->filled('payment_status')) {
            $data['payment_status'] = $request->payment_status;
            if ($request->payment_status === 'paid' && $order->status !== 'completed') {
                $data['status'] = 'paid';
            }
        }

        if ($request->filled('payment_method')) {
            $data['payment_method'] = $request->payment_method;
        }

        if ($request->delivery_status === 'completed') {
            $data['status'] = 'completed';
        }

        $order->update($data);
        Cache::forget('admin_dashboard_stats');
        Cache::forget('admin_report_stats');
        Cache::forget('admin_notification_stats');

        return back()->with('success', 'تم تحديث حالة الطلب بنجاح!');
    }

    public function markAsCompleted(Order $order)
    {
        $order->update(['status' => 'completed', 'delivery_status' => 'completed']);
        Cache::forget('admin_dashboard_stats');
        Cache::forget('admin_report_stats');
        Cache::forget('admin_notification_stats');
        return back()->with('success', 'تم تعليم الطلب كمكتمل بنجاح!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'تم حذف الطلب بنجاح!');
    }
}
