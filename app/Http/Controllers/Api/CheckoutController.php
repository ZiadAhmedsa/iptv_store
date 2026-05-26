<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'whatsapp_number' => 'required|string|max:30',
            'notes' => 'nullable|string|max:1000',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1|max:100',
        ]);

        $user = Auth::user();

        try {
            $order = DB::transaction(function () use ($request, $user) {
                $items = collect($request->input('items'))
                    ->groupBy('product_id')
                    ->map(fn ($rows, $productId) => [
                        'product_id' => (int) $productId,
                        'quantity' => (int) $rows->sum('quantity'),
                    ])
                    ->values();

                $products = Product::query()
                    ->whereIn('id', $items->pluck('product_id'))
                    ->where('is_active', true)
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('id');

                if ($products->count() !== $items->count()) {
                    throw ValidationException::withMessages([
                        'items' => ['One or more products are unavailable.'],
                    ]);
                }

                $totalAmount = 0;
                foreach ($items as $item) {
                    $product = $products[$item['product_id']];
                    if ($product->stock < $item['quantity']) {
                        throw ValidationException::withMessages([
                            'items' => ["Insufficient stock for {$product->name}."],
                        ]);
                    }

                    $totalAmount += $product->effective_price * $item['quantity'];
                }

                $order = Order::create([
                    'user_id' => $user->id,
                    'total' => $totalAmount,
                    'total_amount' => $totalAmount,
                    'status' => 'pending',
                    'payment_method' => 'whatsapp',
                    'payment_status' => 'pending',
                    'delivery_status' => 'pending',
                    'whatsapp_number' => $request->whatsapp_number,
                    'notes' => $request->notes ?? '',
                ]);

                $now = now();
                OrderItem::insert($items->map(function ($item) use ($order, $products, $now) {
                    $product = $products[$item['product_id']];

                    $product->decrement('stock', $item['quantity']);

                    return [
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $item['quantity'],
                        'price' => $product->effective_price,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                })->all());

                return $order->load('items');
            });

            Cache::forget('admin_dashboard_stats');
            Cache::forget('admin_report_stats');
            Cache::forget('admin_notification_stats');

            return response()->json([
                'message' => 'Order placed successfully',
                'order' => $order,
            ], 201);

        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Failed to process order',
            ], 500);
        }
    }
}
