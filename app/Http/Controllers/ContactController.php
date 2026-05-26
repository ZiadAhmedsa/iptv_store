<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'message' => 'required|string|max:2000',
        ]);

        $recipient = config('mail.from.address') ?: env('MAIL_FROM_ADDRESS');

        try {
            $body = "اسم المرسل: {$request->name}\n" .
                    "البريد الإلكتروني: {$request->email}\n" .
                    "رقم الواتساب: {$request->phone}\n\n" .
                    "الرسالة:\n{$request->message}";

            Mail::raw($body, function ($mail) use ($recipient) {
                $mail->to($recipient)
                    ->subject('رسالة من نموذج الاتصال - INZO STORE');
            });
        } catch (\Exception $e) {
            Log::error('Contact form send failed', ['exception' => $e->getMessage()]);
            return back()->with('error', 'لم نتمكن من إرسال الرسالة. يرجى المحاولة مرة أخرى لاحقاً.');
        }

        return back()->with('success', 'تم استلام رسالتك بنجاح. سنتواصل معك قريباً.');
    }
}
