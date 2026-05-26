<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommunicationController extends Controller
{
    public function sendWhatsApp(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'message' => 'required'
        ]);

        $phone = preg_replace('/[^0-9]/', '', $request->phone);
        $message = urlencode($request->message);
        $url = "https://api.whatsapp.com/send?phone={$phone}&text={$message}";
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'جاري الانتقال للواتساب...',
                'redirect_url' => $url
            ]);
        }

        return redirect()->away($url);
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        try {
            Mail::raw($request->message, function($mail) use ($request) {
                $mail->to($request->email)
                     ->subject($request->subject);
            });

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'تم إرسال البريد الإلكتروني بنجاح!']);
            }

            return back()->with('success', 'تم إرسال البريد الإلكتروني بنجاح!');
        } catch (\Throwable $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'فشل الإرسال: ' . $e->getMessage()]);
            }
            return back()->with('error', 'فشل الإرسال: ' . $e->getMessage());
        }
    }
}
