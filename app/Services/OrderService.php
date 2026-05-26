<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function updateDeliveryStatus(Order $order, $status)
    {
        if (in_array($status, ['pending', 'processing', 'completed'])) {
            $order->update(['delivery_status' => $status]);
            return true;
        }
        return false;
    }
}
