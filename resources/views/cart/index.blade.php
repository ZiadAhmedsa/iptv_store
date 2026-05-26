@extends('layouts.app')

@section('content')
@php
    $contactWhatsapp = \App\Models\Setting::get('contact_whatsapp', '+967 778340075');
    $contactEmail = \App\Models\Setting::get('contact_email', config('mail.from.address', 'support@inzo-store.com'));
@endphp

<div class="w-full max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-12 2xl:px-24 py-20">
    <!-- Page Header -->
    <div class="mb-16 flex flex-col md:flex-row items-end justify-between gap-8 border-b border-slate-100 dark:border-white/5 pb-12">
        <div class="space-y-4">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-500/10 text-brand-500 text-[10px] font-black uppercase tracking-widest border border-brand-500/20">
                <i class="ph ph-shopping-bag"></i>
                إدارة مشترياتك
            </div>
            <h1 class="text-5xl md:text-7xl font-black text-slate-900 dark:text-white leading-none tracking-tighter">
                سلة <span class="brand-text">المشتريات</span>
            </h1>
        </div>
        <div class="px-8 py-4 rounded-3xl bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/5 shadow-xl flex items-center gap-4">
            <i class="ph ph-shopping-cart text-3xl text-brand-500"></i>
            <div class="text-right">
                <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest">إجمالي المنتجات</p>
                <p class="text-xl font-black text-slate-900 dark:text-white">{{ count($cart) }} عنصر</p>
            </div>
        </div>
    </div>

    @if(empty($cart))
        <div class="rounded-[4rem] border border-slate-100 dark:border-white/5 bg-white dark:bg-slate-900/50 backdrop-blur-3xl p-24 text-center space-y-10 relative overflow-hidden">
            <div class="absolute -top-24 -right-24 w-64 h-64 brand-gradient opacity-10 blur-[100px] rounded-full"></div>
            <div class="w-32 h-32 rounded-[2.5rem] bg-slate-50 dark:bg-white/5 flex items-center justify-center mx-auto shadow-inner">
                <i class="ph ph-shopping-cart text-6xl text-slate-300 dark:text-slate-700"></i>
            </div>
            <div class="space-y-4">
                <h3 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight">سلتك خالية حالياً</h3>
                <p class="text-slate-500 dark:text-slate-400 font-bold max-w-md mx-auto leading-relaxed">
                    يبدو أنك لم تقم بإضافة أي اشتراك رقمي بعد. تصفح عروضنا الحصرية الآن وابدأ تجربتك المتميزة.
                </p>
            </div>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-4 brand-gradient text-white px-12 py-6 rounded-2xl font-black text-xl shadow-2xl shadow-brand-500/30 transition-all hover:scale-105">
                <i class="ph ph-house"></i> العودة للمتجر
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 items-start">
            <!-- Items List -->
            <div class="lg:col-span-2 space-y-8">
                @foreach($cart as $id => $item)
                    <div class="modern-card group relative rounded-[3.5rem] border border-slate-100 dark:border-white/5 bg-white dark:bg-slate-900/50 p-8 flex flex-col sm:flex-row items-center gap-10">
                        <!-- Product Visual -->
                        <div class="relative w-full sm:w-56 md:w-64 h-56 sm:h-64 rounded-[2.5rem] overflow-hidden bg-slate-50 dark:bg-slate-950 flex items-center justify-center border border-slate-100 dark:border-white/5">
                            @if(!empty($item['image']))
                                <img src="{{ $item['image'] }}" alt="{{ $item['name_ar'] }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                            @else
                                <i class="ph ph-monitor-play text-8xl text-slate-200 dark:text-slate-800"></i>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="flex-1 space-y-3 text-center sm:text-right w-full">
                            <h3 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight group-hover:text-brand-500 transition-colors">
                                {{ $item['name_ar'] }}
                            </h3>
                            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-6">
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest">سعر الوحدة</p>
                                    <p class="text-xl md:text-2xl font-black text-brand-500 flex items-baseline gap-1">
                                        {{ number_format($item['price'], 0) }}
                                        <span class="text-xl md:text-2xl font-black text-brand-500">⃁</span>
                                    </p>
                                </div>
                                <div class="w-px h-8 bg-slate-100 dark:bg-white/10 hidden sm:block"></div>
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest">المجموع</p>
                                    <p class="text-xl font-black text-slate-900 dark:text-white flex items-baseline gap-1">
                                        {{ number_format($item['price'] * $item['quantity'], 0) }}
                                        <span class="text-sm font-black text-brand-500">⃁</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-row sm:flex-col gap-4 w-full sm:w-auto">
                            <div class="flex-1 sm:flex-none flex items-center justify-between bg-slate-50 dark:bg-white/5 rounded-2xl p-2 border border-slate-100 dark:border-white/5">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center justify-between w-full">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="action" value="decrease" class="w-10 h-10 rounded-xl hover:bg-white/10 flex items-center justify-center text-slate-500 transition-all">
                                    <i class="ph ph-minus font-bold"></i>
                                </button>
                                <span class="w-14 text-center text-lg md:text-xl font-black text-slate-900 dark:text-white">{{ $item['quantity'] }}</span>
                                <button type="submit" name="action" value="increase" class="w-10 h-10 rounded-xl hover:bg-white/10 flex items-center justify-center text-slate-500 transition-all">
                                    <i class="ph ph-plus font-bold"></i>
                                </button>
                            </form>
                        </div>
                            
                            <form action="{{ route('cart.remove', $id) }}" method="POST" class="w-auto sm:w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full h-14 rounded-2xl bg-rose-500/5 text-rose-500 hover:bg-rose-500 hover:text-white transition-all flex items-center justify-center gap-3 border border-rose-500/10">
                                    <i class="ph ph-trash text-xl"></i>
                                    <span class="sm:hidden font-black">حذف</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <aside class="sticky top-32">
                <div class="rounded-[3.5rem] border border-slate-100 dark:border-white/5 bg-white dark:bg-slate-900 p-10 shadow-2xl space-y-10 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-32 h-32 brand-gradient opacity-5 blur-3xl rounded-full"></div>
                    
                    <h3 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">ملخص الطلب</h3>
                    
                    <div class="space-y-6">
                        <div class="flex justify-between items-center text-slate-500 font-bold uppercase tracking-widest text-[10px]">
                            <span>عدد العناصر</span>
                            <span class="text-slate-900 dark:text-white font-black text-sm">{{ count($cart) }}</span>
                        </div>
                        <div class="h-px bg-slate-100 dark:bg-white/5"></div>
                        <div class="flex flex-col gap-2">
                            <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest">إجمالي المستحق</span>
                            <div class="flex items-baseline gap-2">
                                <span class="text-5xl font-black text-slate-900 dark:text-white">{{ number_format($total, 0) }}</span>
                                <span class="text-3xl font-black text-brand-500">⃁</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-slate-50 dark:bg-white/[0.02] rounded-[2rem] border border-slate-100 dark:border-white/5 space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center text-xl">
                                <i class="ph ph-whatsapp-logo"></i>
                            </div>
                            <div class="text-right">
                                <p class="text-[9px] font-black uppercase text-slate-400 tracking-widest">واتساب المبيعات</p>
                                <p class="text-sm font-black text-slate-700 dark:text-slate-300" dir="ltr">{{ $contactWhatsapp }}</p>
                            </div>
                        </div>
                        <p class="text-[10px] text-slate-500 font-bold leading-relaxed">
                            بعد إتمام الطلب، سيقوم فريقنا بالتواصل معك فوراً لتزويدك ببيانات الاشتراك وتفعيل حسابك.
                        </p>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="brand-gradient text-white w-full py-6 rounded-2xl font-black text-xl shadow-2xl shadow-brand-500/30 transition-all hover:scale-[1.03] active:scale-95 flex items-center justify-center gap-4">
                        إتمام عملية الدفع
                        <i class="ph ph-arrow-left text-2xl"></i>
                    </a>
                </div>
            </aside>
        </div>
    @endif
</div>
@endsection
