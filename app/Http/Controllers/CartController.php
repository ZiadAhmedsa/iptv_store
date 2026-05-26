<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->getTotal();
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $productId)
    {
        $quantity = $request->input('quantity', 1);
        $this->cartService->addToCart($productId, $quantity);
        return redirect()->back()->with('success', 'تم إضافة المنتج إلى السلة بنجاح.');
    }

    public function update(Request $request, $productId)
    {
        $quantity = $request->input('quantity', 1);
        $this->cartService->updateQuantity($productId, $quantity);
        return redirect()->route('cart.index')->with('success', 'تم تحديث السلة.');
    }

    public function remove($productId)
    {
        $this->cartService->removeFromCart($productId);
        return redirect()->route('cart.index')->with('success', 'تم إزالة المنتج من السلة.');
    }
}
