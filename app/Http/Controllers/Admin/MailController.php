<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OfficialMail;

class MailController extends Controller
{
    public function index()
    {
        $users = User::all();
        
        $templates = [
            [
                'name' => 'عروض ترويجية',
                'subject' => 'عرض خاص وحصري لك من متجرنا 🎁',
                'body' => "أهلاً بك عميلنا العزيز،\n\nيسعدنا أن نقدم لك عرضاً حصرياً ومميزاً بمناسبة الأيام القادمة.\n\nلا تفوت الفرصة واستمتع بأفضل الباقات لدينا بأسعار لا تقبل المنافسة.\n\nتفضل بزيارة متجرنا لمعرفة المزيد."
            ],
            [
                'name' => 'تفعيل الاشتراك',
                'subject' => 'تم تفعيل اشتراكك بنجاح ✅',
                'body' => "مرحباً،\n\nنود إعلامك بأنه قد تم تفعيل اشتراكك بنجاح. يمكنك الآن البدء في الاستمتاع بجميع خدماتنا بكل سهولة.\n\nبيانات الدخول الخاصة بك تجدها في حسابك بمجرد تسجيل الدخول للمتجر.\n\nنتمنى لك مشاهدة ممتعة!"
            ],
            [
                'name' => 'تحديثات هامة',
                'subject' => 'تحديثات هامة بخصوص خدماتنا 🔧',
                'body' => "عميلنا العزيز،\n\nنود إشعاركم بأنه سيتم إجراء بعض التحديثات الدورية على خوادمنا لضمان استقرار الخدمة وتقديم جودة أفضل.\n\nنشكر لكم تفهمكم وثقتكم بنا."
            ]
        ];

        return view('admin.mail.index', compact('users', 'templates'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'target' => 'required|in:all,specific',
            'user_id' => 'required_if:target,specific|nullable|exists:users,id',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $subject = $request->subject;
        $body = $request->body;

        try {
            if ($request->target === 'all') {
                $users = User::whereNotNull('email')->get();
                $count = 0;
                foreach ($users as $user) {
                    try {
                        Mail::to($user->email)->send(new OfficialMail($subject, $body, $user->name));
                        $count++;
                    } catch (\Exception $e) {
                        // Skip if one email fails
                        continue;
                    }
                }
                $message = "تم إرسال البريد لجميع العملاء (" . $count . " من أصل " . $users->count() . ") بنجاح!";
            } else {
                $user = User::find($request->user_id);
                if ($user && $user->email) {
                    Mail::to($user->email)->send(new OfficialMail($subject, $body, $user->name));
                    $message = "تم إرسال البريد إلى العميل {$user->name} بنجاح!";
                } else {
                    return back()->with('error', 'العميل المحدد لا يمتلك بريداً إلكترونياً صالحاً.');
                }
            }

            return back()->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء الإرسال: ' . $e->getMessage());
        }
    }
}
