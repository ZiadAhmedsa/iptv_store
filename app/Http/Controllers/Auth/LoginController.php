<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Rate limiting to prevent brute force attacks
        $this->ensureIsNotRateLimited($request);

        // If we are in the verification step
        if ($request->has('verification_code')) {
            $request->validate([
                'verification_code' => ['required', 'string', 'size:4'],
            ], [
                'verification_code.required' => 'يرجى إدخال كود التحقق المرسل إلى بريدك الإلكتروني.',
                'verification_code.size' => 'كود التحقق يجب أن يكون مكوناً من 4 أرقام.',
            ]);

            if ($request->verification_code == session('temp_login_code')) {
                $userId = session('temp_user_id');
                $user = User::find($userId);

                if ($user) {
                    Auth::login($user, session('temp_remember'));
                    session()->forget(['temp_login_code', 'temp_user_id', 'temp_remember', 'temp_login_email']);
                    RateLimiter::clear($this->throttleKey($request));

                    if ($user->isAdmin()) {
                        return redirect()->intended(route('admin.dashboard'))
                            ->with('success', 'مرحباً بك في لوحة التحكم! تم تسجيل دخولك بنجاح.');
                    }
                    return redirect()->intended(route('home'))
                        ->with('success', 'مرحباً بك في INZO STORE! تم تسجيل دخولك بنجاح.');
                }
            }

            RateLimiter::hit($this->throttleKey($request));

            throw ValidationException::withMessages([
                'verification_code' => 'كود التحقق الذي أدخلته غير صحيح. يرجى المحاولة مرة أخرى.',
            ])->errorBag('verification');
        }

        // Initial login step
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:8'],
        ], [
            'email.required' => 'يرجى إدخال عنوان البريد الإلكتروني.',
            'email.email' => 'يرجى إدخال عنوان بريد إلكتروني صالح.',
            'email.max' => 'عنوان البريد الإلكتروني طويل جداً.',
            'password.required' => 'يرجى إدخال كلمة المرور.',
            'password.min' => 'كلمة المرور يجب أن تكون على الأقل 8 أحرف.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            RateLimiter::hit($this->throttleKey($request));

            throw ValidationException::withMessages([
                'email' => 'لا يمكن العثور على حساب بهذا البريد الإلكتروني.',
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            RateLimiter::hit($this->throttleKey($request));

            throw ValidationException::withMessages([
                'password' => 'كلمة المرور التي أدخلتها غير صحيحة.',
            ]);
        }

        if (!$user->is_active) {
            throw ValidationException::withMessages([
                'email' => 'هذا الحساب معطل حالياً. يرجى التواصل مع الدعم الفني.',
            ]);
        }

        // For admin users, require 2FA
        if ($user->isAdmin()) {
            $code = mt_rand(1000, 9999);
            session([
                'temp_login_code' => (string) $code,
                'temp_user_id' => $user->id,
                'temp_remember' => $request->boolean('remember'),
                'temp_login_email' => $user->email,
            ]);

            try {
                Mail::raw(
                    "كود التحقق لتسجيل الدخول إلى لوحة التحكم: {$code}\n\nإذا لم تقم بطلب هذا الكود، يرجى تجاهل هذا البريد.",
                    function ($mail) use ($user) {
                        $mail->to($user->email)
                             ->subject('كود التحقق - تسجيل الدخول إلى INZO STORE');
                    }
                );

                return back()->with('show_login_verification', true)
                    ->with('message', 'تم إرسال كود التحقق إلى بريدك الإلكتروني للأمان الإضافي.')
                    ->onlyInput('email');
            } catch (\Exception $e) {
                return back()->with('error', 'فشل إرسال كود التحقق. يرجى المحاولة لاحقاً.')
                    ->onlyInput('email');
            }
        }

        Auth::login($user, $request->boolean('remember'));

        RateLimiter::clear($this->throttleKey($request));

        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'مرحباً بك في لوحة التحكم! تم تسجيل دخولك بنجاح.');
        }

        return redirect()->intended(route('home'))
            ->with('success', 'مرحباً بك في INZO STORE! تم تسجيل دخولك بنجاح.');
    }

    public function logout(Request $request)
    {
        auth('web')->logout();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'تم تسجيل خروجك بنجاح.');
    }

    public function resetVerification(Request $request)
    {
        session()->forget(['temp_login_code', 'temp_user_id', 'temp_remember', 'temp_login_email', 'show_login_verification']);
        return redirect()->route('login')->with('info', 'يمكنك الآن تعديل بيانات الدخول.');
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(Request $request): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => "تم تجاوز عدد المحاولات المسموح بها. يرجى المحاولة مرة أخرى خلال {$seconds} ثانية.",
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(Request $request): string
    {
        $email = $request->input('email') ?: session('temp_login_email');

        return strtolower($email ?? '') . '|' . $request->ip();
    }
}
