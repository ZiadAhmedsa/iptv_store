<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $completedOrdersCount = $user->orders()->where('status', 'completed')->count();
        $orders = $user->orders()->with('items.product')->latest()->get();

        return response()->json([
            'user' => $user,
            'completed_orders_count' => $completedOrdersCount,
            'orders' => $orders,
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['required', 'string', 'min:7', 'max:20', 'unique:users,phone,' . $user->id],
        ], [
            'name.required' => 'يرجى إدخال الاسم الكامل.',
            'email.unique' => 'هذا البريد الإلكتروني مستخدم بالفعل.',
            'phone.unique' => 'هذا الرقم مستخدم بالفعل.',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return response()->json([
            'message' => 'تم تحديث البيانات الشخصية بنجاح.',
            'user' => $user->fresh(),
        ]);
    }

    public function changePassword(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'current_password.required' => 'يرجى إدخال كلمة المرور الحالية.',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'كلمة المرور الحالية غير صحيحة.'], 422);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return response()->json(['message' => 'تم تغيير كلمة المرور بنجاح.']);
    }

    public function requestPasswordChange(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'كلمة المرور الحالية غير صحيحة.'], 422);
        }

        $code = mt_rand(100000, 999999);
        
        // Store code in cache with user id as key (expires in 10 minutes)
        cache()->put("password_change_code_{$user->id}", [
            'code' => (string) $code,
            'new_password' => $request->password,
        ], now()->addMinutes(10));

        try {
            Mail::raw(
                "كود التحقق لتغيير كلمة المرور في INZO STORE هو: {$code}\n\nإذا لم تكن أنت من طلب هذا التغيير، يرجى تجاهل هذا البريد وتأمين حسابك.",
                function ($mail) use ($user) {
                    $mail->to($user->email)
                         ->subject('كود التحقق - تغيير كلمة المرور');
                }
            );

            return response()->json(['message' => 'تم إرسال كود التحقق إلى بريدك الإلكتروني.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'فشل إرسال كود التحقق. يرجى المحاولة لاحقاً.'], 500);
        }
    }

    public function confirmPasswordChange(Request $request)
    {
        $request->validate([
            'verification_code' => ['required', 'string', 'size:6'],
        ]);

        $user = $request->user();
        $cached = cache()->get("password_change_code_{$user->id}");

        if (!$cached) {
            return response()->json(['message' => 'انتهت صلاحية كود التحقق. يرجى إعادة المحاولة.'], 422);
        }

        if ($request->verification_code === $cached['code']) {
            $user->update([
                'password' => Hash::make($cached['new_password']),
            ]);

            cache()->forget("password_change_code_{$user->id}");

            return response()->json(['message' => 'تم تغيير كلمة المرور بنجاح.']);
        }

        return response()->json(['message' => 'كود التحقق غير صحيح.'], 422);
    }
}
