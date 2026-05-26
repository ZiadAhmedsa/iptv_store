<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Exception;

class CheckoutService
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function processCheckout($user, $data)
    {
        $cart = $this->cartService->getCart();
        if (empty($cart)) {
            throw new Exception("Cart is empty.");
        }

        $productIds = array_values(array_unique(array_map(fn($item) => $item['id'], $cart)));
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $missingIds = [];
        foreach ($cart as $item) {
            if (!isset($products[$item['id']])) {
                $missingIds[] = $item['id'];
            }
        }

        if (!empty($missingIds)) {
            foreach ($missingIds as $missingId) {
                $this->cartService->removeFromCart($missingId);
            }
            $message = 'أحد المنتجات في السلة غير متوفر حالياً وتمت إزالته. يرجى تحديث السلة ومحاولة الدفع مرة أخرى.';
            throw new Exception($message);
        }

        $totalAmount = 0;
        foreach ($cart as $item) {
            $product = $products[$item['id']];
            $totalAmount += $product->effective_price * $item['quantity'];
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => $user->id,
                'total' => $totalAmount,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'payment_method' => 'whatsapp',
                'payment_status' => 'pending',
                'delivery_status' => 'pending',
                'whatsapp_number' => $data['whatsapp_number'] ?? '',
                'notes' => $data['notes'] ?? ''
            ]);

            foreach ($cart as $item) {
                $product = $products[$item['id']];
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->effective_price,
                ]);
            }

            $this->cartService->clearCart();

            DB::commit();

            Cache::forget('admin_dashboard_stats');
            Cache::forget('admin_report_stats');
            Cache::forget('admin_notification_stats');

            return $order;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
