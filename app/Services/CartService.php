<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartService
{
    protected $cookieName = 'inzo_cart';
    protected $cookieDuration = 60 * 24 * 30; // 30 days

    public function getCart()
    {
        $cart = Cookie::get($this->cookieName);
        return $cart ? json_decode($cart, true) : [];
    }

    public function addToCart($productId, $quantity = 1)
    {
        $cart = $this->getCart();
        $product = Product::findOrFail($productId);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name_ar' => $product->name_ar,
                'name_en' => $product->name_en,
                'price' => $product->effective_price,
                'quantity' => $quantity,
                'image' => $product->image_url,
            ];
        }

        $this->saveCart($cart);
        return $cart;
    }

    public function updateQuantity($productId, $quantity)
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            if ($quantity <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId]['quantity'] = $quantity;
            }
        }

        $this->saveCart($cart);
        return $cart;
    }

    public function removeFromCart($productId)
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $this->saveCart($cart);
        }

        return $cart;
    }

    public function clearCart()
    {
        Cookie::queue(Cookie::forget($this->cookieName));
    }

    public function getTotal()
    {
        $cart = $this->getCart();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    protected function saveCart($cart)
    {
        Cookie::queue($this->cookieName, json_encode($cart), $this->cookieDuration);
    }
}
