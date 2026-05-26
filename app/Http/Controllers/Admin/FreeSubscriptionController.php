<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FreeSubscriptionPlan;
use App\Models\User;
use App\Models\UserFreeSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class FreeSubscriptionController extends Controller
{
    public function index()
    {
        $plans = FreeSubscriptionPlan::latest()->paginate(15);
        $userEmails = User::orderBy('email')->pluck('email');

        return view('admin.subscription-keys.index', compact('plans', 'userEmails'));
    }

    public function claims()
    {
        $claims = UserFreeSubscription::with(['user', 'plan'])->latest()->paginate(20);
        return view('admin.subscription-keys.claims', compact('claims'));
    }

    public function expiringSoon()
    {
        $twoWeeksFromNow = now()->addDays(14);
        
        // Find subscriptions expiring within 14 days and not already expired
        $expiringSubscriptions = UserFreeSubscription::with(['user', 'plan'])
            ->whereNotNull('expires_at')
            ->where('expires_at', '>', now())
            ->where('expires_at', '<=', $twoWeeksFromNow)
            ->where('status', 'active')
            ->latest('expires_at')
            ->paginate(20);
            
        return view('admin.subscription-keys.expiring', compact('expiringSubscriptions'));
    }

    public function approve(UserFreeSubscription $claim)
    {
        if ($claim->status !== 'requested') {
            return back()->with('error', 'لا يمكن تفعيل هذا الطلب لأنه ليس في حالة انتظار.');
        }

        return redirect()->route('admin.subscription-keys.index', ['email' => $claim->user->email])
            ->with('info', 'تم تحويلك إلى صفحة إنشاء الاشتراك مع تعبئة البريد الإلكتروني الخاص بطلب العميل تلقائياً.');
    }

    public function finalizeClaim(Request $request, UserFreeSubscription $claim)
    {
        if ($claim->status !== 'requested') {
            return redirect()->route('admin.subscription-keys.claims')->with('error', 'هذا الطلب قد تمت معالجته مسبقاً.');
        }

        $request->validate([
            'plan_id' => 'required|exists:free_subscription_plans,id',
            'days' => 'required|integer|min:1|max:365',
        ]);

        $plan = FreeSubscriptionPlan::findOrFail($request->plan_id);
        $plan->update(['assigned_email' => $claim->user->email]);

        $claim->update([
            'free_subscription_plan_id' => $plan->id,
            'status' => 'active',
            'expires_at' => now()->addDays($request->days),
        ]);

        return redirect()->route('admin.subscription-keys.claims')->with('success', 'تم تفعيل طلب الاشتراك المجاني بنجاح.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'host' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_days' => 'nullable|integer|min:1',
            'assigned_email' => 'required|email|exists:users,email|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $assignedEmail = strtolower(trim($request->assigned_email));
        $user = User::where('email', $assignedEmail)->first();

        $plan = FreeSubscriptionPlan::create([
            'title' => $request->title,
            'host' => $request->host,
            'username' => $request->username,
            'password' => $request->password,
            'description' => $request->description,
            'duration_days' => $request->duration_days,
            'assigned_email' => $assignedEmail,
            'is_active' => $request->has('is_active'),
        ]);

        $expiresAt = $request->duration_days ? now()->addDays((int) $request->duration_days) : now()->addMonth();

        // البحث عن طلب معلق لهذا العميل وتحديثه بدلاً من إنشاء جديد (لضمان الربط وتتبع الطلب)
        $pendingClaim = UserFreeSubscription::where('user_id', $user->id)
            ->where('status', 'requested')
            ->latest()
            ->first();

        if ($pendingClaim) {
            $pendingClaim->update([
                'free_subscription_plan_id' => $plan->id,
                'status' => 'active',
                'expires_at' => $expiresAt,
            ]);
        } else {
            // إذا لم يكن لديه طلب، ننشئ له اشتراكاً نشطاً مباشرة
            UserFreeSubscription::create([
                'user_id' => $user->id,
                'free_subscription_plan_id' => $plan->id,
                'mac_address' => 'ASSIGNED-BY-ADMIN',
                'status' => 'active',
                'claimed_at' => now(),
                'expires_at' => $expiresAt,
            ]);
        }

        return redirect()->route('admin.subscription-keys.index')->with('success', 'تم حفظ الاشتراك وتفعيله للعميل بنجاح.');
    }

    public function edit(FreeSubscriptionPlan $plan)
    {
        $userEmails = User::orderBy('email')->pluck('email');
        return view('admin.subscription-keys.edit', compact('plan', 'userEmails'));
    }

    public function update(Request $request, FreeSubscriptionPlan $plan)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'host' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_days' => 'nullable|integer|min:1',
            'assigned_email' => 'required|email|exists:users,email|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $assignedEmail = strtolower(trim($request->assigned_email));
        $user = User::where('email', $assignedEmail)->first();

        $plan->update([
            'title' => $request->title,
            'host' => $request->host,
            'username' => $request->username,
            'password' => $request->password,
            'description' => $request->description,
            'duration_days' => $request->duration_days,
            'assigned_email' => $assignedEmail,
            'is_active' => $request->has('is_active'),
        ]);

        $expiresAt = $request->duration_days ? now()->addDays((int) $request->duration_days) : now()->addMonth();

        $subscription = UserFreeSubscription::where('free_subscription_plan_id', $plan->id)->latest()->first();
        if ($subscription) {
            $subscription->update([
                'user_id' => $user->id,
                'expires_at' => $expiresAt,
            ]);
        }

        return redirect()->route('admin.subscription-keys.index')->with('success', 'تم تحديث الاشتراك المجاني بنجاح.');
    }

    public function destroy(FreeSubscriptionPlan $plan)
    {
        if ($plan->assigned_email) {
            $user = User::where('email', $plan->assigned_email)->first();

            if ($user) {
                UserFreeSubscription::where('user_id', $user->id)
                    ->where('free_subscription_plan_id', $plan->id)
                    ->delete();
            }
        }

        $plan->delete();

        return back()->with('success', 'تم حذف الاشتراك المجاني وإزالته من العميل المرتبط بالبريد الإلكتروني بنجاح.');
    }

    public function sendExpirationAlert(\Illuminate\Http\Request $request, FreeSubscriptionPlan $plan)
    {
        if (!$plan->assigned_email) {
            return back()->with('error', 'لا يوجد بريد إلكتروني مرتبط بهذا الاشتراك لإرسال التنبيه.');
        }

        $user = User::where('email', $plan->assigned_email)->first();
        $subscription = UserFreeSubscription::where('free_subscription_plan_id', $plan->id)->latest()->first();

        if (!$subscription || !$subscription->expires_at) {
            return back()->with('error', 'لا يمكن تحديد تاريخ انتهاء هذا الاشتراك.');
        }

        try {
            $body = $request->input('message_body');
            
            if (!$body) {
                $body = "مرحباً {$user->name}،\n\nنود تذكيرك بأن اشتراكك المجاني ({$plan->title}) شارف على الانتهاء.\n"
                      . "تاريخ الانتهاء: {$subscription->expires_at->format('Y-m-d')}\n\n"
                      . "يرجى تجديد الاشتراك لضمان استمرار الخدمة.\nمع تحيات فريق متجرنا.";
            }

            Mail::raw($body, function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('تنبيه: اقتراب موعد انتهاء الاشتراك');
            });

            return back()->with('success', 'تم إرسال رسالة تنبيه الانتهاء إلى العميل بنجاح.');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء إرسال البريد الإلكتروني. تأكد من إعدادات الـ SMTP.');
        }
    }
}
