<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (auth('admin')->check() && auth('admin')->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && !Hash::check($request->password, $user->password)) {
            $message = 'حاول شخص ما تسجيل الدخول بكلمة مرور خاطئة إلى لوحة التحكم.';
            Log::warning('Admin login failed: invalid password', [
                'email' => $request->email,
                'ip' => $request->ip(),
            ]);

            $adminEmail = env('ADMIN_EMAIL');
            if ($adminEmail) {
                try {
                    Mail::raw("{$message}\nالبريد الإلكتروني: {$request->email}\nIP: {$request->ip()}", function ($mail) use ($adminEmail) {
                        $mail->to($adminEmail)->subject('إشعار محاولة دخول فاشلة إلى لوحة التحكم');
                    });
                } catch (\Exception $e) {
                    Log::error('Failed to send admin notification email', ['error' => $e->getMessage()]);
                }
            }

            return back()->with('error', 'كلمة المرور غير صحيحة، تم إخطار الإدارة بالمحاولة')->withInput();
        }

        $credentials = $request->only('email', 'password');
        if (auth('admin')->attempt($credentials)) {
            $user = auth('admin')->user();

            if (!$user->isAdmin()) {
                auth('admin')->logout();
                return back()->with('error', 'غير مصرح لك بالدخول إلى لوحة التحكم');
            }

            if (!$user->is_active) {
                auth('admin')->logout();
                return back()->with('error', 'حسابك غير مفعل');
            }

            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->with('error', 'بيانات الدخول غير صحيحة')->withInput();
    }

    public function logout(Request $request)
    {
        auth('admin')->logout();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
