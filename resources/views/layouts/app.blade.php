<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    @php
        $siteName = \App\Models\Setting::get('site_name', 'World Cup 4K Store');
        $siteDescription = \App\Models\Setting::get('site_description', 'أفضل متجر اشتراكات IPTV 4K لمشاهدة كأس العالم والمباريات والأفلام بدون تقطيع. سيرفر ثابت يدعم جميع الأجهزة.');
        $siteKeywords = \App\Models\Setting::get('site_keywords', 'اشتراك iptv, سيرفر iptv 4k, بث مباشر كاس العالم, best iptv for world cup, افضل سيرفر iptv لمشاهدة كاس العالم بدون تقطيع, world cup iptv subscription, watch world cup 4k iptv, live sports iptv server, stable iptv for world cup, iptv world cup channels 4k, تجربة iptv مجانية لكاس العالم, افضل اشتراك iptv رخيص, مقارنة سيرفرات iptv, 4k iptv server, best 4k iptv, buy iptv 4k, iptv subscription 4k, premium iptv 4k, افضل اشتراك iptv بدون تقطيع, اشتراك iptv 4k لمشاهدة المباريات, سيرفر iptv مدفوع بجودة عالية, تجديد اشتراك iptv, قنوات 4k iptv بث مباشر, best 4k iptv provider for smart tv, stable 4k iptv subscription for live sports, 4k iptv free trial 24 hours, how to setup 4k iptv on firestick, 4k iptv for Android TV, iptv 4k for Apple TV, اشتراك iptv لشاشة سامسونج, سيرفر iptv لتطبيق تيفامي سمارترز');
        $themeColor = \App\Models\Setting::get('theme_color', '#6366f1');
        $logoPath = \App\Models\Setting::get('logo_path', 'logo.svg');

        if (!function_exists('hex_to_rgb')) {
            function hex_to_rgb($hex)
            {
                $hex = str_replace("#", "", $hex);
                if (strlen($hex) == 3) {
                    $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
                    $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
                    $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
                } else {
                    $r = hexdec(substr($hex, 0, 2));
                    $g = hexdec(substr($hex, 2, 2));
                    $b = hexdec(substr($hex, 4, 2));
                }
                return "$r, $g, $b";
            }
        }
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Dynamic Meta Tags -->
    <title>@yield('meta_title', $siteName . ' | أفضل اشتراك IPTV 4K لكأس العالم والمباريات بدون تقطيع')</title>
    <meta name="description" content="@yield('meta_description', $siteDescription)" />
    <meta name="keywords" content="@yield('meta_keywords', $siteKeywords)" />
    <meta name="author" content="{{ $siteName }}" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" sizes="192x192">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <meta name="theme-color" content="{{ $themeColor }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="@yield('meta_title', $siteName . ' | أفضل اشتراك IPTV 4K لكأس العالم')" />
    <meta property="og:description" content="@yield('meta_description', $siteDescription)" />
    <meta property="og:image" content="{{ asset('favicon.png') }}" />
    <meta property="og:site_name" content="{{ $siteName }}" />
    <meta property="og:locale" content="ar_AR" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('meta_title', $siteName . ' | أفضل اشتراك IPTV 4K لكأس العالم')" />
    <meta name="twitter:description" content="@yield('meta_description', $siteDescription)" />
    <meta name="twitter:image" content="{{ asset('favicon.png') }}" />

    <!-- Hreflang -->
    <link rel="alternate" hreflang="ar" href="{{ url()->current() }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Cairo', 'sans-serif'] },
                    colors: {
                        brand: { 50: '#eef2ff', 100: '#e0e7ff', 500: '{{ $themeColor }}', 600: '{{ $themeColor }}cc', 700: '#4338ca', 900: '#312e81' },
                        slate: { 850: '#151e2e', 900: '#0f172a', 950: '#020617' }
                    },
                    borderRadius: {
                        '4xl': '2rem',
                        '5xl': '2.5rem',
                        '6xl': '3rem',
                    }
                }
            }
        }
        // Theme init
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        function toggleTheme() {
            const html = document.documentElement;
            html.classList.toggle('dark');
            localStorage.theme = html.classList.contains('dark') ? 'dark' : 'light';
        }
    </script>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .dark .glass-nav {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        :root {
            --brand-color:
                {{ $themeColor }}
            ;
            --brand-glow: rgba({{ hex_to_rgb($themeColor) }}, 0.4);
        }

        .text-brand {
            color: var(--brand-color);
        }

        .bg-brand {
            background-color: var(--brand-color);
        }

        .border-brand {
            border-color: var(--brand-color);
        }

        .brand-gradient {
            background: linear-gradient(135deg, var(--brand-color), #4338ca);
            position: relative;
            overflow: hidden;
        }

        .brand-gradient::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
            transform: rotate(45deg);
            transition: all 0.5s ease;
        }

        .brand-gradient:hover::after {
            transform: rotate(45deg) translate(10%, 10%);
        }

        .brand-text {
            background: linear-gradient(135deg, #818cf8, var(--brand-color), #c084fc);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shine 5s linear infinite;
        }

        @keyframes shine {
            to {
                background-position: 200% center;
            }
        }

        .luxury-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .luxury-card:hover {
            border-color: var(--brand-color);
            box-shadow: 0 20px 40px -10px var(--brand-glow);
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes pulse-glow {

            0%,
            100% {
                opacity: 0.5;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.05);
            }
        }

        .animate-pulse-glow {
            animation: pulse-glow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>

<body
    class="antialiased min-h-screen flex flex-col bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100 transition-colors duration-300 selection:bg-brand-500 selection:text-white">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 transition-colors duration-300 glass-nav shadow-sm dark:shadow-none">
        <div class="w-full max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-12 2xl:px-24">
            <div class="flex items-center justify-between h-20">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <img src="{{ asset($logoPath) }}" alt="{{ $siteName }}"
                        class="h-10 md:h-12 w-auto object-contain brightness-100 dark:brightness-110">
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="flex items-center gap-1.5 text-slate-600 dark:text-slate-300 font-semibold hover:text-brand-500 transition">
                        <i class="ph ph-house text-xl"></i> الرئيسية
                    </a>
                    <a href="{{ route('categories.index') }}" class="flex items-center gap-1.5 text-slate-600 dark:text-slate-300 font-semibold hover:text-brand-500 transition">
                        <i class="ph ph-grid-four text-xl"></i> الفئات
                    </a>
                    <a href="{{ route('contact') }}" class="flex items-center gap-1.5 text-slate-600 dark:text-slate-300 font-semibold hover:text-brand-500 transition">
                        <i class="ph ph-chat-teardrop-text text-xl"></i> تواصل معنا
                    </a>
                    <a href="{{ route('how-to-run') }}" class="flex items-center gap-1.5 text-slate-600 dark:text-slate-300 font-semibold hover:text-brand-500 transition">
                        <i class="ph ph-book-open text-xl"></i> طريقة التشغيل
                    </a>
                    <a href="{{ route('free-subscriptions.index') }}" class="flex items-center gap-1.5 text-slate-600 dark:text-slate-300 font-semibold hover:text-brand-500 transition">
                        <i class="ph ph-gift text-xl"></i> اشتراك مجاني
                    </a>
                    <a href="{{ route('cart.index') }}" class="flex items-center gap-1.5 text-slate-600 dark:text-slate-300 font-semibold hover:text-brand-500 transition relative">
                        <i class="ph ph-shopping-cart text-xl"></i> السلة
                        @if(count(Cookie::get('inzo_cart') ? json_decode(Cookie::get('inzo_cart'), true) : []) > 0)
                            <span class="absolute -top-2 -right-3 brand-gradient text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow-md">
                                {{ count(json_decode(Cookie::get('inzo_cart'), true)) }}
                            </span>
                        @endif
                    </a>
                </div>

                <div class="flex items-center gap-3 md:gap-6">
                    <!-- Theme Toggle -->
                    <button onclick="toggleTheme()"
                        class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition flex items-center justify-center shadow-sm">
                        <i class="ph ph-sun hidden dark:block text-amber-400 text-xl"></i>
                        <i class="ph ph-moon block dark:hidden text-slate-600 text-xl"></i>
                    </button>

                    <!-- Auth Actions -->
                    <div class="hidden md:flex items-center gap-4">
                        @auth
                            <a href="{{ route('profile.index') }}" class="flex items-center gap-1.5 text-slate-600 dark:text-slate-300 font-semibold hover:text-brand-500 transition">
                                <i class="ph ph-user text-xl"></i> الملف الشخصي
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="flex items-center gap-1.5 text-slate-600 dark:text-slate-300 font-semibold hover:text-brand-500 transition">
                                    <i class="ph ph-sign-out text-xl"></i> خروج
                                </button>
                            </form>
                        @else
                            <a href="{{ route('register') }}"
                                class="flex items-center gap-1.5 brand-gradient text-white px-5 py-2.5 rounded-xl font-bold hover:shadow-lg hover:shadow-brand-500/30 transition transform hover:-translate-y-0.5">
                                <i class="ph ph-user-plus text-xl"></i> تسجيل
                            </a>
                        @endauth
                    </div>

                    <!-- Mobile Menu Toggle -->
                    <button id="mobile-menu-btn" class="lg:hidden p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300">
                        <i class="ph ph-list text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-200 dark:border-slate-800 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl">
            <div class="px-4 py-6 space-y-4">
                <a href="{{ route('home') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                    <i class="ph ph-house text-2xl text-brand-500"></i>
                    <span class="font-bold">الرئيسية</span>
                </a>
                <a href="{{ route('categories.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                    <i class="ph ph-grid-four text-2xl text-brand-500"></i>
                    <span class="font-bold">الفئات</span>
                </a>
                <a href="{{ route('contact') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                    <i class="ph ph-chat-teardrop-text text-2xl text-brand-500"></i>
                    <span class="font-bold">تواصل معنا</span>
                </a>
                <a href="{{ route('how-to-run') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                    <i class="ph ph-book-open text-2xl text-brand-500"></i>
                    <span class="font-bold">طريقة التشغيل</span>
                </a>
                <a href="{{ route('free-subscriptions.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                    <i class="ph ph-gift text-2xl text-brand-500"></i>
                    <span class="font-bold">اشتراك مجاني</span>
                </a>
                <a href="{{ route('cart.index') }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                    <div class="flex items-center gap-3">
                        <i class="ph ph-shopping-cart text-2xl text-brand-500"></i>
                        <span class="font-bold">السلة</span>
                    </div>
                    @if(count(Cookie::get('inzo_cart') ? json_decode(Cookie::get('inzo_cart'), true) : []) > 0)
                        <span class="brand-gradient text-white text-xs font-bold px-2 py-0.5 rounded-full">
                            {{ count(json_decode(Cookie::get('inzo_cart'), true)) }}
                        </span>
                    @endif
                </a>
                <hr class="border-slate-200 dark:border-slate-800">
                @auth
                    <a href="{{ route('profile.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                        <i class="ph ph-user text-2xl text-brand-500"></i>
                        <span class="font-bold">الملف الشخصي</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition text-red-500">
                            <i class="ph ph-sign-out text-2xl"></i>
                            <span class="font-bold">تسجيل الخروج</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="flex items-center justify-center gap-2 brand-gradient text-white p-4 rounded-2xl font-black shadow-lg shadow-brand-500/20">
                        <i class="ph ph-user-plus text-2xl"></i>
                        إنشاء حساب جديد
                    </a>
                    <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 p-4 rounded-2xl font-black border-2 border-brand-500 text-brand-500 mt-2">
                        <i class="ph ph-sign-in text-2xl"></i>
                        تسجيل الدخول
                    </a>
                @endauth
            </div>
        </div>
        <script>
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                const icon = mobileMenuBtn.querySelector('i');
                if (mobileMenu.classList.contains('hidden')) {
                    icon.classList.replace('ph-x', 'ph-list');
                } else {
                    icon.classList.replace('ph-list', 'ph-x');
                }
            });
        </script>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @if(session('success'))
            <div class="w-full max-w-[1920px] mx-auto mt-6 px-4 sm:px-6 lg:px-12 2xl:px-24">
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 dark:bg-emerald-900/20 dark:border-emerald-500/30 dark:text-emerald-400 px-6 py-4 rounded-2xl relative flex items-center font-semibold shadow-sm">
                    <i class="ph ph-check-circle text-2xl ml-3"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="w-full max-w-[1920px] mx-auto mt-6 px-4 sm:px-6 lg:px-12 2xl:px-24">
                <div class="bg-red-50 border border-red-200 text-red-700 dark:bg-red-900/20 dark:border-red-500/30 dark:text-red-400 px-6 py-4 rounded-2xl relative flex items-center font-semibold shadow-sm">
                    <i class="ph ph-warning-circle text-2xl ml-3"></i>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-16 py-12 border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 transition-colors duration-300">
        <div class="w-full max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-12 2xl:px-24 text-center">
            <div class="mb-6">
                <img src="{{ asset($logoPath) }}" alt="{{ $siteName }}" class="h-12 mx-auto object-contain brightness-100 dark:brightness-110 opacity-80">
            </div>
            <p class="text-slate-500 dark:text-slate-400 font-medium mb-2">&copy; {{ date('Y') }} {{ $siteName }}. جميع الحقوق محفوظة.</p>
            @php
                $developerInfo = \App\Models\Setting::get('developer_info', '');
                $developerLink = \App\Models\Setting::get('developer_link', '');
            @endphp
            @if($developerInfo)
                <div class="mt-4 flex items-center justify-center gap-2 text-sm font-bold text-slate-400 dark:text-slate-500">
                    <span>تم التطوير بواسطة:</span>
                    @if($developerLink)
                        <a href="{{ $developerLink }}" target="_blank" class="brand-text hover:opacity-80 flex items-center gap-1.5 transition-colors bg-brand-500/10 px-4 py-1.5 rounded-full border border-brand-500/20 shadow-sm hover:shadow-brand-500/20">
                            <i class="ph-bold ph-terminal-window text-lg"></i>
                            {{ $developerInfo }}
                        </a>
                    @else
                        <span class="text-brand-500 flex items-center gap-1.5 font-black">
                            <i class="ph-bold ph-terminal-window text-lg"></i>
                            {{ $developerInfo }}
                        </span>
                    @endif
                </div>
            @endif
        </div>
    </footer>

    @php
        $whatsappNumber = \App\Models\Setting::get('whatsapp', '');
    @endphp
    @if($whatsappNumber)
        <!-- Floating WhatsApp Button -->
        <div class="fixed bottom-8 right-8 z-[9999] flex flex-col items-center gap-2 group animate-float">
            <div class="absolute inset-0 bg-[#25D366] rounded-full blur-xl opacity-40 group-hover:opacity-70 animate-pulse transition-opacity duration-300"></div>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}" target="_blank"
                class="relative bg-gradient-to-tr from-[#128C7E] to-[#25D366] text-white w-14 h-14 md:w-16 md:h-16 rounded-full flex items-center justify-center shadow-[0_10px_30_rgba(37,211,102,0.4)] hover:shadow-[0_15px_40_rgba(37,211,102,0.6)] transform hover:scale-110 transition-all duration-300 border-[3px] border-white/20 dark:border-white/10">
                <i class="ph-fill ph-whatsapp-logo text-3xl md:text-4xl drop-shadow-md"></i>
            </a>
            <div class="absolute right-full top-1/2 -translate-y-1/2 mr-4 px-4 py-2.5 bg-white dark:bg-slate-800 text-slate-800 dark:text-white text-sm font-black rounded-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 shadow-xl shadow-slate-200/50 dark:shadow-black/50 whitespace-nowrap border border-slate-100 dark:border-white/10 translate-x-4 group-hover:translate-x-0">
                تواصل معنا الآن 💬
                <div class="absolute top-1/2 -right-1.5 -translate-y-1/2 w-3 h-3 bg-white dark:bg-slate-800 transform rotate-45 border-t border-r border-slate-100 dark:border-white/10"></div>
            </div>
        </div>
    @endif

    <!-- Loyalty Rewards Widget (Temporarily Hidden)
    <div x-data="{ loyaltyOpen: false }" class="fixed bottom-8 left-8 z-[9999] flex flex-col items-center gap-2 group animate-float">
        <button @click="loyaltyOpen = true" 
            class="relative bg-gradient-to-tr from-brand-600 to-brand-400 text-white w-14 h-14 md:w-16 md:h-16 rounded-full flex items-center justify-center shadow-[0_10px_30px_rgba(99,102,241,0.4)] hover:shadow-[0_15px_40px_rgba(99,102,241,0.6)] transform hover:scale-110 transition-all duration-300 border-[3px] border-white/20 dark:border-white/10 group">
            <i class="ph-fill ph-gift text-3xl md:text-4xl drop-shadow-md group-hover:rotate-12 transition-transform"></i>
            <span class="absolute inset-0 rounded-full brand-gradient animate-ping opacity-20"></span>
        </button>

        <div class="absolute left-full top-1/2 -translate-y-1/2 ml-4 px-4 py-2.5 bg-white dark:bg-slate-800 text-slate-800 dark:text-white text-sm font-black rounded-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 shadow-xl shadow-slate-200/50 dark:shadow-black/50 whitespace-nowrap border border-slate-100 dark:border-white/10 -translate-x-4 group-hover:translate-x-0">
            برنامج الولاء والمكافآت 🎁
            <div class="absolute top-1/2 -left-1.5 -translate-y-1/2 w-3 h-3 bg-white dark:bg-slate-800 transform rotate-45 border-b border-l border-slate-100 dark:border-white/10"></div>
        </div>

        <template x-teleport="body">
            <div x-show="loyaltyOpen" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-[10000] flex items-center justify-center p-4 sm:p-6 bg-slate-900/60 backdrop-blur-md">
                
                <div @click.away="loyaltyOpen = false"
                     x-show="loyaltyOpen"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-8"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     class="relative w-full max-w-lg bg-white dark:bg-slate-900 rounded-[3rem] overflow-hidden shadow-2xl border border-slate-100 dark:border-white/5">
                    
                    <div class="relative h-40 flex items-center justify-center overflow-hidden">
                        <div class="absolute inset-0 brand-gradient opacity-95"></div>
                        <button @click="loyaltyOpen = false" class="absolute top-6 right-6 w-10 h-10 rounded-full bg-black/20 hover:bg-black/40 text-white flex items-center justify-center transition-all z-30">
                            <i class="ph ph-x text-xl font-bold"></i>
                        </button>
                        <div class="relative z-10 text-center text-white">
                            <i class="ph-fill ph-gift text-5xl text-yellow-400 mb-2 drop-shadow-lg"></i>
                            <h3 class="text-2xl font-black">برنامج الولاء والمكافآت</h3>
                            <p class="text-white/80 font-bold text-xs">أهلاً بك في عالم المكافآت الحصرية</p>
                        </div>
                    </div>

                    <div class="p-6 md:p-8 space-y-6" x-data="{ tab: 'earn' }">
                        <div class="flex p-1 bg-slate-100 dark:bg-slate-800 rounded-2xl gap-1">
                            <button @click="tab = 'earn'" 
                                    :class="tab === 'earn' ? 'bg-white dark:bg-slate-700 text-brand-500 shadow-sm' : 'text-slate-500'"
                                    class="flex-1 py-3 rounded-xl font-black text-xs transition-all flex items-center justify-center gap-2">
                                <i class="ph-bold ph-plus-circle"></i> طرق كسب النقاط
                            </button>
                            <button @click="tab = 'redeem'" 
                                    :class="tab === 'redeem' ? 'bg-white dark:bg-slate-700 text-brand-500 shadow-sm' : 'text-slate-500'"
                                    class="flex-1 py-3 rounded-xl font-black text-xs transition-all flex items-center justify-center gap-2">
                                <i class="ph-bold ph-ticket"></i> طرق استبدال النقاط
                            </button>
                        </div>

                        <div class="min-h-[200px]">
                            <div x-show="tab === 'earn'" class="space-y-4">
                                @php
                                    $earnMethods = explode("\n", \App\Models\Setting::get('loyalty_earn_methods', "اشترك في المتجر واحصل على 50 نقطة فورية\nاطلب أي باقة واحصل على نقطة مقابل كل ريال\nقيم المنتجات التي اشتريتها واحصل على 10 نقاط"));
                                @endphp
                                @foreach($earnMethods as $method)
                                    @if(trim($method))
                                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5">
                                        <div class="w-10 h-10 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center text-lg">
                                            <i class="ph-bold ph-coins"></i>
                                        </div>
                                        <p class="font-bold text-sm text-slate-700 dark:text-slate-300">{{ $method }}</p>
                                    </div>
                                    @endif
                                @endforeach
                            </div>

                            <div x-show="tab === 'redeem'" class="space-y-4">
                                @php
                                    $redeemMethods = explode("\n", \App\Models\Setting::get('loyalty_redeem_methods', "استبدل 500 نقطة بخصم 10% على طلبك\nاستبدل 1000 نقطة بشهر مجاني VIP\nاستبدل نقاطك بكوبونات هدايا"));
                                @endphp
                                @foreach($redeemMethods as $method)
                                    @if(trim($method))
                                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-500/5 border border-emerald-100 dark:border-emerald-500/10">
                                        <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center text-lg">
                                            <i class="ph-bold ph-gift"></i>
                                        </div>
                                        <p class="font-bold text-sm text-slate-700 dark:text-slate-300">{{ $method }}</p>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-100 dark:border-white/5">
                            <a href="{{ route('register') }}" class="w-full brand-gradient text-white py-4 rounded-2xl font-black text-center block shadow-lg shadow-brand-500/20 hover:scale-[1.02] active:scale-95 transition-all">
                                انضم للبرنامج الآن مجاناً
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
    -->
    
    @stack('scripts')
</body>

</html>