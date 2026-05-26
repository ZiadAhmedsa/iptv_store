@extends('layouts.admin')

@php
    $themeColor = \App\Models\Setting::get('theme_color', '#6366f1');
@endphp


@section('title', 'مركز الإشعارات')
@section('subtitle', 'مراقبة نشاطات المتجر والطلبات الواردة')

@section('actions')
    <div class="flex items-center gap-4">
        <div class="px-4 py-2 bg-brand-500/10 text-brand-500 rounded-xl border border-brand-500/10 flex items-center gap-3">
            <span class="text-xs font-black">{{ $notifications->count() }} معلق</span>
            <i class="ph ph-bell-ringing text-lg animate-pulse"></i>
        </div>
        <button class="bento-button !h-11 !text-xs !px-6">
            <i class="ph ph-check-square-offset text-lg"></i> قراءة الكل
        </button>
    </div>
@endsection

@section('content')
    <div class="max-w-4xl mx-auto space-y-8">
        <!-- Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bento-card p-6 flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center text-xl">
                    <i class="ph ph-shopping-cart"></i>
                </div>
                <div>
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest">طلبات المنتجات</p>
                    <p class="text-xl font-black text-slate-900 dark:text-white">{{ $stats['pending_orders'] ?? 0 }}</p>
                </div>
            </div>
            <div class="bento-card p-6 flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center text-xl">
                    <i class="ph ph-gift"></i>
                </div>
                <div>
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest">طلبات الاشتراكات</p>
                    <p class="text-xl font-black text-slate-900 dark:text-white">{{ $stats['pending_subscription_requests'] ?? 0 }}</p>
                </div>
            </div>
            <div class="bento-card p-6 flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center text-xl">
                    <i class="ph ph-trend-up"></i>
                </div>
                <div>
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest">نشاط اليوم</p>
                    <p class="text-xl font-black text-slate-900 dark:text-white">{{ $stats['new_orders_last_day'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Notifications List -->
        <div class="bento-card overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 dark:border-white/5 flex justify-between items-center bg-slate-50/50 dark:bg-white/[0.01]">
                <h3 class="text-sm font-black text-slate-900 dark:text-white flex items-center gap-3">
                    <i class="ph ph-list-bullets text-lg text-brand-500"></i>
                    سجل النشاطات
                </h3>
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">تحديث مباشر</span>
            </div>

            <div class="divide-y divide-slate-50 dark:divide-white/5">
                @forelse($notifications as $notification)
                    <div class="p-8 hover:bg-slate-50/50 dark:hover:bg-white/[0.01] transition-all relative border-r-2 {{ !$notification->read_at ? 'border-r-brand-500 bg-brand-500/[0.02]' : 'border-r-transparent' }}">
                        <div class="flex items-start gap-6">
                            <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl relative {{ $notification->type == 'order' ? 'bg-emerald-500/10 text-emerald-500' : 'bg-amber-500/10 text-amber-500' }}">
                                <i class="ph {{ $notification->icon ?? 'ph-info' }}"></i>
                                @unless($notification->read_at)
                                    <span class="absolute -top-0.5 -right-0.5 w-3 h-3 bg-red-500 rounded-full border-2 border-white dark:border-slate-900 shadow-sm"></span>
                                @endunless
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-base font-black text-slate-900 dark:text-white">{{ $notification->title }}</h4>
                                        <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest {{ $notification->type == 'order' ? 'bg-emerald-500/10 text-emerald-500' : 'bg-amber-500/10 text-amber-500' }}">
                                            {{ $notification->type == 'order' ? 'طلب منتج' : 'اشتراك' }}
                                        </span>
                                    </div>
                                    <span class="text-xs font-bold text-slate-400">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-sm text-slate-500 dark:text-slate-400 font-bold leading-relaxed">
                                    {{ $notification->message }}
                                </p>

                                @if($notification->link)
                                    <div class="mt-6 flex items-center justify-between">
                                        <a href="{{ $notification->link }}" class="inline-flex items-center gap-2 text-[11px] font-black text-brand-500 uppercase tracking-widest hover:gap-3 transition-all">
                                            معالجة الطلب <i class="ph ph-arrow-left"></i>
                                        </a>
                                        <span class="text-xs text-slate-400 font-bold">{{ $notification->created_at->format('H:i | Y/m/d') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-24 text-center">
                        <div class="w-20 h-20 rounded-3xl bg-slate-50 dark:bg-white/5 flex items-center justify-center mx-auto mb-6">
                            <i class="ph ph-bell-slash text-4xl text-slate-300"></i>
                        </div>
                        <h4 class="text-base font-black text-slate-400 uppercase tracking-widest">لا توجد تنبيهات</h4>
                        <p class="text-xs text-slate-500 font-bold mt-2 opacity-60">سيتم عرض النشاطات الجديدة هنا فور حدوثها</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection