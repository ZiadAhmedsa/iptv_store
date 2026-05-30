<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subjectLine ?? 'كود التحقق' }}</title>
</head>
<body style="margin:0;padding:0;background-color:#f6f8fa;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;direction:rtl;text-align:right;">
    @php
        $siteName = \App\Models\Setting::get('site_name', 'World Cup 4K Store');
        $themeColor = \App\Models\Setting::get('theme_color', '#6366f1');
        $siteUrl = url('/');
    @endphp

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f6f8fa;padding:40px 0;">
        <tr>
            <td align="center">
                <table width="520" cellpadding="0" cellspacing="0" style="max-width:520px;width:100%;">
                    <!-- Logo Header -->
                    <tr>
                        <td align="center" style="padding:32px 0 24px 0;">
                            <a href="{{ $siteUrl }}" style="text-decoration:none;">
                                <div style="display:inline-flex;align-items:center;gap:12px;">
                                    <div style="width:40px;height:40px;background:linear-gradient(135deg,{{ $themeColor }},#8b5cf6);border-radius:12px;display:inline-block;text-align:center;line-height:40px;color:white;font-weight:900;font-size:14px;">4K</div>
                                    <span style="font-size:22px;font-weight:900;color:#24292f;letter-spacing:-0.5px;">{{ $siteName }}</span>
                                </div>
                            </a>
                        </td>
                    </tr>

                    <!-- Main Card -->
                    <tr>
                        <td>
                            <table width="100%" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;border:1px solid #d0d7de;overflow:hidden;">
                                <!-- Accent Bar -->
                                <tr>
                                    <td style="height:4px;background:linear-gradient(90deg,{{ $themeColor }},#8b5cf6);"></td>
                                </tr>

                                <!-- Content -->
                                <tr>
                                    <td style="padding:40px 32px;">
                                        <!-- Greeting -->
                                        <h2 style="margin:0 0 8px 0;font-size:22px;font-weight:800;color:#24292f;">
                                            مرحباً {{ $userName ?? 'عزيزي العميل' }}،
                                        </h2>
                                        <p style="margin:0 0 28px 0;font-size:15px;color:#656d76;line-height:1.6;">
                                            {{ $messageText ?? 'تم طلب كود التحقق الخاص بحسابك.' }}
                                        </p>

                                        <!-- Verification Code Box -->
                                        <table width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 28px 0;">
                                            <tr>
                                                <td align="center">
                                                    <div style="background:#f6f8fa;border:2px dashed #d0d7de;border-radius:12px;padding:24px 40px;display:inline-block;">
                                                        <p style="margin:0 0 8px 0;font-size:12px;font-weight:700;color:#656d76;text-transform:uppercase;letter-spacing:2px;">كود التحقق</p>
                                                        <p style="margin:0;font-size:38px;font-weight:900;color:{{ $themeColor }};letter-spacing:8px;font-family:'Courier New',monospace;">{{ $verificationCode }}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- Info Note -->
                                        <table width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 24px 0;">
                                            <tr>
                                                <td style="background:#ddf4ff;border:1px solid #54aeff;border-radius:8px;padding:14px 16px;">
                                                    <p style="margin:0;font-size:13px;color:#0969da;line-height:1.6;font-weight:600;">
                                                        💡 هذا الكود صالح لمدة محدودة. إذا لم تكن أنت من طلب هذا الكود، يرجى تجاهل هذا البريد وتأمين حسابك فوراً.
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>

                                        <!-- CTA Button -->
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center" style="padding:8px 0;">
                                                    <a href="{{ $siteUrl }}" style="display:inline-block;background:linear-gradient(135deg,{{ $themeColor }},#8b5cf6);color:#ffffff;text-decoration:none;padding:14px 32px;border-radius:8px;font-weight:800;font-size:15px;box-shadow:0 4px 12px rgba(99,102,241,0.3);">
                                                        زيارة {{ $siteName }}
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:24px 0;text-align:center;">
                            <p style="margin:0 0 6px 0;font-size:12px;color:#656d76;">
                                هذه رسالة تلقائية من نظام <strong>{{ $siteName }}</strong>. يرجى عدم الرد على هذا البريد.
                            </p>
                            <p style="margin:0 0 6px 0;font-size:12px;color:#656d76;">
                                إذا كنت بحاجة للمساعدة، <a href="{{ url('/contact') }}" style="color:{{ $themeColor }};text-decoration:none;font-weight:700;">تواصل معنا</a>
                            </p>
                            <p style="margin:0;font-size:11px;color:#8b949e;">
                                &copy; {{ date('Y') }} {{ $siteName }}. جميع الحقوق محفوظة.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
