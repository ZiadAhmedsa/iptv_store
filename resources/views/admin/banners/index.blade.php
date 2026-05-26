@extends('layouts.admin')

@php
    $themeColor = \App\Models\Setting::get('theme_color', '#6366f1');
@endphp


@section('title', 'إدارة الواجهة الإعلانية')
@section('subtitle', 'تخصيص البنرات والعروض الترويجية في الصفحة الرئيسية بأسلوب عصري')

@section('actions')
    <a href="{{ route('admin.banners.create') }}"
        class="bento-button text-white h-14 px-10 rounded-2xl font-black text-sm flex items-center gap-4 transition-all active:scale-95 shadow-[0_10px_30px_rgba(99,102,241,0.3)] hover:shadow-[0_15px_40px_rgba(99,102,241,0.5)]">
        <i class="ph ph-plus-circle-fill text-2xl"></i> إضافة بنر جديد
    </a>
@endsection

@section('content')
    <div class="space-y-12 pb-20">
        <!-- Dashboard Banner Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">
            @forelse($banners as $banner)
                <div class="relative rounded-3xl overflow-hidden shadow-[0_10px_40px_rgba(2,6,23,0.12)] hover:shadow-[0_20px_60px_rgba(2,6,23,0.18)] transition-all bg-white dark:bg-slate-900 border border-transparent hover:border-white/5">
                    <div class="relative w-full h-48 md:h-44 lg:h-48 overflow-hidden">
                        <img src="{{ $banner->full_image_url }}" class="w-full h-full object-cover transform transition-transform duration-1000 hover:scale-105" alt="{{ $banner->title }}">
                        <div class="absolute inset-0" style="background: linear-gradient(180deg, rgba(0,0,0,0.22), rgba(0,0,0,0.34)); mix-blend-mode: multiply;"></div>
                        <div class="absolute left-6 top-6">
                            @if($banner->is_active)
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-500/10 text-emerald-500 border border-emerald-500/10 text-xs font-black">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    نشط
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-700/20 text-slate-300 border border-white/5 text-xs font-black">
                                    معطل
                                </span>
                            @endif
                        </div>
                        <div class="absolute right-6 top-6 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center text-white/90">
                                <span class="text-xs font-black">#{{ str_pad($banner->id, 3, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div class="w-10 h-10 rounded-lg bg-white/5 flex items-center justify-center text-white/90">
                                <span class="text-sm font-black">{{ $banner->sort_order }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 md:p-8 bg-gradient-to-t from-white/50 dark:from-transparent">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-lg bg-white shadow-sm flex items-center justify-center text-slate-900 dark:text-white">
                                <i class="ph {{ $banner->icon ?? 'ph-presentation-chart-fill' }} text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg md:text-xl font-extrabold text-slate-900 dark:text-white leading-tight">{{ $banner->title ?: 'عرض ترويجي غير معنون' }}</h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 truncate" dir="ltr"> <i class="ph ph-link-simple text-brand-500"></i> {{ $banner->link_url ?: 'NO_EXTERNAL_REDIRECT' }}</p>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-between">
                            <div class="text-xs text-slate-400">معاينة البنر</div>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="px-4 py-2 rounded-lg bg-white/5 text-slate-800 dark:text-white border border-white/5 hover:bg-brand-500 hover:text-white transition-all text-sm font-black">تعديل</a>
                                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا البنر؟')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-4 py-2 rounded-lg bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all text-sm font-black">حذف</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-48 text-center bento-card border-white/5 bg-white/[0.01]">
                    <div class="w-32 h-32 rounded-[3.5rem] bg-white/[0.02] border border-white/5 flex items-center justify-center mx-auto mb-12 shadow-inner group">
                        <i class="ph ph-presentation-chart-fill text-7xl text-slate-700 group-hover:scale-110 transition-all duration-700"></i>
                    </div>
                    <h4 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">لا توجد عروض ترويجية</h4>
                    <p class="text-base text-slate-500 font-bold mt-6 opacity-60 max-w-md mx-auto leading-relaxed">لم تقم بإضافة أي بنرات إعلانية حتى الآن لتظهر في الواجهة الرئيسية للمتجر.</p>
                    <p class="text-xs text-brand-500/40 font-black uppercase tracking-[0.5em] mt-10 italic">Empty Banner Carousel</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection