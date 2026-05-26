<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $completedOrdersCount = $user->orders()->where('status', 'completed')->count();

        return view('profile.index', [
            'user' => $user,
            'completedOrdersCount' => $completedOrdersCount,
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'تم تحديث البيانات الشخصية بنجاح.');
    }

    public function requestPasswordChange(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'current_password.current_password' => 'كلمة المرور الحالية غير صحيحة.',
            'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.',
        ]);

        $code = mt_rand(100000, 999999);
        session([
            'temp_password_change_code' => (string) $code,
            'temp_new_password' => $request->password,
        ]);

        try {
            Mail::raw(
                "كود التحقق لتغيير كلمة المرور في INZO STORE هو: {$code}\n\nإذا لم تكن أنت من طلب هذا التغيير، يرجى تجاهل هذا البريد وتأمين حسابك.",
                function ($mail) use ($user) {
                    $mail->to($user->email)
                         ->subject('كود التحقق - تغيير كلمة المرور');
                }
            );

            return redirect()->route('profile.password.verify')->with('info', 'تم إرسال كود التحقق إلى بريدك الإلكتروني.');
        } catch (\Exception $e) {
            return back()->with('error', 'فشل إرسال كود التحقق. يرجى المحاولة لاحقاً.');
        }
    }

    public function showVerifyForm()
    {
        if (!session('temp_password_change_code')) {
            return redirect()->route('profile.index');
        }
        return view('profile.verify-password');
    }

    public function confirmPasswordChange(Request $request)
    {
        $request->validate([
            'verification_code' => ['required', 'string', 'size:6'],
        ]);

        if ($request->verification_code === session('temp_password_change_code')) {
            $user = Auth::user();
            $user->update([
                'password' => Hash::make(session('temp_new_password')),
            ]);

            session()->forget(['temp_password_change_code', 'temp_new_password']);

            return redirect()->route('profile.index')->with('success', 'تم تغيير كلمة المرور بنجاح.');
        }

        throw ValidationException::withMessages([
            'verification_code' => 'كود التحقق غير صحيح.',
        ]);
    }
}
