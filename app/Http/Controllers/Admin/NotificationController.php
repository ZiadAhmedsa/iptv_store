<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\UserFreeSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        $stats = Cache::remember('admin_notification_stats', 120, function () {
            $dayAgo = now()->subDay();

            $orderStats = DB::table('orders')
                ->selectRaw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending_orders,
                             SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_orders,
                             SUM(CASE WHEN created_at >= ? THEN 1 ELSE 0 END) as new_orders_last_day",
                    [$dayAgo])
                ->first();

            return [
                'new_orders_last_day' => $orderStats->new_orders_last_day ?? 0,
                'pending_orders' => $orderStats->pending_orders ?? 0,
                'completed_orders' => $orderStats->completed_orders ?? 0,
                'pending_subscription_requests' => DB::table('user_free_subscriptions')->where('status', 'requested')->count(),
                'latest_order_id' => Order::latest('id')->value('id') ?? 0,
                'latest_subscription_claim_id' => UserFreeSubscription::where('status', 'requested')->latest('id')->value('id') ?? 0,
            ];
        });

        $pendingOrders = Order::where('status', 'pending')
            ->latest('id')
            ->with(['user:id,name,email'])
            ->take(20)
            ->get()
            ->map(function($order) {
                return (object)[
                    'id' => $order->id,
                    'type' => 'order',
                    'title' => 'طلب منتج جديد #' . $order->id,
                    'message' => 'العميل ' . ($order->user->name ?? 'زائر') . ' قام بطلب منتج بانتظار المراجعة.',
                    'icon' => 'ph-shopping-bag-open',
                    'link' => route('admin.orders.show', $order->id),
                    'created_at' => $order->created_at,
                    'read_at' => null
                ];
            });

        $pendingSubscriptionRequests = UserFreeSubscription::where('status', 'requested')
            ->latest('id')
            ->with(['user:id,name,email', 'plan:id,title'])
            ->take(20)
            ->get()
            ->map(function($claim) {
                return (object)[
                    'id' => $claim->id,
                    'type' => 'subscription',
                    'title' => 'طلب اشتراك مجاني',
                    'message' => 'العميل ' . ($claim->user->name ?? 'زائر') . ' يطلب تفعيل ' . ($claim->plan->title ?? 'باقة اشتراك') . '.',
                    'icon' => 'ph-gift',
                    'link' => route('admin.subscription-keys.claims'),
                    'created_at' => $claim->created_at,
                    'read_at' => null
                ];
            });

        $notifications = $pendingOrders->concat($pendingSubscriptionRequests)->sortByDesc('created_at');

        return view('admin.notifications.index', compact('stats', 'notifications'));
    }

    public function pollOrders(Request $request)
    {
        $lastOrderId = (int) $request->query('last_order_id', 0);
        $lastSubscriptionClaimId = (int) $request->query('last_subscription_claim_id', 0);

        $orderStats = DB::table('orders')
            ->selectRaw(
                "MAX(id) as latest_order_id,
                 SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending_orders",
            )
            ->first();

        $subscriptionStats = DB::table('user_free_subscriptions')
            ->where('status', 'requested')
            ->selectRaw('MAX(id) as latest_subscription_claim_id, COUNT(*) as pending_subscription_requests')
            ->first();

        $latestOrderId = (int) ($orderStats->latest_order_id ?? 0);
        $latestSubscriptionClaimId = (int) ($subscriptionStats->latest_subscription_claim_id ?? 0);

        return response()->json([
            'new_orders' => $latestOrderId > $lastOrderId ? DB::table('orders')->where('id', '>', $lastOrderId)->count() : 0,
            'new_subscription_requests' => $latestSubscriptionClaimId > $lastSubscriptionClaimId ? DB::table('user_free_subscriptions')->where('status', 'requested')->where('id', '>', $lastSubscriptionClaimId)->count() : 0,
            'pending_orders' => (int) ($orderStats->pending_orders ?? 0),
            'pending_subscription_requests' => (int) ($subscriptionStats->pending_subscription_requests ?? 0),
            'completed_orders' => (int) (DB::table('orders')->where('status', 'completed')->count()),
            'latest_order_id' => $latestOrderId,
            'latest_subscription_claim_id' => $latestSubscriptionClaimId,
        ]);
    }
}
