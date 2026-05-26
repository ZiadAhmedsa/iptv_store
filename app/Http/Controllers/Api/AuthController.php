<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'يرجى إدخال البريد الإلكتروني.',
            'password.required' => 'يرجى إدخال كلمة المرور.',
        ]);

        // Step 2: Verify login code
        if ($request->has('verification_code')) {
            $cached = cache()->get("login_code_{$request->user_id}");

            if (!$cached || $request->verification_code !== $cached['code']) {
                return response()->json(['message' => 'كود التحقق الذي أدخلته غير صحيح.'], 422);
            }

            $user = User::find($request->user_id);
            if (!$user) {
                return response()->json(['message' => 'المستخدم غير موجود.'], 404);
            }

            $user->tokens()->delete();
            $token = $user->createToken('flutter-mobile-app')->plainTextToken;
            cache()->forget("login_code_{$request->user_id}");

            return response()->json([
                'user' => $user,
                'token' => $token,
                'message' => 'مرحباً بك في INZO STORE!',
            ]);
        }

        // Step 1: Initial login
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.'], 401);
        }

        if (!$user->is_active) {
            return response()->json(['message' => 'هذا الحساب معطل حالياً. يرجى التواصل مع الدعم الفني.'], 403);
        }

        // Send verification code (4 digits like web)
        $code = mt_rand(1000, 9999);
        cache()->put("login_code_{$user->id}", [
            'code' => (string) $code,
        ], now()->addMinutes(10));

        try {
            Mail::raw(
                "مرحباً {$user->name}!\n\nكود التحقق لتسجيل الدخول إلى INZO STORE هو: {$code}\n\nإذا لم تقم بطلب هذا الكود، يرجى تجاهل هذا البريد.",
                function ($mail) use ($user) {
                    $mail->to($user->email)
                         ->subject('كود التحقق - تسجيل الدخول إلى INZO STORE');
                }
            );

            return response()->json([
                'requires_verification' => true,
                'user_id' => $user->id,
                'message' => 'تم إرسال كود التحقق إلى بريدك الإلكتروني.',
            ]);
        } catch (\Exception $e) {
            // If mail fails, login directly without 2FA
            $user->tokens()->delete();
            $token = $user->createToken('flutter-mobile-app')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
                'message' => 'مرحباً بك في INZO STORE!',
            ]);
        }
    }

    public function register(Request $request)
    {
        if ($request->has('verification_code') && $request->has('user_id')) {
            $request->validate([
                'verification_code' => ['required', 'string'],
                'user_id' => ['required', 'exists:users,id'],
            ]);

            $cached = cache()->get("register_code_{$request->user_id}");

            if (!$cached || $request->verification_code !== $cached['code']) {
                return response()->json(['message' => 'كود التحقق الذي أدخلته غير صحيح.'], 422);
            }

            $user = User::find($request->user_id);
            $user->update(['is_active' => true, 'email_verified_at' => now()]);
            cache()->forget("register_code_{$request->user_id}");

            $token = $user->createToken('flutter-mobile-app')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
                'message' => 'تم تفعيل حسابك بنجاح! أهلاً وسهلاً بك.',
            ]);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:7', 'max:20', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required' => 'يرجى إدخال اسمك الكامل.',
            'email.unique' => 'البريد الإلكتروني مسجل مسبقاً.',
            'phone.unique' => 'رقم الهاتف مسجل مسبقاً.',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'is_active' => false,
        ]);

        $code = mt_rand(1000, 9999);
        cache()->put("register_code_{$user->id}", ['code' => (string) $code], now()->addMinutes(15));

        try {
            Mail::raw(
                "مرحباً {$user->name}!\n\nكود التحقق لتفعيل حسابك في INZO STORE هو: {$code}\n\nيرجى إدخال هذا الكود لإكمال التسجيل.",
                function ($mail) use ($user) {
                    $mail->to($user->email)->subject('كود التحقق - تفعيل حساب INZO STORE');
                }
            );

            return response()->json([
                'requires_verification' => true,
                'user_id' => $user->id,
                'message' => 'تم إرسال كود التحقق إلى بريدك الإلكتروني.',
            ]);
        } catch (\Exception $e) {
            $user->delete();
            return response()->json(['message' => 'فشل إرسال كود التحقق. تأكد من صحة البريد الإلكتروني.'], 500);
        }
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => ['required', 'email', 'exists:users,email']], ['email.exists' => 'لا يوجد حساب بهذا البريد الإلكتروني.']);

        $user = User::where('email', $request->email)->first();
        $code = mt_rand(1000, 9999);
        cache()->put("reset_password_code_{$user->id}", ['code' => (string) $code], now()->addMinutes(15));

        try {
            Mail::raw("كود إعادة تعيين كلمة المرور: {$code}", function ($mail) use ($user) {
                $mail->to($user->email)->subject('كود إعادة تعيين كلمة المرور');
            });
            return response()->json(['message' => 'تم إرسال كود إعادة التعيين.', 'user_id' => $user->id]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'فشل إرسال كود التحقق.'], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'verification_code' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $cached = cache()->get("reset_password_code_{$request->user_id}");
        if (!$cached || $request->verification_code !== $cached['code']) {
            return response()->json(['message' => 'كود التحقق غير صحيح.'], 422);
        }

        User::find($request->user_id)->update(['password' => Hash::make($request->password)]);
        cache()->forget("reset_password_code_{$request->user_id}");

        return response()->json(['message' => 'تم تغيير كلمة المرور بنجاح.']);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'تم تسجيل الخروج بنجاح.']);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
