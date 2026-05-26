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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>لوحة التحكم | {{ $siteName }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Cairo', 'sans-serif'] },
                    colors: {
                        brand: { 
                            50: '#f5f7ff',
                            100: '#ebf0ff',
                            400: '{{ $themeColor }}cc',
                            500: '{{ $themeColor }}', 
                            600: '{{ $themeColor }}e6', 
                            700: '#4338ca', 
                            900: '#312e81' 
                        },
                        base: {
                            light: '#f4f7fe',
                            dark: '#07070a',
                            cardLight: '#ffffff',
                            cardDark: '#121217'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* =============================================
           PREMIUM ADMIN UI SYSTEM v2.0
        ============================================== */
        
        /* GLOBAL TYPOGRAPHY SCALE */
        html {
            font-size: 17px;
        }
        @media (min-width: 1024px) {
            html {
                font-size: 19px;
            }
        }

        body {
            font-family: 'Cairo', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Dynamic Backgrounds */
        body.dark {
            background-color: #06060b;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba({{ $themeRGB }}, 0.12) 0%, transparent 45%),
                radial-gradient(circle at 90% 80%, rgba(168, 85, 247, 0.08) 0%, transparent 45%);
            background-attachment: fixed;
        }
        body:not(.dark) {
            background-color: #f1f5f9;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba({{ $themeRGB }}, 0.06) 0%, transparent 45%),
                radial-gradient(circle at 90% 80%, rgba(168, 85, 247, 0.04) 0%, transparent 45%);
            background-attachment: fixed;
        }

        /* === GLASS CARDS === */
        .bento-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 1.25rem;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px -4px rgba(0,0,0,0.06), 0 0 0 1px rgba(255,255,255,0.8) inset;
            padding: 1.75rem !important;
        }
        .dark .bento-card {
            background: rgba(17, 17, 24, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.07);
            box-shadow: 0 8px 32px -8px rgba(0,0,0,0.6), inset 0 1px 0 rgba(255,255,255,0.06), 0 0 30px rgba({{ $themeRGB }}, 0.04);
        }
        .bento-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px -4px rgba({{ $themeRGB }}, 0.12), 0 0 0 1px rgba({{ $themeRGB }}, 0.15) inset;
            border-color: rgba({{ $themeRGB }}, 0.2);
        }
        .dark .bento-card:hover {
            border-color: rgba({{ $themeRGB }}, 0.3);
            box-shadow: 0 16px 40px -8px rgba({{ $themeRGB }}, 0.15), inset 0 1px 0 rgba(255,255,255,0.1);
        }

        /* === SIDEBAR NAV === */
        .bento-nav-item {
            display: flex;
            align-items: center;
            height: 3.2rem;
            padding: 0 1.25rem;
            border-radius: 0.85rem;
            margin-bottom: 0.25rem;
            color: #334155;
            font-weight: 700;
            font-size: 0.92rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border: 1.5px solid transparent;
            background: transparent;
        }
        .bento-nav-item i {
            font-size: 1.35rem;
            color: {{ $themeColor }};
            opacity: 0.85;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dark .bento-nav-item {
            color: rgba(255,255,255,0.75);
        }
        .dark .bento-nav-item i {
            color: {{ $themeColor }}cc;
            opacity: 0.8;
        }
        .bento-nav-item:hover {
            color: {{ $themeColor }};
            background: rgba({{ $themeRGB }}, 0.07);
            border-color: rgba({{ $themeRGB }}, 0.15);
            transform: translateX(-4px);
        }
        .bento-nav-item:hover i {
            opacity: 1;
            transform: scale(1.1);
        }
        .dark .bento-nav-item:hover {
            color: white;
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(255, 255, 255, 0.1);
        }
        .bento-nav-item.active {
            color: white;
            background: linear-gradient(135deg, {{ $themeColor }}, {{ $themeColor }}dd);
            border: 1.5px solid rgba(255,255,255,0.2);
            box-shadow: 0 8px 20px -4px rgba({{ $themeRGB }}, 0.45);
            transform: scale(1.01) translateX(-3px);
        }
        .bento-nav-item.active i {
            color: white !important;
            opacity: 1;
            filter: drop-shadow(0 1px 2px rgba(0,0,0,0.2));
        }

        /* === ICONS === */
        i[class*="ph"] {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), color 0.3s ease;
        }
        button:hover i[class*="ph"]:not(.no-anim),
        a:hover i[class*="ph"]:not(.no-anim),
        .group:hover i[class*="ph"]:not(.no-anim) {
            transform: scale(1.12);
        }

        /* Light mode text contrast fix */
        body:not(.dark) .text-slate-400 { color: #64748b; }
        body:not(.dark) .text-slate-500 { color: #475569; }
        body:not(.dark) .bento-card {
            box-shadow: 0 4px 16px -2px rgba(0,0,0,0.06), 0 1px 3px rgba(0,0,0,0.04);
            border: 1px solid rgba(0, 0, 0, 0.06);
        }

        /* === INPUTS === */
        .bento-input {
            width: 100%;
            height: 3.2rem;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0 1.15rem;
            font-weight: 600;
            font-size: 0.92rem;
            transition: all 0.25s;
            outline: none;
            color: #0f172a;
        }
        .dark .bento-input {
            background: rgba(0,0,0,0.3);
            border-color: rgba(255,255,255,0.1);
            color: white;
        }
        .bento-input:focus {
            background: white;
            border-color: {{ $themeColor }};
            box-shadow: 0 0 0 3px rgba({{ $themeRGB }}, 0.15);
        }
        .dark .bento-input:focus {
            background: rgba(0,0,0,0.5);
            border-color: {{ $themeColor }};
            box-shadow: 0 0 0 3px rgba({{ $themeRGB }}, 0.25);
        }

        /* === PAGINATION === */
        nav[role="navigation"] { display:flex; align-items:center; justify-content:space-between; }
        nav[role="navigation"] p { font-weight:700; font-size:0.85rem; color:#64748b; }
        .dark nav[role="navigation"] p { color:#94a3b8; }
        nav[role="navigation"] a,
        nav[role="navigation"] span[aria-current="page"],
        nav[role="navigation"] span[aria-disabled="true"] {
            background:rgba(255,255,255,0.8)!important; border:1px solid rgba(0,0,0,0.06)!important;
            color:#1e293b!important; font-weight:700!important; font-size:0.85rem!important;
            border-radius:0.6rem!important; margin:0 0.2rem!important; transition:all 0.25s!important;
        }
        .dark nav[role="navigation"] a,
        .dark nav[role="navigation"] span[aria-current="page"],
        .dark nav[role="navigation"] span[aria-disabled="true"] {
            background:rgba(255,255,255,0.05)!important; border-color:rgba(255,255,255,0.08)!important; color:white!important;
        }
        nav[role="navigation"] a:hover { background:{{ $themeColor }}!important; color:white!important; transform:translateY(-1px); border-color:transparent!important; }
        nav[role="navigation"] span[aria-current="page"] {
            background:linear-gradient(135deg, {{ $themeColor }}, {{ $themeColor }}dd)!important;
            color:white!important; border-color:transparent!important;
            box-shadow:0 4px 12px -2px rgba({{ $themeRGB }}, 0.4)!important;
        }

        /* === BUTTONS === */
        .bento-button {
            height: 3rem;
            padding: 0 1.75rem;
            border-radius: 0.75rem;
            font-weight: 800;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            background: linear-gradient(135deg, {{ $themeColor }}, {{ $themeColor }}cc);
            color: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 6px 16px -3px rgba({{ $themeRGB }}, 0.45), inset 0 1px 0 rgba(255,255,255,0.2);
            border: none;
            cursor: pointer;
            letter-spacing: 0.3px;
        }
        .bento-button:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 10px 24px -3px rgba({{ $themeRGB }}, 0.55), inset 0 1px 0 rgba(255,255,255,0.3);
            filter: brightness(1.08);
        }
        .bento-button:active {
            transform: translateY(1px) scale(0.99);
            box-shadow: 0 4px 10px -3px rgba({{ $themeRGB }}, 0.4);
        }

        /* === GLASS HEADER === */
        .bento-glass {
            background: rgba(241, 245, 249, 0.8);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-bottom: 1px solid rgba(0,0,0,0.04);
        }
        .dark .bento-glass {
            background: rgba(6, 6, 11, 0.8);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        /* === NOTIFICATION DROPDOWN === */
        .notif-dropdown { max-height: 28rem; overflow-y: auto; }
        .notif-dropdown::-webkit-scrollbar { width: 4px; }
        .notif-dropdown::-webkit-scrollbar-thumb { background: rgba({{ $themeRGB }}, 0.3); border-radius: 4px; }
        
        @keyframes notif-ping {
            0% { transform: scale(1); opacity: 1; }
            75% { transform: scale(1.8); opacity: 0; }
            100% { transform: scale(1.8); opacity: 0; }
        }
        .notif-ping { animation: notif-ping 1.5s cubic-bezier(0,0,0.2,1) infinite; }

        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="flex h-screen overflow-hidden bg-base-light dark:bg-base-dark text-slate-900 dark:text-slate-100 transition-colors duration-500">

    <!-- Floating Sidebar -->
    <aside class="w-80 hidden md:flex flex-col m-4 mr-6 rounded-[2rem] bg-white dark:bg-base-cardDark shadow-[0_10px_40px_rgba(0,0,0,0.08)] dark:shadow-[0_20px_40px_rgb(0,0,0,0.4)] border border-slate-200 dark:border-white/[0.05] z-30 transition-all">
        
        <div class="p-8 pb-4">
            <a href="{{ route('home') }}" class="flex items-center gap-4 group">
                <div class="w-12 h-12 rounded-[1rem] bg-brand-500 flex items-center justify-center shadow-lg shadow-brand-500/30 group-hover:scale-110 transition-transform">
                    @php $logoPath = \App\Models\Setting::get('logo_path', 'logo.svg'); @endphp
                    <img src="{{ asset($logoPath) }}" alt="Logo" class="w-7 h-7 object-contain brightness-0 invert">
                </div>
                <div>
                    <h2 class="text-xl font-black tracking-tight text-slate-900 dark:text-white leading-none">
                        {{ $siteName }}
                    </h2>
                    <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-1.5 uppercase tracking-[0.2em] font-black">Workspace</p>
                </div>
            </a>
        </div>

        <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-5 no-scrollbar">
            <!-- Group: Workspace -->
            <div>
                <p class="px-4 text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em] mb-3">مساحة العمل</p>
                <div class="space-y-1">
                    <a href="{{ route('home') }}" target="_blank" class="bento-nav-item text-brand-500 dark:text-brand-400 hover:text-brand-600 dark:hover:text-brand-300 font-bold transition-all">
                        <i class="ph ph-globe text-2xl ml-4"></i> زيارة المتجر
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="bento-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="ph ph-squares-four text-2xl ml-4"></i> نظرة عامة
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="bento-nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="ph ph-receipt text-2xl ml-4"></i> الطلبات الواردة
                    </a>
                </div>
            </div>

            <!-- Group: Resources -->
            <div>
                <p class="px-4 text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em] mb-3">الموارد الرقمية</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.products.index') }}" class="bento-nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="ph ph-cube text-2xl ml-4"></i> المنتجات
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="bento-nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="ph ph-folders text-2xl ml-4"></i> التصنيفات
                    </a>
                    <a href="{{ route('admin.subscription-keys.index') }}" class="bento-nav-item {{ request()->routeIs('admin.subscription-keys.*') ? 'active' : '' }}">
                        <i class="ph ph-key text-2xl ml-4"></i> مفاتيح التفعيل
                    </a>
                </div>
            </div>

            <!-- Group: Network -->
            <div>
                <p class="px-4 text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em] mb-3">الشبكة</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.users.index') }}" class="bento-nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="ph ph-users-three text-2xl ml-4"></i> قائمة العملاء
                    </a>
                    <a href="{{ route('admin.notifications.index') }}" class="bento-nav-item {{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}">
                        <i class="ph ph-bell-ringing text-2xl ml-4"></i> الإشعارات الحية
                    </a>
                    <a href="{{ route('admin.mail.index') }}" class="bento-nav-item {{ request()->routeIs('admin.mail.*') ? 'active' : '' }}">
                        <i class="ph ph-envelope-simple text-2xl ml-4"></i> البريد الرسمي
                    </a>
                </div>
            </div>

            <!-- Group: Control -->
            <div>
                <p class="px-4 text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em] mb-3">التحكم المركزي</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.banners.index') }}" class="bento-nav-item {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
                        <i class="ph ph-images text-2xl ml-4"></i> البنرات
                    </a>
                    <a href="{{ route('admin.guides.index') }}" class="bento-nav-item {{ request()->routeIs('admin.guides.*') ? 'active' : '' }}">
                        <i class="ph ph-book-open-text text-2xl ml-4"></i> الأدلة
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="bento-nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                        <i class="ph ph-chart-polar text-2xl ml-4"></i> التقارير
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="bento-nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <i class="ph ph-sliders text-2xl ml-4"></i> الإعدادات
                    </a>
                </div>
            </div>
        </nav>

        <!-- User Profile Footer -->
        <div class="p-5">
            <div class="bg-slate-50 dark:bg-white/[0.03] rounded-xl p-3.5 flex items-center justify-between border border-slate-100 dark:border-white/[0.04]">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 rounded-lg bg-white dark:bg-[#1a1a1f] flex items-center justify-center font-black text-sm text-slate-900 dark:text-white shadow-sm">
                        {{ substr(optional(auth('admin')->user())->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ optional(auth('admin')->user())->name }}</p>
                        <p class="text-xs text-slate-400 font-semibold mt-0.5">System Admin</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-9 h-9 rounded-lg bg-red-50 dark:bg-red-500/10 text-red-500 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all">
                        <i class="ph ph-power text-lg"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Workspace -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">

        <!-- Top Navigation -->
        <header class="bento-glass h-20 flex items-center justify-between px-6 z-20 sticky top-0">
            <div class="flex items-center gap-5">
                <button class="md:hidden w-10 h-10 rounded-xl bg-white dark:bg-base-cardDark shadow-sm flex items-center justify-center text-slate-900 dark:text-white">
                    <i class="ph ph-list text-xl"></i>
                </button>
                <div>
                    <h1 class="text-xl font-black text-slate-900 dark:text-white tracking-tight leading-none mb-1">@yield('title', 'الرئيسية')</h1>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">@yield('subtitle', 'نظرة عامة على النظام')</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                @yield('actions')
                
                <div class="w-px h-7 bg-slate-200 dark:bg-white/10 hidden sm:block mx-1"></div>
                
                <!-- Notification Bell -->
                <div class="relative" id="notifContainer">
                    <button id="notifBell" class="w-10 h-10 rounded-xl bg-white dark:bg-base-cardDark shadow-sm border border-slate-100 dark:border-white/[0.05] flex items-center justify-center text-slate-600 dark:text-slate-300 hover:scale-105 transition-transform relative">
                        <i class="ph ph-bell text-xl"></i>
                        <span id="notifBadge" class="hidden absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-[10px] font-black rounded-full flex items-center justify-center shadow-lg">
                            <span class="absolute inset-0 bg-red-500 rounded-full notif-ping"></span>
                            <span class="relative" id="notifCount">0</span>
                        </span>
                    </button>
                    <!-- Notification Dropdown -->
                    <div id="notifDropdown" class="hidden absolute left-0 top-[calc(100%+0.5rem)] w-96 bg-white dark:bg-[#111118] border border-slate-100 dark:border-white/[0.06] rounded-2xl shadow-2xl z-50 overflow-hidden">
                        <div class="px-5 py-4 border-b border-slate-100 dark:border-white/5 flex items-center justify-between">
                            <h4 class="text-sm font-black text-slate-900 dark:text-white flex items-center gap-2">
                                <i class="ph ph-bell-ringing text-lg text-brand-500"></i> الإشعارات
                            </h4>
                            <a href="{{ route('admin.notifications.index') }}" class="text-xs font-bold text-brand-500 hover:underline">عرض الكل</a>
                        </div>
                        <div class="notif-dropdown" id="notifList">
                            <div class="p-8 text-center text-slate-400 text-sm">جاري التحميل...</div>
                        </div>
                    </div>
                </div>
                
                <!-- Clear Cache Button -->
                <a href="{{ url('/clear-cache') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-500 hover:bg-amber-100 dark:hover:bg-amber-500/20 transition shadow-sm border border-amber-100 dark:border-amber-500/20" title="تنظيف الذاكرة المؤقتة (Cache)">
                    <i class="ph ph-arrows-clockwise text-lg"></i>
                    <span class="text-xs font-bold hidden sm:inline">تحديث</span>
                </a>

                <!-- Visit Store Button -->
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 px-3 py-2 rounded-xl bg-brand-500/10 text-brand-500 hover:bg-brand-500 hover:text-white transition shadow-sm border border-brand-500/20" title="زيارة الموقع">
                    <i class="ph ph-globe text-lg"></i>
                    <span class="text-xs font-bold hidden sm:inline">زيارة الموقع</span>
                </a>

                <!-- Dark Mode Toggle -->
                <button id="themeToggle" class="w-10 h-10 rounded-xl bg-white dark:bg-base-cardDark shadow-sm border border-slate-100 dark:border-white/[0.05] flex items-center justify-center text-slate-600 dark:text-slate-300 hover:scale-105 transition-transform">
                    <i class="ph ph-moon-stars text-xl dark:hidden"></i>
                    <i class="ph ph-sun text-xl hidden dark:block text-amber-400"></i>
                </button>
            </div>
        </header>

        <!-- Content Area -->
        <div class="flex-1 overflow-y-auto no-scrollbar pb-12">
            <div class="max-w-[1600px] mx-auto p-4 md:p-6">
                <div class="animate-in fade-in slide-in-from-bottom-8 duration-1000 ease-out">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    <script>
        // Intelligent Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;
        const savedTheme = localStorage.getItem('admin_theme') || 'dark'; // Default to Dark for Luxury feel
        
        if (savedTheme === 'dark') {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }

        themeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            localStorage.setItem('admin_theme', html.classList.contains('dark') ? 'dark' : 'light');
            
            // Add a small rotation animation to the icon
            const icon = themeToggle.querySelector('i:not(.hidden)');
            if(icon) {
                icon.style.transform = 'rotate(180deg)';
                setTimeout(() => icon.style.transform = 'none', 300);
            }
        });

        // Global SweetAlert2 Configuration for Bento UI
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: document.documentElement.classList.contains('dark') ? '#0f0f11' : '#ffffff',
            color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#000000',
            customClass: {
                popup: 'rounded-[1.5rem] shadow-2xl border border-slate-100 dark:border-white/5'
            }
        });

        @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        @endif

        @if(session('error'))
            Toast.fire({
                icon: 'error',
                title: "{{ session('error') }}"
            });
        @endif
    </script>
    @stack('scripts')
</body>
</html>