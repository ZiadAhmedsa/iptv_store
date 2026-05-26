<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subjectLine }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fe;
            margin: 0;
            padding: 0;
            direction: rtl;
            text-align: right;
            color: #1e293b;
        }
        .wrapper {
            width: 100%;
            background-color: #f4f7fe;
            padding: 40px 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }
        .header {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 28px;
            font-weight: 900;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .header p {
            color: rgba(255, 255, 255, 0.8);
            margin: 10px 0 0 0;
            font-size: 14px;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 25px;
            color: #0f172a;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 15px;
            display: inline-block;
        }
        .body-text {
            font-size: 16px;
            line-height: 1.8;
            color: #475569;
            white-space: pre-line;
            margin-bottom: 30px;
        }
        .btn-wrapper {
            text-align: center;
            margin: 40px 0 20px 0;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #ffffff !important;
            text-decoration: none;
            padding: 15px 35px;
            border-radius: 12px;
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0 10px 20px rgba(99,102,241,0.3);
        }
        .footer {
            background-color: #f8fafc;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #f1f5f9;
        }
        .footer p {
            margin: 5px 0;
            font-size: 13px;
            color: #94a3b8;
        }
        .footer-link {
            color: #6366f1;
            text-decoration: none;
        }
    </style>
</head>
<body>
    @php
        $siteName = \App\Models\Setting::get('site_name', 'INZO STORE');
    @endphp
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>{{ $siteName }}</h1>
                <p>إشعار رسمي</p>
            </div>
            
            <div class="content">
                <div class="greeting">أهلاً بك {{ $userName }}،</div>
                
                <div class="body-text">
                    {!! nl2br(e($bodyText)) !!}
                </div>
                
                <div class="btn-wrapper">
                    <a href="{{ url('/') }}" class="btn">تفضل بزيارة المتجر</a>
                </div>
            </div>
            
            <div class="footer">
                <p>هذه رسالة تلقائية من نظام <strong>{{ $siteName }}</strong>. يرجى عدم الرد على هذا البريد.</p>
                <p>إذا كنت بحاجة للمساعدة، <a href="{{ url('/contact') }}" class="footer-link">تواصل معنا</a>.</p>
                <p>&copy; {{ date('Y') }} جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </div>
</body>
</html>
