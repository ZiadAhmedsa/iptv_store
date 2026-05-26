<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FreeSubscriptionPlan;
use App\Models\UserFreeSubscription;
use Illuminate\Http\Request;

class FreeSubscriptionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $userSubscriptions = collect();
        $pendingSubscriptions = collect();
        $macAddress = null;
        $canClaim = false;
        $nextClaimAt = null;

        if ($user) {
            $userSubscriptions = UserFreeSubscription::with('plan')
                ->where('user_id', $user->id)
                ->latest('claimed_at')
                ->get();

            $pendingSubscriptions = $userSubscriptions->where('status', 'requested');
            // We want to show all subscriptions (active, expired, requested)
            // But for the 'canClaim' logic, we check the latest claim date.

            $lastClaim = UserFreeSubscription::where('user_id', $user->id)
                ->latest('claimed_at')
                ->first();

            if (!$lastClaim || $lastClaim->claimed_at->addDays(30)->isPast()) {
                $canClaim = true;
            } else {
                $nextClaimAt = $lastClaim->claimed_at->addDays(30);
            }

            $macAddress = request()->cookie('user_mac_address') ?? request()->input('mac_address') ?? 'UNKNOWN';
        }

        $categories = \App\Models\Category::orderBy('sort_order')->get();

        return view('free-subscriptions.index', compact('userSubscriptions', 'pendingSubscriptions', 'macAddress', 'canClaim', 'nextClaimAt', 'categories'));
    }

    public function claim(Request $request)
    {
        $request->validate([
            'plan_id' => 'nullable|exists:free_subscription_plans,id',
            'mac_address' => 'nullable|string|max:255',
            'category_name' => 'required|string|max:255',
        ], [
            'category_name.required' => 'يرجى اختيار فئة الاشتراك المطلوب.',
        ]);

        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'يرجى تسجيل الدخول أولاً للمطالبة بالاشتراك المجاني.');
        }

        $plan = null;
        if ($request->filled('plan_id')) {
            $plan = FreeSubscriptionPlan::where('id', $request->plan_id)
                ->where('is_active', true)
                ->where(function($q) use ($user) {
                    $q->where('assigned_email', $user->email)
                      ->orWhereNull('assigned_email')
                      ->orWhere('assigned_email', '');
                })
                ->first();

            if (!$plan) {
                return back()->with('error', 'لا يوجد اشتراك مجاني مرتبط بهذا البريد الإلكتروني حالياً.');
            }
        }

        $lastSubscription = UserFreeSubscription::where('user_id', $user->id)
            ->latest('claimed_at')
            ->first();

        if ($lastSubscription && $lastSubscription->claimed_at->addDays(30)->isFuture()) {
            $nextClaimDate = $lastSubscription->claimed_at->addDays(30)->format('Y-m-d');
            return back()->with('error', "عذراً، يحق لك طلب اشتراك مجاني واحد فقط كل شهر. يمكنك الطلب القادم ابتداءً من تاريخ: {$nextClaimDate}. نحن نوفر هذه الخدمة لضمان فرصة عادلة لجميع المستخدمين لتجربة الخدمة.");
        }

        UserFreeSubscription::create([
            'user_id' => $user->id,
            'free_subscription_plan_id' => $plan?->id,
            'category_name' => $request->category_name,
            'mac_address' => $request->mac_address ?: 'UNKNOWN',
            'claimed_at' => now(),
            'expires_at' => null,
            'status' => 'requested',
        ]);

        return back()->with('success', 'تم إرسال طلب الاشتراك المجاني بنجاح! سيتم إشعارك حال الموافقة من لوحة التحكم.');
    }
}
