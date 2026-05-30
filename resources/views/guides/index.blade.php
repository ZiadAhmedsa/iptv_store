@extends('layouts.app')

@php
    $siteName = \App\Models\Setting::get('site_name', 'World Cup 4K Store');
@endphp

@section('meta_title', 'طريقة تشغيل IPTV على جميع الأجهزة | ' . $siteName)
@section('meta_keywords', 'how to setup 4k iptv on firestick, iptv لتطبيق تيفامي سمارترز, 4k iptv for Android TV, iptv 4k for Apple TV')

@section('content')
<div class="w-full max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-12 2xl:px-24 py-20 relative">
    <!-- Header Section -->
    <div class="text-center mb-16 relative z-10">
        <div class="inline-flex items-center gap-3 px-5 py-2 rounded-2xl bg-brand-500/10 text-brand-500 font-black text-xs mb-6 uppercase tracking-widest border border-brand-500/20">
            <i class="ph ph-info text-lg"></i> مركز المساعدة
        </div>
        <h2 class="text-5xl md:text-6xl font-black text-slate-900 dark:text-white tracking-tighter">طريقة <span class="brand-text">تشغيل الاشتراك</span></h2>
        <p class="text-slate-500 dark:text-slate-400 mt-6 text-xl max-w-2xl mx-auto leading-relaxed">اكتشف كيفية تشغيل اشتراكك على كافة أجهزتك الذكية بخطوات سهلة ومبسطة.</p>
    </div>

    <!-- Main Content with Filters -->
    <div class="relative z-10" x-data="{ 
        activeCategory: 'all', 
        searchQuery: '' 
    }">
        @if($guides->isEmpty())
            <div class="text-center py-20 bg-white/50 dark:bg-slate-900/50 rounded-[3rem] border border-slate-200 dark:border-white/5 backdrop-blur-xl">
                <i class="ph ph-notebook text-8xl text-slate-300 dark:text-slate-700 mb-6"></i>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">قريباً.. شروحات التشغيل</h3>
                <p class="text-slate-500">نحن نعمل على إضافة شروحات لكافة الأجهزة.</p>
            </div>
        @else
            <!-- Search & Category Filters -->
            <div class="max-w-3xl mx-auto mb-16 space-y-8">
                <!-- Search Bar -->
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-brand-500 to-indigo-500 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative">
                        <input type="text" x-model="searchQuery" placeholder="ابحث باسم الجهاز أو التطبيق..." class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/10 rounded-2xl px-6 py-4 text-lg font-bold shadow-xl focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all text-slate-900 dark:text-white placeholder:text-slate-400 text-right pr-6 pl-14">
                        <i class="ph ph-magnifying-glass absolute left-6 top-1/2 -translate-y-1/2 text-2xl text-brand-500"></i>
                    </div>
                </div>

                <!-- Category Pills -->
                <div class="flex overflow-x-auto lg:flex-wrap justify-start lg:justify-center gap-3 pb-4 lg:pb-0 scrollbar-hide snap-x">
                    <button @click="activeCategory = 'all'" 
                        :class="activeCategory === 'all' ? 'brand-gradient text-white shadow-lg shadow-brand-500/30 scale-105' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700'" 
                        class="min-w-max px-6 py-2.5 rounded-xl font-bold text-sm transition-all border border-slate-200 dark:border-white/5 snap-center">
                        <i class="ph ph-squares-four ml-1"></i> الكل
                    </button>
                    @if(isset($categories))
                        @foreach($categories as $category)
                            <button @click="activeCategory = '{{ $category }}'" 
                                :class="activeCategory === '{{ $category }}' ? 'brand-gradient text-white shadow-lg shadow-brand-500/30 scale-105' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700'" 
                                class="min-w-max px-6 py-2.5 rounded-xl font-bold text-sm transition-all border border-slate-200 dark:border-white/5 snap-center">
                                {{ $category }}
                            </button>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Guides List -->
            <div class="space-y-16">
                @foreach($guides as $guide)
                    <div 
                        x-show="(activeCategory === 'all' || activeCategory === '{{ $guide->category ?? '' }}') && ('{{ strtolower($guide->title) }}'.includes(searchQuery.toLowerCase()))"
                        x-transition:enter="transition ease-out duration-500 delay-100"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-3xl rounded-[3.5rem] border border-slate-200 dark:border-white/5 p-12 shadow-2xl relative overflow-hidden"
                    >
                        <!-- Guide Metadata & Instructions -->
                        <div class="grid grid-cols-1 lg:grid-cols-[1fr_350px] gap-12 relative z-10">
                            <!-- Left Side: Instructions & Steps -->
                            <div class="space-y-16">
                                <!-- Instructions Area -->
                                <div class="relative">
                                    <div class="flex items-center gap-4 mb-8">
                                        <div class="w-2 h-10 brand-gradient rounded-full"></div>
                                        <h4 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">تعليمات الإعداد التقني</h4>
                                    </div>
                                    <div class="prose prose-slate dark:prose-invert max-w-none prose-p:text-lg prose-p:leading-relaxed prose-strong:text-brand-500 bg-slate-50 dark:bg-white/[0.02] p-10 rounded-[2.5rem] border border-slate-100 dark:border-white/5 shadow-inner">
                                        {!! $guide->content !!}
                                    </div>
                                </div>

                                <!-- Steps Timeline -->
                                @if($guide->steps->count() > 0)
                                    <div class="space-y-12">
                                        <div class="flex items-center gap-4 mb-10">
                                            <div class="w-2 h-10 bg-emerald-500 rounded-full"></div>
                                            <h4 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">خطوات التشغيل المصورة</h4>
                                        </div>
                                        
                                        <div class="space-y-24 relative before:absolute before:right-8 before:top-0 before:bottom-0 before:w-px before:bg-slate-200 dark:before:bg-white/10 before:hidden md:before:block">
                                            @foreach($guide->steps as $index => $step)
                                                <div class="relative flex flex-col md:flex-row gap-12 group">
                                                    <!-- Step Number Indicator -->
                                                    <div class="hidden md:flex absolute right-0 top-0 -translate-x-1/2 w-16 h-16 rounded-full bg-white dark:bg-slate-900 border-4 border-slate-50 dark:border-slate-800 items-center justify-center z-20 shadow-xl transition-transform group-hover:scale-110">
                                                        <span class="text-2xl font-black text-brand-500">{{ $index + 1 }}</span>
                                                    </div>

                                                    <!-- Image Card -->
                                                    @if($step->image_path)
                                                        <div class="w-full md:w-3/5 rounded-[3rem] overflow-hidden shadow-2xl border border-slate-200 dark:border-white/5 relative group/img cursor-zoom-in">
                                                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover/img:opacity-100 transition-opacity z-10 flex items-center justify-center">
                                                                <i class="ph ph-magnifying-glass-plus text-white text-4xl"></i>
                                                            </div>
                                                            <img src="{{ $step->image_path }}" class="w-full h-auto transition-transform duration-1000 group-hover/img:scale-110" alt="Step {{ $index + 1 }}">
                                                        </div>
                                                    @endif

                                                    <!-- Description Card -->
                                                    <div class="flex-1 space-y-4 pt-4">
                                                        <div class="md:hidden flex items-center gap-3 mb-4">
                                                            <span class="w-10 h-10 rounded-full brand-gradient text-white flex items-center justify-center font-black">{{ $index + 1 }}</span>
                                                            <span class="text-slate-400 font-black uppercase text-xs tracking-widest">الخطوة القادمة</span>
                                                        </div>
                                                        <p class="text-xl font-bold text-slate-700 dark:text-slate-300 leading-relaxed text-right">
                                                            {{ $step->description }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Right Side: Device Specs -->
                            <div class="space-y-8">
                                <div class="modern-card p-10 rounded-[2.5rem] border border-slate-200 dark:border-white/5 bg-white/50 dark:bg-white/[0.02] backdrop-blur-xl sticky top-32">
                                    <div class="text-center mb-10">
                                        <div class="w-24 h-24 rounded-[2rem] brand-gradient text-white flex items-center justify-center text-5xl mx-auto shadow-2xl shadow-brand-500/20 mb-6">
                                            <i class="ph {{ $guide->icon }}"></i>
                                        </div>
                                        <h3 class="text-3xl font-black text-slate-900 dark:text-white leading-tight">{{ $guide->title }}</h3>
                                        <p class="text-slate-500 font-bold mt-2 uppercase tracking-widest text-[10px]">مواصفات التشغيل</p>
                                    </div>

                                    <div class="space-y-6 pt-6 border-t border-slate-100 dark:border-white/5">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-black text-slate-400 uppercase tracking-widest">اسم الجهاز</span>
                                            <span class="text-sm font-black text-slate-900 dark:text-white">{{ $guide->title }}</span>
                                        </div>
                                        @if($guide->category)
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-black text-slate-400 uppercase tracking-widest">الفئة</span>
                                            <span class="text-sm font-bold text-brand-500">{{ $guide->category }}</span>
                                        </div>
                                        @endif
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-black text-slate-400 uppercase tracking-widest">التوافق</span>
                                            <span class="px-3 py-1 rounded-lg bg-emerald-500/10 text-emerald-500 text-[10px] font-black uppercase">تم التحقق</span>
                                        </div>
                                    </div>

                                    <div class="mt-10 p-6 bg-brand-500/5 rounded-3xl border border-brand-500/10">
                                        <p class="text-xs text-slate-500 font-bold leading-relaxed text-center">
                                            تأكد من تحديث تطبيق التشغيل لآخر إصدار لضمان أفضل أداء للبث.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- CTA Section -->
    <div class="mt-24 p-12 bg-brand-500 rounded-[3rem] text-center text-white shadow-2xl shadow-brand-500/40 relative overflow-hidden group">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-brand-500 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
        <div class="relative z-10">
            <h3 class="text-3xl font-black mb-4">هل واجهت مشكلة في التشغيل؟</h3>
            <p class="text-brand-100 mb-10 text-lg opacity-90">دعمنا الفني متاح على مدار الساعة لمساعدتك في إعداد اشتراكك.</p>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-3 bg-white text-brand-600 px-10 py-4 rounded-2xl font-black text-lg hover:shadow-xl transition transform hover:-translate-y-1">
                تواصل مع الدعم الفني <i class="ph ph-whatsapp-logo text-2xl"></i>
            </a>
        </div>
    </div>
</div>

<!-- Alpine.js requirement -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
