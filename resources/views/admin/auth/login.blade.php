<!DOCTYPE html>
<html lang="ar" dir="rtl" class="dark">
<head>
    @php
        $siteName = \App\Models\Setting::get('site_name', 'INZO STORE');
        $themeColor = \App\Models\Setting::get('theme_color', '#6366f1');

        $hex = str_replace("#", "", $themeColor);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $themeRGB = "$r, $g, $b";
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول | {{ $siteName }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Cairo', 'sans-serif'] },
                    colors: {
                        brand: { 500: '{{ $themeColor }}', 600: '{{ $themeColor }}dd', 700: '{{ $themeColor }}bb' },
                        base: { light: '#f1f5f9', dark: '#06060b', cardLight: '#ffffff', cardDark: '#111118' }
                    }
                }
            }
        }
    </script>
    <style>
        html { font-size: 18px; }
        body { font-family: 'Cairo', sans-serif; -webkit-font-smoothing: antialiased; }
        
        .login-card {
            background: rgba(255,255,255,0.95);
            border: 1px solid rgba(0,0,0,0.06);
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px -4px rgba(0,0,0,0.08);
            padding: 2.5rem !important;
        }
        .dark .login-card {
            background: rgba(17,17,24,0.9);
            border: 1px solid rgba(255,255,255,0.06);
            box-shadow: 0 16px 48px -8px rgba(0,0,0,0.6), inset 0 1px 0 rgba(255,255,255,0.04);
        }

        .login-input {
            width: 100%; height: 3.2rem; background: #f8fafc;
            border: 1.5px solid #e2e8f0; border-radius: 0.75rem;
            padding: 0 1.2rem; font-weight: 600; font-size: 0.95rem;
            transition: all 0.25s; outline: none; color: #0f172a;
        }
        .dark .login-input {
            background: rgba(0,0,0,0.3); border-color: rgba(255,255,255,0.08); color: white;
        }
        .login-input:focus {
            background: white; border-color: {{ $themeColor }};
            box-shadow: 0 0 0 3px rgba({{ $themeRGB }}, 0.15);
        }
        .dark .login-input:focus {
            background: rgba(0,0,0,0.5); border-color: {{ $themeColor }};
            box-shadow: 0 0 0 3px rgba({{ $themeRGB }}, 0.25);
        }

        .login-btn {
            height: 3.2rem; width: 100%; border-radius: 0.75rem; font-weight: 800; font-size: 1rem;
            display: flex; align-items: center; justify-content: center; gap: 0.6rem;
            background: linear-gradient(135deg, {{ $themeColor }}, {{ $themeColor }}cc);
            color: white; transition: all 0.3s; border: none; cursor: pointer;
            box-shadow: 0 6px 20px -3px rgba({{ $themeRGB }}, 0.45);
        }
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px -3px rgba({{ $themeRGB }}, 0.55);
            filter: brightness(1.08);
        }

        @keyframes subtle-drift {
            0% { transform: translate(0, 0); }
            50% { transform: translate(15px, -15px); }
            100% { transform: translate(0, 0); }
        }
        .animate-drift { animation: subtle-drift 15s infinite ease-in-out; }
    </style>
</head>
<body class="bg-base-light dark:bg-base-dark text-slate-900 dark:text-slate-100 min-h-screen flex items-center justify-center p-6 relative overflow-hidden transition-colors duration-500">
    
    <!-- Background Effects -->
    <div class="absolute top-[-10%] left-[-5%] w-[35rem] h-[35rem] rounded-[8rem] bg-brand-500/5 dark:bg-brand-500/10 filter blur-[80px] animate-drift"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-[30rem] h-[30rem] rounded-[8rem] bg-indigo-500/5 dark:bg-indigo-500/10 filter blur-[80px] animate-drift" style="animation-delay: -5s"></div>

    <div class="login-card w-full max-w-md relative z-10">
        
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-5 rounded-2xl bg-brand-500 text-white flex items-center justify-center shadow-lg shadow-brand-500/30">
                <i class="ph ph-fingerprint text-3xl"></i>
            </div>
            <h1 class="text-2xl font-black tracking-tight mb-1.5">الدخول للنظام</h1>
            <p class="text-xs text-slate-400 dark:text-slate-500 font-bold uppercase tracking-wider">{{ $siteName }} Workspace</p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 dark:bg-red-500/10 border border-red-100 dark:border-red-500/20 text-red-500 p-4 rounded-xl mb-6 flex items-center gap-3">
                <i class="ph ph-warning-circle text-xl"></i>
                <span class="text-sm font-bold">{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
            @csrf
            
            <div class="space-y-2">
                <label for="email" class="text-xs font-bold text-slate-500 dark:text-slate-400 px-1">البريد الإلكتروني</label>
                <div class="relative group">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus class="login-input !pr-11" placeholder="admin@store.com" dir="ltr">
                    <i class="ph ph-envelope-simple absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg group-focus-within:text-brand-500 transition-colors"></i>
                </div>
                @error('email') <span class="text-red-500 text-xs font-bold mt-1 block px-1">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-2">
                <label for="password" class="text-xs font-bold text-slate-500 dark:text-slate-400 px-1">كلمة المرور</label>
                <div class="relative group">
                    <input type="password" id="password" name="password" required class="login-input !pr-11" placeholder="••••••••" dir="ltr">
                    <i class="ph ph-lock-key absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg group-focus-within:text-brand-500 transition-colors"></i>
                </div>
                @error('password') <span class="text-red-500 text-xs font-bold mt-1 block px-1">{{ $message }}</span> @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="login-btn">
                    دخول لبيئة العمل <i class="ph ph-arrow-left text-lg"></i>
                </button>
            </div>
        </form>
    </div>

    <script>
        const savedTheme = localStorage.getItem('admin_theme') || 'dark';
        if (savedTheme === 'dark') { document.documentElement.classList.add('dark'); }
        else { document.documentElement.classList.remove('dark'); }
    </script>
</body>
</html>
