@extends('layouts.app')

@php
    $siteName = \App\Models\Setting::get('site_name', 'World Cup 4K Store');
@endphp

@section('meta_title', $category->name_ar . ' - اشتراكات IPTV 4K | ' . $siteName)
@section('meta_keywords', 'شراء اشتراك iptv, iptv world cup channels 4k, سيرفر iptv مدفوع')

@section('content')
<div class="w-full max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-12 2xl:px-24 py-24 relative overflow-hidden">
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-12 relative z-10">
        <a href="{{ route('home') }}" class="hover:text-brand-500 transition-colors">الرئيسية</a>
        <i class="ph ph-caret-left text-xs"></i>
        <a href="{{ route('categories.index') }}" class="hover:text-brand-500 transition-colors">الأقسام</a>
        <i class="ph ph-caret-left text-xs"></i>
        <span class="text-brand-500">{{ $category->name_ar }}</span>
    </nav>

    <!-- Page Header -->
    <div class="mb-24 relative z-10">
        <div class="flex flex-col md:flex-row items-end justify-between gap-12 border-b border-slate-100 dark:border-white/5 pb-16">
            <div class="space-y-6 max-w-3xl">
                <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-brand-500/10 text-brand-500 text-[10px] font-black uppercase tracking-[0.3em] border border-brand-500/20">
                    <i class="ph ph-tag"></i>
                    تصفح القسم
                </div>
                <h1 class="text-5xl md:text-8xl font-black text-slate-900 dark:text-white leading-tight tracking-tighter">
                    {{ $category->name_ar }} <span class="brand-text">المميزة</span>
                </h1>
                <p class="text-xl text-slate-500 dark:text-slate-400 font-bold leading-relaxed">
                    {{ $category->description_ar ?? 'استكشف مجموعة مختارة من أفضل الاشتراكات والخدمات الرقمية المتوفرة في هذا القسم.' }}
                </p>
            </div>
            <div class="flex flex-col items-end">
                <div class="w-24 h-24 rounded-[2rem] bg-brand-500/10 text-brand-500 flex items-center justify-center text-4xl mb-4 shadow-inner border border-brand-500/10">
                    <i class="ph-bold ph-package"></i>
                </div>
                <span class="text-lg font-black text-slate-900 dark:text-white">{{ $products->total() }} عرض متوفر</span>
            </div>
        </div>
    </div>

    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6 md:gap-8">
            @foreach($products as $product)
                <div onclick="window.location='{{ route('products.show', $product->id) }}'" class="group relative bg-white/80 dark:bg-slate-900/60 backdrop-blur-md rounded-3xl p-4 md:p-5 transition-all duration-300 flex flex-col h-full border border-slate-200 dark:border-white/10 shadow-sm hover:shadow-xl hover:border-brand-500/30 hover:-translate-y-1.5 cursor-pointer z-10">

                    @if($product->has_discount)
                        <div class="absolute top-3 left-3 z-20">
                            <div class="bg-white dark:bg-slate-800 border border-red-500 rounded-[1rem] px-2.5 py-1 flex flex-col items-center justify-center shadow-lg shadow-red-500/20 transform -rotate-3">
                                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-0.5">خصم</span>
                                <span class="text-base md:text-xl font-black text-red-600 leading-none">{{ $product->discount_percentage }}%</span>
                            </div>
                        </div>
                    @endif

                    <a href="{{ route('products.show', $product->id) }}" onclick="event.stopPropagation()" class="relative w-full aspect-[5/4] md:aspect-[4/3] min-h-[320px] rounded-[2.5rem] overflow-hidden mb-4 flex items-center justify-center bg-slate-50 dark:bg-slate-950/40 border border-slate-100 dark:border-white/5 transition-all duration-300">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name_ar }}" class="w-full h-full object-cover p-2 transition-transform duration-700 group-hover:scale-105">
                        @else
                            <i class="ph-duotone ph-television text-6xl md:text-7xl text-slate-300 dark:text-slate-700 transition-transform duration-700 group-hover:text-brand-500 group-hover:scale-110"></i>
                        @endif
                    </a>

                    <div class="space-y-3">
                        <h3 class="text-lg md:text-xl font-black text-slate-900 dark:text-white tracking-tight group-hover:text-brand-500 transition-colors line-clamp-1">
                            {{ $product->name_ar }}
                        </h3>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100 dark:border-white/10 flex items-center justify-between">
                        <div class="space-y-0.5">
                            <span class="text-[8px] uppercase tracking-[0.25em] text-slate-400 block">السعر</span>
                            <div class="flex items-end gap-1">
                                <span class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white">
                                    {{ number_format($product->effective_price, 0) }}
                                </span>
                                <span class="text-2xl md:text-3xl font-black text-brand-500 mb-0.5 ml-1">⃁</span>
                            </div>
                        </div>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" onclick="event.stopPropagation()">
                            @csrf
                            <button type="submit" class="w-10 h-10 rounded-xl bg-brand-500 text-white flex items-center justify-center shadow-xl shadow-brand-500/20 hover:scale-105 active:scale-95 transition-all">
                                <i class="ph-bold ph-shopping-cart-simple text-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12 relative z-10">
            {{ $products->links() }}
        </div>
    @else
        <div class="py-40 text-center relative z-10">
            <div class="w-32 h-32 rounded-[3rem] bg-slate-50 dark:bg-white/5 flex items-center justify-center mx-auto mb-10 shadow-inner">
                <i class="ph ph-package text-6xl text-slate-200 dark:text-slate-800"></i>
            </div>
            <h3 class="text-4xl font-black text-slate-900 dark:text-white mb-6">لا توجد منتجات حالياً</h3>
            <p class="text-xl text-slate-500 dark:text-slate-400 font-bold max-w-lg mx-auto">نحن نعمل على إضافة المزيد من العروض المميزة لهذا القسم قريباً.</p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mt-12 text-brand-500 font-black text-lg hover:translate-x-[-10px] transition-transform">
                العودة للرئيسية <i class="ph ph-arrow-left text-2xl"></i>
            </a>
        </div>
    @endif
</div>
@endsection
