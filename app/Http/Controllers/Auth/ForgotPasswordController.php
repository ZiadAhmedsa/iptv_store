<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetCode(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.exists' => 'لا يوجد حساب مسجل بهذا البريد الإلكتروني.',
        ]);

        $user = User::where('email', $request->email)->first();
        $code = mt_rand(100000, 999999);

        session([
            'reset_password_code' => (string) $code,
            'reset_password_user_id' => $user->id,
            'reset_password_email' => $user->email,
        ]);

        try {
            Mail::send('emails.verification', [
                'subjectLine' => 'كود إعادة تعيين كلمة المرور',
                'userName' => $user->name,
                'messageText' => 'لقد طلبت إعادة تعيين كلمة المرور الخاصة بحسابك. استخدم الكود التالي:',
                'verificationCode' => $code,
            ], function ($mail) use ($user) {
                $mail->to($user->email)
                     ->subject('كود إعادة تعيين كلمة المرور');
            });

            return redirect()->route('password.reset')->with('info', 'تم إرسال كود إعادة التعيين إلى بريدك الإلكتروني.');
        } catch (\Exception $e) {
            return back()->with('error', 'فشل إرسال كود التحقق. يرجى المحاولة لاحقاً.');
        }
    }

    public function showResetForm()
    {
        if (!session('reset_password_code')) {
            return redirect()->route('password.request');
        }
        return view('auth.reset-password');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'verification_code' => ['required', 'string', 'size:6'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'verification_code.size' => 'كود التحقق يجب أن يكون 6 أرقام.',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
        ]);

        if ($request->verification_code === session('reset_password_code')) {
            $user = User::find(session('reset_password_user_id'));
            if ($user) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);

                session()->forget(['reset_password_code', 'reset_password_user_id', 'reset_password_email']);

                return redirect()->route('login')->with('success', 'تم إعادة تعيين كلمة المرور بنجاح. يمكنك الآن تسجيل الدخول.');
            }
        }

        throw ValidationException::withMessages([
            'verification_code' => 'كود التحقق غير صحيح.',
        ]);
    }
}
