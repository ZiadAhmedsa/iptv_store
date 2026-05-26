<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\CheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    protected $cartService;
    protected $checkoutService;

    public function __construct(CartService $cartService, CheckoutService $checkoutService)
    {
        $this->cartService = $cartService;
        $this->checkoutService = $checkoutService;
    }

    public function index()
    {
        if (empty($this->cartService->getCart())) {
            return redirect()->route('cart.index')->with('error', 'السلة فارغة.');
        }
        
        $total = $this->cartService->getTotal();
        return view('checkout.index', compact('total'));
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'whatsapp_number' => 'required|string',
            'email' => 'required|email',
        ]);

        session(['checkout_data' => $request->all()]);
        return redirect()->route('checkout.payment');
    }

    public function payment()
    {
        if (!session()->has('checkout_data')) {
            return redirect()->route('checkout.index');
        }

        $total = $this->cartService->getTotal();
        $bankName = \App\Models\Setting::get('payment_bank_name', '');
        $bankAccount = \App\Models\Setting::get('payment_bank_account', '');
        $bankIban = \App\Models\Setting::get('payment_bank_iban', '');
        $whatsapp = \App\Models\Setting::get('whatsapp', '');

        return view('checkout.payment', compact('total', 'bankName', 'bankAccount', 'bankIban', 'whatsapp'));
    }

    public function process()
    {
        if (!session()->has('checkout_data')) {
            return redirect()->route('checkout.index');
        }

        $data = session('checkout_data');

        try {
            $this->checkoutService->processCheckout(Auth::user(), $data);
            session()->forget('checkout_data');
            return redirect()->route('checkout.success')->with('success', 'تم إنشاء الطلب بنجاح! سيتم مراجعة الدفع قريباً.');
        } catch (\Exception $e) {
            return redirect()->route('checkout.payment')->with('error', $e->getMessage());
        }
    }

    public function success()
    {
        return view('checkout.success');
    }
}
