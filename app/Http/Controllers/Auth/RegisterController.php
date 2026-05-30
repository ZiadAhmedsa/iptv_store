<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Rate limiting for registration
        $this->ensureIsNotRateLimited($request);

        if ($request->has('verification_code')) {
            $request->validate([
                'verification_code' => ['required', 'string', 'size:6'],
            ], [
                'verification_code.required' => 'يرجى إدخال كود التحقق المرسل إلى بريدك الإلكتروني.',
                'verification_code.size' => 'كود التحقق يجب أن يكون مكوناً من 6 أرقام.',
            ]);

            if ($request->verification_code === session('temp_register_code')) {
                $userId = session('temp_user_id');
                $user = User::find($userId);

                if ($user) {
                    $user->update([
                        'is_active' => true,
                        'email_verified_at' => now(),
                    ]);

                    Auth::login($user);

                    // Clear session data
                    session()->forget(['temp_register_code', 'temp_user_id', 'temp_register_email', 'show_register_verification']);

                    // Clear rate limiter
                    RateLimiter::clear($this->throttleKey($request));

                    return redirect()->route('home')
                        ->with('success', 'تم تفعيل حسابك بنجاح! أهلاً وسهلاً بك في INZO STORE.');
                }
            }

            RateLimiter::hit($this->throttleKey($request));

            throw ValidationException::withMessages([
                'verification_code' => 'كود التحقق الذي أدخلته غير صحيح. يرجى التأكد من الكود والمحاولة مرة أخرى.',
            ])->errorBag('verification');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:2', 'regex:/^[\p{Arabic}\p{L}\s\-\.\']+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:7', 'max:20', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required' => 'يرجى إدخال اسمك الكامل.',
            'name.min' => 'الاسم يجب أن يكون على الأقل حرفين.',
            'name.max' => 'الاسم طويل جداً.',
            'name.regex' => 'الاسم يجب أن يحتوي على أحرف فقط.',
            'email.required' => 'يرجى إدخال عنوان البريد الإلكتروني.',
            'email.email' => 'يرجى إدخال عنوان بريد إلكتروني صالح.',
            'email.max' => 'عنوان البريد الإلكتروني طويل جداً.',
            'email.unique' => 'عنوان البريد الإلكتروني هذا مسجل مسبقاً في النظام.',
            'phone.required' => 'يرجى إدخال رقم الهاتف.',
            'phone.min' => 'رقم الهاتف يجب أن يكون 7 أرقام على الأقل.',
            'phone.max' => 'رقم الهاتف طويل جداً.',
            'phone.unique' => 'رقم الهاتف هذا مسجل مسبقاً في النظام.',
            'password.required' => 'يرجى إدخال كلمة مرور قوية.',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق مع كلمة المرور الأصلية.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'is_active' => false,
        ]);

        $code = mt_rand(100000, 999999);
        session([
            'temp_register_code' => (string) $code,
            'temp_user_id' => $user->id,
            'temp_register_email' => $user->email,
        ]);

        try {
            Mail::send('emails.verification', [
                'subjectLine' => 'كود التحقق - تفعيل الحساب',
                'userName' => $user->name,
                'messageText' => 'شكراً لتسجيلك في World Cup 4K Store. ي     رجى استخدام الكود التالي لتفعيل حسابك.',
                'verificationCode' => $code,
            ], function ($mail) use ($user) {
                $mail->to($user->email)
                    ->subject('كود التحقق - تفعيل حساب World Cup 4K Store');
            });

            return back()->with('show_register_verification', true)
                ->with('message', 'تم إرسال كود التحقق إلى بريدك الإلكتروني. يرجى التحقق من صندوق البريد الوارد أو البريد العشوائي.')
                ->withInput();
        } catch (\Exception $e) {
            // Delete the user if email sending failed
            $user->delete();

            return back()->with('error', 'فشل إرسال كود التحقق. يرجى التأكد من صحة عنوان البريد الإلكتروني والمحاولة مرة أخرى.')
                ->withInput();
        }
    }

    public function resetVerification(Request $request)
    {
        $userId = session('temp_user_id');
        if ($userId) {
            $user = User::find($userId);
            if ($user && !$user->is_active) {
                $user->delete(); // Delete the inactive user so they can register again with same email/phone
            }
        }
        session()->forget(['temp_register_code', 'temp_user_id', 'temp_register_email', 'show_register_verification']);
        return redirect()->route('register')->with('info', 'يمكنك الآن تعديل بيانات التسجيل.');
    }

    /**
     * Ensure the registration request is not rate limited.
     */
    protected function ensureIsNotRateLimited(Request $request): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey($request), 3)) {
            return;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => "تم تجاوز عدد المحاولات المسموح بها. يرجى المحاولة مرة أخرى خلال {$seconds} ثانية.",
        ]);
    }

    /**
     * Get the registration rate limiting throttle key.
     */
    protected function throttleKey(Request $request): string
    {
        return 'register|' . $request->ip();
    }
}
