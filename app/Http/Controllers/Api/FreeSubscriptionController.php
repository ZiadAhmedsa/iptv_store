<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FreeSubscriptionPlan;
use App\Models\UserFreeSubscription;
use App\Models\Category;
use Illuminate\Http\Request;

class FreeSubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $userSubscriptions = collect();
        $canClaim = false;
        $nextClaimAt = null;

        if ($user) {
            $userSubscriptions = UserFreeSubscription::with('plan')
                ->where('user_id', $user->id)
                ->latest('claimed_at')
                ->get();

            $lastClaim = UserFreeSubscription::where('user_id', $user->id)
                ->latest('claimed_at')
                ->first();

            if (!$lastClaim || $lastClaim->claimed_at->addDays(30)->isPast()) {
                $canClaim = true;
            } else {
                $nextClaimAt = $lastClaim->claimed_at->addDays(30)->toISOString();
            }
        }

        $categories = Category::orderBy('sort_order')->get();

        return response()->json([
            'user_subscriptions' => $userSubscriptions,
            'can_claim' => $canClaim,
            'next_claim_at' => $nextClaimAt,
            'categories' => $categories,
        ]);
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

        $user = $request->user();

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
                return response()->json(['message' => 'لا يوجد اشتراك مجاني مرتبط بهذا البريد الإلكتروني حالياً.'], 422);
            }
        }

        $lastSubscription = UserFreeSubscription::where('user_id', $user->id)
            ->latest('claimed_at')
            ->first();

        if ($lastSubscription && $lastSubscription->claimed_at->addDays(30)->isFuture()) {
            $nextClaimDate = $lastSubscription->claimed_at->addDays(30)->format('Y-m-d');
            return response()->json([
                'message' => "عذراً، يحق لك طلب اشتراك مجاني واحد فقط كل شهر. يمكنك الطلب القادم ابتداءً من تاريخ: {$nextClaimDate}."
            ], 422);
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

        return response()->json(['message' => 'تم إرسال طلب الاشتراك المجاني بنجاح! سيتم إشعارك حال الموافقة من لوحة التحكم.']);
    }
}
