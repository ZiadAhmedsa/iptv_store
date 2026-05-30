@extends('layouts.app')

@php
    $themeColor = \App\Models\Setting::get('theme_color', '#6366f1');
    $siteName = \App\Models\Setting::get('site_name', 'World Cup 4K Store');
@endphp

@section('meta_title', $siteName . ' - أفضل اشتراك IPTV 4K لكأس العالم بدون تقطيع')
@section('meta_keywords', 'اشتراك iptv, سيرفر iptv 4k, بث مباشر كاس العالم, best iptv for world cup, افضل سيرفر iptv')

@section('content')
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
    /* Premium UI Enhancements */
    .swiper-pagination-progressbar { 
        background: rgba(255,255,255,0.1) !important; 
        height: 6px !important;
        bottom: 0 !important;
        top: auto !important;
    }
    .swiper-pagination-progressbar .swiper-pagination-progressbar-fill { 
        background: var(--theme-color) !important; 
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }
    .dark .glass-card {
        background: rgba(15, 23, 42, 0.65);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    .premium-glow {
        box-shadow: 0 0 60px -15px var(--theme-color);
    }
    .text-gradient {
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    /* Mobile Horizontal Scroll Utilities */
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    .mobile-scroll-container {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        padding-bottom: 1.5rem;
        gap: 1.5rem;
    }
    .mobile-scroll-item {
        flex: 0 0 85vw;
        scroll-snap-align: center;
    }
    @media(min-width: 640px) {
        .mobile-scroll-container { display: grid; overflow-x: visible; padding-bottom: 0; }
        .mobile-scroll-item { flex: auto; }
    }
    
    /* Bento Grid */
    .bento-grid {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        gap: 1.5rem;
        padding-bottom: 1.5rem;
    }
    .bento-item {
        flex: 0 0 85vw;
        scroll-snap-align: center;
    }
    @media(min-width: 768px) {
        .bento-grid { display: grid; grid-template-columns: repeat(2, 1fr); overflow-x: visible; padding-bottom: 0; }
        .bento-item { flex: auto; }
    }
    @media(min-width: 1024px) {
        .bento-grid {
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, 260px);
        }
        .bento-item:nth-child(1) { grid-column: span 2; grid-row: span 2; }
        .bento-item:nth-child(2) { grid-column: span 2; grid-row: span 1; }
        .bento-item:nth-child(3) { grid-column: span 1; grid-row: span 1; }
        .bento-item:nth-child(4) { grid-column: span 1; grid-row: span 1; }
    }
</style>

<div style="--theme-color: {{ $themeColor }}">

    <!-- ==============================================
                     1. HERO SECTION (ULTRA PREMIUM)
                     ============================================== -->
    <div class="relative pt-24 pb-12 lg:pt-32 lg:pb-20 overflow-hidden bg-slate-50 dark:bg-slate-950 transition-colors duration-500">
        <!-- Ambient Background Orbs -->
        <div class="absolute top-0 right-0 w-[40rem] h-[40rem] rounded-full blur-[120px] opacity-20 dark:opacity-30 pointer-events-none animate-pulse-glow" style="background: {{ $themeColor }}"></div>
        <div class="absolute bottom-0 left-[-10%] w-[30rem] h-[30rem] rounded-full blur-[100px] opacity-10 dark:opacity-20 pointer-events-none" style="background: {{ $themeColor }}; animation-delay: 2s;"></div>

        <div class="w-full max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-8 2xl:px-16 relative z-10">
            <div class="relative w-full h-[500px] md:h-[600px] lg:h-[800px] rounded-[2.5rem] lg:rounded-[4rem] overflow-hidden shadow-[0_30px_60px_rgba(0,0,0,0.05)] dark:shadow-[0_20px_80px_rgba(0,0,0,0.5)] border border-slate-200/50 dark:border-white/10 group">
                
                <div class="swiper bannerSwiper h-full w-full">
                    <div class="swiper-wrapper">
                        <!-- STATIC SLIDE 1: FOOTBALL -->
                        <div class="swiper-slide relative group">
                            <img src="https://images.unsplash.com/photo-1522778119026-d647f0596c20?q=80&w=2000&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[20s] group-hover:scale-105" alt="Football">
                            <div class="absolute inset-0 bg-gradient-to-r from-green-950/95 via-emerald-900/80 to-transparent z-10 mix-blend-multiply"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-transparent to-transparent z-10"></div>
                            <div class="absolute inset-0 bg-gradient-to-l from-slate-950/50 via-transparent to-transparent z-10"></div>

                            <div class="absolute inset-0 z-20 flex items-center px-6 md:px-16 lg:px-24">
                                <div class="max-w-4xl space-y-6 md:space-y-8 transform translate-y-8 opacity-0 transition-all duration-1000 slide-content">
                                    <div class="inline-flex items-center gap-3 px-6 py-2.5 rounded-full bg-black/30 backdrop-blur-md border border-yellow-500/30 text-yellow-400 text-xs md:text-sm font-black uppercase tracking-[0.2em] shadow-[0_0_30px_rgba(255,215,0,0.2)]">
                                        <i class="ph-fill ph-trophy text-yellow-400 animate-pulse text-lg"></i>
                                        تغطية حصرية للبطولات الكبرى
                                    </div>
                                    <h2 class="text-5xl md:text-7xl lg:text-8xl font-black text-white leading-[1.1] tracking-tighter drop-shadow-2xl">
                                        شاهد الان في بيتك <br>
                                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-amber-600">بدون تقطيع</span>
                                    </h2>
                                    <p class="text-lg md:text-xl lg:text-2xl text-slate-300 font-bold max-w-2xl leading-relaxed">
                                        استمتع بأقوى المباريات، والبطولات العالمية بجودة 4K حقيقية وكأنك في قلب الحدث.
                                    </p>
                                    <div class="pt-6">
                                        <a href="#subscriptions" class="inline-flex items-center gap-3 bg-gradient-to-r from-yellow-500 to-amber-600 text-slate-950 px-8 py-4 md:px-10 md:py-5 rounded-2xl font-black text-lg hover:scale-105 active:scale-95 transition-all shadow-[0_0_40px_rgba(245,158,11,0.4)]">
                                            اكتشف الباقات
                                            <i class="ph-bold ph-soccer-ball text-xl md:text-2xl"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- STATIC SLIDE 2: CINEMA & SERIES -->
                        <div class="swiper-slide relative group">
                            <img src="https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?q=80&w=2000&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[20s] group-hover:scale-105" alt="Cinema">
                            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-purple-900/80 to-transparent z-10 mix-blend-multiply"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-transparent to-transparent z-10"></div>
                            <div class="absolute inset-0 bg-gradient-to-l from-slate-950/50 via-transparent to-transparent z-10"></div>

                            <div class="absolute inset-0 z-20 flex items-center px-6 md:px-16 lg:px-24">
                                <div class="max-w-4xl space-y-6 md:space-y-8 transform translate-y-8 opacity-0 transition-all duration-1000 slide-content">
                                    <div class="inline-flex items-center gap-3 px-6 py-2.5 rounded-full bg-white/10 backdrop-blur-md border border-purple-500/30 text-purple-400 text-xs md:text-sm font-black uppercase tracking-[0.2em] shadow-[0_0_30px_rgba(168,85,247,0.2)]">
                                        <i class="ph-fill ph-film-strip text-purple-400 text-lg"></i>
                                        سينما لا تتوقف
                                    </div>
                                    <h2 class="text-5xl md:text-7xl lg:text-8xl font-black text-white leading-[1.1] tracking-tighter drop-shadow-2xl">
                                        أحدث <br>
                                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600">الأفلام والمسلسلات</span>
                                    </h2>
                                    <p class="text-lg md:text-xl lg:text-2xl text-slate-300 font-bold max-w-2xl leading-relaxed">
                                        مكتبة ضخمة تضم آلاف الأفلام والمسلسلات الحصرية والمترجمة. متعة المشاهدة لك ولعائلتك.
                                    </p>
                                    <div class="pt-6">
                                        <a href="#subscriptions" class="inline-flex items-center gap-3 bg-gradient-to-r from-purple-500 to-pink-600 text-white px-8 py-4 md:px-10 md:py-5 rounded-2xl font-black text-lg hover:scale-105 active:scale-95 transition-all shadow-[0_0_40px_rgba(168,85,247,0.4)]">
                                            اشترك الآن
                                            <i class="ph-bold ph-popcorn text-xl md:text-2xl"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Premium Navigation -->
                    <div class="absolute bottom-10 right-10 z-30 flex items-center gap-4" dir="ltr">
                        <div class="swiper-button-prev-custom w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-white cursor-pointer hover:bg-white hover:text-slate-900 transition-all duration-300 group shadow-[0_0_20px_rgba(0,0,0,0.5)]">
                            <i class="ph-bold ph-arrow-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
                        </div>
                        <div class="swiper-button-next-custom w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-white cursor-pointer hover:bg-white hover:text-slate-900 transition-all duration-300 group shadow-[0_0_20px_rgba(0,0,0,0.5)]">
                            <i class="ph-bold ph-arrow-right text-2xl group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </div>

                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==============================================
                     1.5 CUSTOM BANNERS (IF ANY)
                     ============================================== -->
    @if(isset($banners) && $banners->count() > 0)
        <div class="relative pb-12 lg:pb-20 bg-slate-50 dark:bg-slate-950 transition-colors duration-500">
            <div class="w-full max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-8 2xl:px-16 relative z-10">
                <div class="swiper customBannerSwiper w-full h-[300px] md:h-[400px] lg:h-[500px] rounded-[2rem] lg:rounded-[3rem] overflow-hidden shadow-[0_20px_60px_rgba(0,0,0,0.1)] dark:shadow-[0_20px_60px_rgba(0,0,0,0.5)] border border-slate-200/50 dark:border-white/10 group">
                    <div class="swiper-wrapper">
                        @foreach($banners as $banner)
                            <div class="swiper-slide relative">
                                <img src="{{ $banner->full_image_url }}" alt="{{ $banner->title }}" class="absolute inset-0 w-full h-full object-cover transform scale-105 transition-transform duration-[20s] group-hover:scale-110">
                                
                                <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-900/60 to-transparent z-10 mix-blend-multiply"></div>
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-transparent to-transparent z-10"></div>
                                <div class="absolute inset-0 bg-gradient-to-l from-slate-950/40 via-transparent to-transparent z-10"></div>
                                
                                <div class="absolute inset-0 z-20 flex items-center px-6 md:px-16 lg:px-24">
                                    <div class="max-w-4xl space-y-4 md:space-y-6 transition-all duration-1000 slide-content">
                                        @if($banner->subtitle)
                                            <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-xs md:text-sm font-black uppercase tracking-[0.2em] shadow-[0_0_20px_rgba(255,255,255,0.1)]">
                                                <span class="w-2 h-2 rounded-full animate-pulse" style="background: {{ $themeColor }}"></span>
                                                {{ $banner->subtitle }}
                                            </div>
                                        @endif
                                        
                                        <h2 class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-[1.1] tracking-tighter drop-shadow-2xl">
                                            {{ $banner->title }}
                                        </h2>
                                        
                                        @if($banner->description)
                                            <p class="text-base md:text-xl lg:text-2xl text-slate-300 font-bold max-w-2xl leading-relaxed">
                                                {{ $banner->description }}
                                            </p>
                                        @endif
                                        
                                        @if($banner->link_url)
                                            <div class="pt-6">
                                                <a href="{{ $banner->link_url }}" class="inline-flex items-center gap-3 bg-white text-slate-950 px-8 py-4 md:px-10 md:py-5 rounded-2xl font-black text-lg hover:scale-105 active:scale-95 transition-all shadow-[0_0_30px_rgba(255,255,255,0.2)]">
                                                    اكتشف المزيد
                                                    <i class="ph-bold ph-arrow-left text-xl md:text-2xl"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="absolute bottom-6 right-6 z-30 flex items-center gap-3" dir="ltr">
                        <div class="swiper-button-prev-custom-banner w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-white cursor-pointer hover:bg-white hover:text-slate-900 transition-all duration-300 shadow-[0_0_15px_rgba(0,0,0,0.3)]">
                            <i class="ph-bold ph-arrow-left text-xl"></i>
                        </div>
                        <div class="swiper-button-next-custom-banner w-12 h-12 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-white cursor-pointer hover:bg-white hover:text-slate-900 transition-all duration-300 shadow-[0_0_15px_rgba(0,0,0,0.3)]">
                            <i class="ph-bold ph-arrow-right text-xl"></i>
                        </div>
                    </div>

                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    @endif

    <!-- ==============================================
                     2. WHY CHOOSE US (BENTO GRID)
                     ============================================== -->
    <div class="relative py-16 lg:py-24 bg-white dark:bg-slate-900 transition-colors duration-500">
        <div class="w-full max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-8 2xl:px-16 relative z-10">
            <div class="text-center mb-16 space-y-4">
                <span class="inline-flex items-center gap-2 text-sm font-black uppercase tracking-[0.3em] opacity-80" style="color: {{ $themeColor }}">
                    <span class="w-8 h-0.5 rounded-full" style="background: {{ $themeColor }}"></span>
                    لماذا تختارنا
                    <span class="w-8 h-0.5 rounded-full" style="background: {{ $themeColor }}"></span>
                </span>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 dark:text-white tracking-tighter">
                    مميزات <span class="text-transparent bg-clip-text bg-gradient-to-l" style="background-image: linear-gradient(to left, {{ $themeColor }}, #a855f7)">استثنائية</span>
                </h2>
            </div>

            <div class="bento-grid hide-scrollbar">
                <!-- Main Feature -->
                <div class="bento-item glass-card rounded-[2.5rem] p-8 md:p-12 relative overflow-hidden group hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-64 h-64 rounded-full blur-[80px] opacity-10 group-hover:opacity-30 transition-opacity duration-700 pointer-events-none" style="background: {{ $themeColor }}"></div>
                    <div class="relative z-10 h-full flex flex-col justify-between">
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-white mb-8 shadow-lg transform group-hover:scale-110 group-hover:rotate-3 transition-transform duration-500" style="background: linear-gradient(135deg, {{ $themeColor }}, #6366f1)">
                            <i class="ph-bold ph-rocket-launch text-3xl"></i>
                        </div>
                        <div>
                            <h3 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-4 tracking-tight">سيرفرات فائقة السرعة والثبات</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-lg leading-relaxed font-medium">
                                نضمن لك مشاهدة مستقرة وبدون أي تقطيع بفضل سيرفراتنا القوية والموزعة حول العالم، لتعيش الحدث لحظة بلحظة دون أي تأخير.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Secondary Feature 1 -->
                <div class="bento-item glass-card rounded-[2.5rem] p-8 relative overflow-hidden group hover:shadow-xl transition-all duration-500 hover:-translate-y-2">
                    <div class="absolute inset-0 bg-gradient-to-br from-yellow-400/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center text-white mb-6 shadow-lg shadow-yellow-500/20 transform group-hover:scale-110 transition-transform">
                        <i class="ph-bold ph-television-simple text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 dark:text-white mb-3">جودة تصل إلى 4K</h3>
                    <p class="text-slate-500 dark:text-slate-400 leading-relaxed font-medium">
                        استمتع بأقوى البطولات والأفلام العالمية بأعلى جودة ممكنة.
                    </p>
                </div>

                <!-- Small Feature 1 -->
                <div class="bento-item glass-card rounded-[2.5rem] p-8 relative overflow-hidden group hover:shadow-xl transition-all duration-500 hover:-translate-y-2">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white mb-6 shadow-lg shadow-emerald-500/20 transform group-hover:scale-110 transition-transform">
                        <i class="ph-bold ph-devices text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white mb-2">يدعم جميع الأجهزة</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">شاشات، جوالات، وأجهزة الكمبيوتر.</p>
                </div>

                <!-- Small Feature 2 -->
                <div class="bento-item glass-card rounded-[2.5rem] p-8 relative overflow-hidden group hover:shadow-xl transition-all duration-500 hover:-translate-y-2">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center text-white mb-6 shadow-lg shadow-blue-500/20 transform group-hover:scale-110 transition-transform">
                        <i class="ph-bold ph-headset text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white mb-2">دعم فني متواصل</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">نحن معك على مدار الساعة.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ==============================================
                     3. BEST SELLING PRODUCTS
                     ============================================== -->
    @if(isset($bestSellingProducts) && $bestSellingProducts->count() > 0)
        <div class="relative py-16 lg:py-24 transition-colors duration-500">
            <div class="w-full max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-8 2xl:px-16 relative z-10">
                <div class="flex flex-col md:flex-row items-center justify-between mb-12 gap-6">
                    <div class="space-y-2 text-center md:text-right">
                        <h2 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tighter flex items-center justify-center md:justify-start gap-3">
                            <i class="ph-fill ph-fire text-orange-500 animate-pulse"></i>
                            الأكثر <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(to left, {{ $themeColor }}, #a855f7)">طلباً</span>
                        </h2>
                        <p class="text-slate-500 dark:text-slate-400 font-medium text-lg">اكتشف الباقات المفضلة لدى عملائنا</p>
                    </div>
                    <a href="#subscriptions" class="hidden md:inline-flex items-center gap-2 font-bold hover:opacity-80 transition-opacity px-6 py-3 rounded-2xl glass-card" style="color: {{ $themeColor }}">
                        تصفح جميع الباقات <i class="ph-bold ph-arrow-left"></i>
                    </a>
                </div>

                <div class="mobile-scroll-container hide-scrollbar sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                    @foreach($bestSellingProducts as $product)
                        <!-- Premium Product Card -->
                        <div onclick="window.location='{{ route('products.show', $product->id) }}'"
                            class="mobile-scroll-item relative bg-white dark:bg-slate-900 rounded-[2.5rem] p-5 transition-all duration-500 flex flex-col h-full shadow-lg hover:shadow-2xl hover:-translate-y-3 cursor-pointer z-10 group overflow-hidden border border-slate-100 dark:border-white/5">

                            @if($product->has_discount)
                                <div class="absolute top-4 left-4 z-20">
                                    <div class="bg-gradient-to-tr from-rose-500 to-red-500 rounded-2xl px-3 py-1.5 flex flex-col items-center justify-center shadow-lg shadow-red-500/30 transform -rotate-6 group-hover:rotate-0 transition-transform duration-500">
                                        <span class="text-[9px] font-black text-white/90 uppercase tracking-widest mb-0.5">توفير</span>
                                        <span class="text-base md:text-xl font-black text-white leading-none">{{ $product->discount_percentage }}%</span>
                                    </div>
                                </div>
                            @endif

                            <!-- Product Image -->
                            <div class="w-full aspect-[4/3] rounded-[2rem] overflow-hidden mb-6 relative flex items-center justify-center bg-slate-50 dark:bg-slate-950 transition-all duration-500 group-hover:shadow-inner">
                                @if($product->image_url)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name_ar }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                                @else
                                    <i class="ph-duotone ph-monitor-play text-6xl text-slate-300 dark:text-slate-600 transition-transform duration-700 group-hover:scale-105"></i>
                                @endif
                            </div>

                            <div class="flex-grow space-y-4 relative z-20 flex flex-col justify-between px-2">
                                <div class="text-center space-y-2">
                                    <h4 class="text-xl md:text-2xl font-black text-slate-900 dark:text-white tracking-tight line-clamp-1 transition-colors duration-500 group-hover:text-[var(--theme-color)]" style="--theme-color: {{ $themeColor }}">
                                        {{ $product->name_ar }}
                                    </h4>
                                    @if($product->description_ar)
                                        <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2 leading-relaxed font-medium">
                                            {{ Str::limit(strip_tags($product->description_ar), 80) }}
                                        </p>
                                    @endif
                                </div>

                                <div class="flex flex-col items-center justify-center gap-1 pt-4 pb-2 border-t border-slate-100 dark:border-white/5">
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-4xl font-black tracking-tighter" style="color: {{ $themeColor }}">
                                            {{ number_format($product->effective_price, 0) }}
                                        </span>
                                        <span class="text-xl font-black text-slate-400 dark:text-slate-500 mt-2">⃁</span>
                                    </div>
                                    @if($product->has_discount)
                                        <div class="flex items-center gap-1.5 opacity-60">
                                            <span class="text-sm font-bold text-slate-400 line-through decoration-slate-400/50">
                                                {{ number_format($product->price, 0) }}
                                            </span>
                                            <span class="text-xs font-bold text-slate-400">⃁</span>
                                        </div>
                                    @else
                                        <div class="h-5"></div>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-4 relative z-20">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('products.show', $product->id) }}" onclick="event.stopPropagation()"
                                        class="flex-grow py-3.5 px-4 rounded-2xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-800 dark:text-white font-black text-sm text-center transition-all duration-300">
                                        التفاصيل
                                    </a>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-shrink-0" onclick="event.stopPropagation()">
                                        @csrf
                                        <button type="submit"
                                            class="w-12 h-12 rounded-2xl text-white flex items-center justify-center shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 transition-all duration-300 group/btn"
                                            style="background: linear-gradient(135deg, {{ $themeColor }}, #6366f1); box-shadow: 0 10px 20px -5px {{ $themeColor }}80;"
                                            title="إضافة للسلة">
                                            <i class="ph-bold ph-shopping-cart-simple text-xl transition-transform duration-300 group-hover/btn:-translate-y-1"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- ==============================================
                     4. BROWSE BY CATEGORY (PILL DESIGN)
                     ============================================== -->
    <div class="relative py-16 lg:py-24 bg-white dark:bg-slate-900 transition-colors duration-500 overflow-hidden">
        <div class="w-full max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-8 2xl:px-16 relative z-10">
            <div class="text-center mb-12 space-y-4">
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 dark:text-white tracking-tighter">
                    استكشف <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(to right, {{ $themeColor }}, #a855f7)">فئات الاشتراكات</span>
                </h2>
                <p class="text-slate-500 dark:text-slate-400 font-medium text-lg">اختر القسم الذي يناسب احتياجاتك</p>
            </div>

            <div class="flex overflow-x-auto lg:flex-wrap lg:justify-center gap-4 md:gap-6 pb-6 lg:pb-0 scrollbar-hide snap-x snap-mandatory">
                @foreach($categoriesWithProducts as $category)
                    <a href="{{ route('categories.show', $category->slug) }}"
                        class="min-w-[200px] md:min-w-[240px] snap-center group block relative h-40 md:h-48 rounded-[3rem] overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-slate-200 dark:border-white/10 flex-grow max-w-sm">
                        
                        @if($category->image)
                            <img src="{{ $category->full_image_url }}" alt="{{ $category->name_ar }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                        @else
                            <div class="absolute inset-0 bg-slate-100 dark:bg-slate-800 transition-transform duration-1000 group-hover:scale-110"></div>
                        @endif
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-transparent opacity-80 group-hover:opacity-95 transition-opacity duration-500"></div>

                        <div class="absolute inset-0 p-6 md:p-8 flex flex-col justify-end">
                            <div class="flex items-end justify-between w-full">
                                <div>
                                    <h3 class="text-2xl md:text-3xl font-black text-white drop-shadow-md">
                                        {{ $category->name_ar }}
                                    </h3>
                                    <p class="text-sm text-slate-300 font-bold mt-1 opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-500">
                                        {{ $category->products->count() }} باقات متاحة
                                    </p>
                                </div>
                                <div class="w-12 h-12 rounded-full glass-card flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 transition-all duration-500">
                                    <i class="ph-bold ph-arrow-up-left text-xl"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- ==============================================
                     5. ALL CATEGORIES & PRODUCTS (VIP)
                     ============================================== -->
    <div id="subscriptions" class="relative py-16 lg:py-24 transition-colors duration-500">
        <div class="w-full max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-8 2xl:px-16 relative z-10">

            <div class="text-center mb-20 space-y-4 px-6">
                <span class="inline-flex items-center gap-2 text-sm font-black uppercase tracking-[0.3em] opacity-80" style="color: {{ $themeColor }}">
                    <span class="w-8 h-0.5 rounded-full" style="background: {{ $themeColor }}"></span>
                    باقات الاشتراك
                    <span class="w-8 h-0.5 rounded-full" style="background: {{ $themeColor }}"></span>
                </span>
                <h2 class="text-4xl md:text-6xl lg:text-7xl font-black text-slate-900 dark:text-white tracking-tighter">
                    اختر <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(to right, {{ $themeColor }}, #a855f7)">الباقة</span> المناسبة لك
                </h2>
            </div>

            @foreach($categoriesWithProducts as $category)
                @if($category->products->count() > 0)
                    <div class="mb-24 lg:mb-32" id="category-{{ $category->id }}">
                        
                        <div class="flex justify-center mb-12">
                            <div class="inline-flex items-center justify-center">
                                <h3 class="text-3xl lg:text-4xl font-black text-slate-900 dark:text-white tracking-tight">{{ $category->name_ar }}</h3>
                            </div>
                        </div>

                        <div class="mobile-scroll-container hide-scrollbar sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
                            @foreach($category->products as $index => $product)
                                @php
                                    $isVip = ($category->products->count() >= 3 && $index == 1) || $product->has_discount;
                                @endphp

                                <div onclick="window.location='{{ route('products.show', $product->id) }}'"
                                    class="mobile-scroll-item relative bg-white dark:bg-slate-900 rounded-[2.5rem] p-5 transition-all duration-500 flex flex-col h-full shadow-lg hover:shadow-2xl hover:-translate-y-3 cursor-pointer z-10 group overflow-hidden border {{ $isVip ? 'border-brand-500/50 dark:border-brand-500/40' : 'border-slate-100 dark:border-white/5' }}"
                                    style="{{ $isVip ? 'border-color: ' . $themeColor . '80;' : '' }}">

                                    @if($product->has_discount)
                                        <div class="absolute top-4 left-4 z-20">
                                            <div class="bg-gradient-to-tr from-rose-500 to-red-500 rounded-2xl px-3 py-1.5 flex flex-col items-center justify-center shadow-lg shadow-red-500/30 transform -rotate-6 group-hover:rotate-0 transition-transform duration-500">
                                                <span class="text-[9px] font-black text-white/90 uppercase tracking-widest mb-0.5">خصم</span>
                                                <span class="text-base md:text-xl font-black text-white leading-none">{{ $product->discount_percentage }}%</span>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="w-full aspect-[4/3] rounded-[2rem] overflow-hidden mb-6 relative flex items-center justify-center bg-slate-50 dark:bg-slate-950 transition-all duration-500 group-hover:shadow-inner border {{ $isVip ? 'border-brand-500/20' : 'border-transparent' }}">
                                        @if($product->image_url)
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name_ar }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                                        @else
                                            <i class="ph-duotone ph-monitor-play text-6xl text-slate-300 dark:text-slate-600 transition-transform duration-700 group-hover:scale-105"></i>
                                        @endif
                                    </div>

                                    <div class="flex-grow space-y-4 relative z-20 flex flex-col justify-between px-2">
                                        <div class="text-center space-y-2">
                                            <h4 class="text-xl md:text-2xl font-black text-slate-900 dark:text-white tracking-tight line-clamp-1 transition-colors duration-500 group-hover:text-[var(--theme-color)]" style="--theme-color: {{ $themeColor }}">
                                                {{ $product->name_ar }}
                                            </h4>
                                            @if($product->description_ar)
                                                <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2 leading-relaxed font-medium">
                                                    {{ Str::limit(strip_tags($product->description_ar), 80) }}
                                                </p>
                                            @endif
                                        </div>

                                        <div class="flex flex-col items-center justify-center gap-1 pt-4 pb-2 border-t border-slate-100 dark:border-white/5">
                                            <div class="flex items-center gap-1.5">
                                                <span class="text-4xl font-black tracking-tighter" style="color: {{ $themeColor }}">
                                                    {{ number_format($product->effective_price, 0) }}
                                                </span>
                                                <span class="text-xl font-black text-slate-400 dark:text-slate-500 mt-2">⃁</span>
                                            </div>
                                            @if($product->has_discount)
                                                <div class="flex items-center gap-1.5 opacity-60">
                                                    <span class="text-sm font-bold text-slate-400 line-through decoration-slate-400/50">
                                                        {{ number_format($product->price, 0) }}
                                                    </span>
                                                    <span class="text-xs font-bold text-slate-400">⃁</span>
                                                </div>
                                            @else
                                                <div class="h-5"></div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-4 relative z-20">
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('products.show', $product->id) }}" onclick="event.stopPropagation()"
                                                class="flex-grow py-3.5 px-4 rounded-2xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-800 dark:text-white font-black text-sm text-center transition-all duration-300">
                                                التفاصيل
                                            </a>
                                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-shrink-0" onclick="event.stopPropagation()">
                                                @csrf
                                                <button type="submit"
                                                    class="w-12 h-12 rounded-2xl text-white flex items-center justify-center shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 transition-all duration-300 group/btn"
                                                    style="{{ $isVip ? 'background: linear-gradient(135deg, ' . $themeColor . ', #6366f1); box-shadow: 0 10px 20px -5px ' . $themeColor . '80;' : 'background: #0f172a; box-shadow: 0 10px 20px -5px rgba(15,23,42,0.5);' }}"
                                                    title="إضافة للسلة">
                                                    <i class="ph-bold ph-shopping-cart-simple text-xl transition-transform duration-300 group-hover/btn:-translate-y-1"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- ==============================================
                     6. CONTACT CALL TO ACTION
                     ============================================== -->
    <div class="relative py-24 bg-white dark:bg-slate-900 transition-colors duration-500 overflow-hidden">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
            <div class="relative rounded-[3rem] overflow-hidden glass-card shadow-2xl p-12 lg:p-24 text-center transition-colors duration-500 group border border-slate-200 dark:border-white/10">
                
                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1600132806608-231446b2e7af?q=80&w=2000&auto=format&fit=crop')] bg-cover bg-center opacity-5 dark:opacity-10 mix-blend-luminosity transition-transform duration-[10s] group-hover:scale-110"></div>
                
                <!-- Glowing Orb -->
                <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full blur-[120px] opacity-20 dark:opacity-30 animate-pulse-glow pointer-events-none" style="background: {{ $themeColor }}"></div>
                <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full blur-[120px] opacity-20 dark:opacity-30 animate-pulse-glow pointer-events-none" style="background: {{ $themeColor }}; animation-delay: 2s;"></div>

                <div class="relative z-10 space-y-8">
                    <h2 class="text-5xl md:text-6xl lg:text-7xl font-black text-slate-900 dark:text-white tracking-tighter drop-shadow-lg">
                        جاهز لبدء <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(to right, {{ $themeColor }}, #a855f7)">المشاهدة؟</span>
                    </h2>
                    <p class="text-lg md:text-2xl text-slate-600 dark:text-slate-400 font-medium max-w-2xl mx-auto leading-relaxed">
                        فريق الدعم الفني لدينا متواجد على مدار اليوم لمساعدتك في اختيار الباقة المناسبة والبدء فوراً.
                    </p>
                    <div class="pt-8">
                        @php
                            $whatsappNumber = \App\Models\Setting::get('whatsapp', '');
                        @endphp
                        @if($whatsappNumber)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}" target="_blank"
                                class="inline-flex items-center justify-center gap-3 text-white px-10 py-5 rounded-full font-black text-xl hover:scale-105 active:scale-95 transition-all duration-300 shadow-[0_20px_40px_rgba(0,0,0,0.2)] hover:shadow-[0_25px_50px_rgba(0,0,0,0.4)]"
                                style="background: linear-gradient(135deg, {{ $themeColor }}, #6366f1)">
                                <i class="ph-bold ph-whatsapp-logo text-2xl"></i>
                                تواصل معنا الآن
                            </a>
                        @else
                            <a href="{{ route('contact') }}"
                                class="inline-flex items-center justify-center gap-3 text-white px-10 py-5 rounded-full font-black text-xl hover:scale-105 active:scale-95 transition-all duration-300 shadow-[0_20px_40px_rgba(0,0,0,0.2)] hover:shadow-[0_25px_50px_rgba(0,0,0,0.4)]"
                                style="background: linear-gradient(135deg, {{ $themeColor }}, #6366f1)">
                                <i class="ph-bold ph-envelope-simple text-2xl"></i>
                                اتصل بنا
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Safe Swiper initialization wrapper
        function initSwipers() {
            if(typeof Swiper === 'undefined') {
                console.error('Swiper JS not loaded!');
                return;
            }

            // Main Hero Swiper
            if(document.querySelector('.bannerSwiper')) {
                new Swiper('.bannerSwiper', {
                    loop: true,
                    effect: 'fade',
                    fadeEffect: { crossFade: true },
                    speed: 1500,
                    autoplay: {
                        delay: 6000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next-custom',
                        prevEl: '.swiper-button-prev-custom',
                    },
                    pagination: {
                        el: '.bannerSwiper .swiper-pagination',
                        type: 'progressbar',
                    },
                    on: {
                        slideChangeTransitionStart: function () {
                            const slides = document.querySelectorAll('.bannerSwiper .swiper-slide .slide-content');
                            slides.forEach(slide => {
                                slide.style.opacity = '0';
                                slide.style.transform = 'translateY(2rem)';
                            });
                        },
                        slideChangeTransitionEnd: function () {
                            const activeSlide = document.querySelector('.bannerSwiper .swiper-slide-active .slide-content');
                            if(activeSlide) {
                                activeSlide.style.opacity = '1';
                                activeSlide.style.transform = 'translateY(0)';
                            }
                        },
                        init: function () {
                            const slides = document.querySelectorAll('.bannerSwiper .swiper-slide .slide-content');
                            slides.forEach(slide => {
                                slide.style.opacity = '0';
                                slide.style.transform = 'translateY(2rem)';
                            });
                            setTimeout(() => {
                                const activeSlide = document.querySelector('.bannerSwiper .swiper-slide-active .slide-content');
                                if(activeSlide) {
                                    activeSlide.style.opacity = '1';
                                    activeSlide.style.transform = 'translateY(0)';
                                }
                            }, 100);
                        }
                    }
                });
            }

            // Custom Banners Swiper
            if(document.querySelector('.customBannerSwiper')) {
                new Swiper('.customBannerSwiper', {
                    loop: true,
                    speed: 1000,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next-custom-banner',
                        prevEl: '.swiper-button-prev-custom-banner',
                    },
                    pagination: {
                        el: '.customBannerSwiper .swiper-pagination',
                        clickable: true,
                    }
                });
            }
        }

        // Try initializing immediately
        initSwipers();
        
        // If Swiper isn't available yet, wait for the script to load
        if(typeof Swiper === 'undefined') {
            const swiperScript = document.querySelector('script[src*="swiper-bundle.min.js"]');
            if(swiperScript) {
                swiperScript.onload = initSwipers;
            }
        }
    });
</script>
@endpush