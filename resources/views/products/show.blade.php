@extends('layouts.app')

@php
    $siteName = \App\Models\Setting::get('site_name', 'World Cup 4K Store');
@endphp

@section('meta_title', $product->name_ar . ' - ' . $siteName . ' | اشتراك IPTV احترافي')
@section('meta_keywords', 'تجديد اشتراك iptv, stable iptv for world cup, اشتراك iptv 4k')

@section('content')
<div class="min-h-screen relative bg-slate-50 dark:bg-slate-950 py-20 overflow-hidden">
    <!-- Huge background glow for ultra-luxury feel -->
    <div class="absolute top-0 right-0 w-[800px] h-[800px] brand-gradient rounded-full opacity-[0.07] dark:opacity-10 blur-[120px] pointer-events-none translate-x-1/3 -translate-y-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-purple-500 rounded-full opacity-[0.03] dark:opacity-5 blur-[100px] pointer-events-none -translate-x-1/3 translate-y-1/3"></div>

    <div class="w-full max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-12 2xl:px-24 relative z-10">
        <!-- Premium Breadcrumbs -->
        <nav class="flex items-center gap-4 mb-16 text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-brand-500 transition">الرئيسية</a>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-200 dark:bg-white/10"></span>
            <span class="text-slate-500">{{ $product->category->name_ar ?? 'المنتجات' }}</span>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-200 dark:bg-white/10"></span>
            <span class="text-brand-500">{{ $product->name_ar }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-[1.2fr_1fr] gap-20 items-start">
            <!-- Product Showcase -->
            <div class="relative group">
                <div class="absolute -inset-10 brand-gradient opacity-10 blur-[120px] rounded-full group-hover:opacity-30 transition-opacity duration-1000"></div>
                <div class="relative rounded-[4rem] overflow-hidden bg-white/60 dark:bg-slate-900/40 backdrop-blur-3xl shadow-[0_50px_100px_-20px_rgba(0,0,0,0.1)] dark:shadow-[0_50px_100px_-20px_rgba(0,0,0,0.5)] border border-white dark:border-white/10 p-12 flex items-center justify-center min-h-[600px]">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name_ar }}" class="w-full h-auto object-contain drop-shadow-2xl transition-transform duration-1000 group-hover:scale-105">
                    @else
                        <div class="w-full aspect-square flex items-center justify-center">
                            <i class="ph-duotone ph-monitor-play text-[12rem] text-slate-200 dark:text-slate-800 drop-shadow-xl"></i>
                        </div>
                    @endif
                    
                    <div class="absolute top-10 right-10">
                        <div class="bg-white/10 backdrop-blur-3xl border border-white/20 text-white px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-2xl">
                            Premium Collection
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="space-y-12">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-3 px-4 py-2 rounded-xl bg-brand-500/10 text-brand-500 text-[10px] font-black uppercase tracking-widest border border-brand-500/20">
                        <i class="ph ph-sparkle"></i>
                        {{ $product->category->name_ar ?? 'إصدار مميز' }}
                    </div>
                    <h1 class="text-5xl md:text-7xl font-black text-slate-900 dark:text-white leading-[1.1] tracking-tighter drop-shadow-sm">
                        {{ $product->name_ar }}
                    </h1>
                    
                    <!-- Features Grid instead of paragraph -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
                        @php
                            $features = explode("\n", trim($product->description_ar));
                        @endphp
                        @foreach($features as $feature)
                            @if(trim($feature) !== '')
                            <div class="flex items-center gap-4 bg-white/60 dark:bg-white/5 backdrop-blur-md p-4 rounded-2xl border border-white dark:border-white/10 shadow-sm hover:shadow-md transition-shadow">
                                <div class="w-12 h-12 rounded-xl brand-gradient flex items-center justify-center text-white flex-shrink-0 shadow-lg shadow-brand-500/20">
                                    <i class="ph-bold ph-check text-xl"></i>
                                </div>
                                <span class="text-slate-700 dark:text-slate-200 font-bold text-sm leading-relaxed">{{ trim($feature) }}</span>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-2xl rounded-[3.5rem] p-10 md:p-14 border border-white dark:border-white/10 shadow-[0_30px_80px_-20px_rgba(0,0,0,0.15)] space-y-10 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 brand-gradient opacity-10 blur-[80px] rounded-full pointer-events-none"></div>
                    
                    <div class="flex flex-col gap-4">
                        <span class="text-[10px] font-black uppercase text-slate-400 tracking-[0.4em]">التكلفة النهائية</span>
                        <div class="flex items-baseline gap-4">
                            <div class="text-6xl md:text-7xl font-black text-slate-900 dark:text-white flex items-baseline gap-2">
                                {{ number_format($product->effective_price, 0) }}
                                <span class="text-5xl md:text-6xl font-black text-brand-500">⃁</span>
                            </div>
                            @if($product->has_discount)
                                <span class="text-2xl text-slate-300 dark:text-slate-700 line-through font-bold">
                                    {{ number_format($product->price, 0) }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-[160px_1fr] gap-4">
                            <!-- Quantity -->
                            <div class="flex items-center justify-between bg-slate-50 dark:bg-white/[0.02] rounded-2xl p-2 border border-slate-100 dark:border-white/5">
                                <button type="button" onclick="this.nextElementSibling.stepDown()" class="w-12 h-12 rounded-xl hover:bg-slate-200 dark:hover:bg-white/10 flex items-center justify-center text-slate-500 transition-all">
                                    <i class="ph ph-minus font-bold"></i>
                                </button>
                                <input type="number" name="quantity" value="1" min="1" class="w-12 bg-transparent text-center text-xl font-black text-slate-900 dark:text-white focus:outline-none">
                                <button type="button" onclick="this.previousElementSibling.stepUp()" class="w-12 h-12 rounded-xl hover:bg-slate-200 dark:hover:bg-white/10 flex items-center justify-center text-slate-500 transition-all">
                                    <i class="ph ph-plus font-bold"></i>
                                </button>
                            </div>
                            
                            <!-- Action Button -->
                            <button type="submit" class="brand-gradient text-white py-6 px-10 rounded-2xl font-black text-xl shadow-2xl shadow-brand-500/30 transition-all hover:scale-[1.03] active:scale-95 flex items-center justify-center gap-4">
                                <i class="ph ph-shopping-cart text-2xl"></i>
                                إتمام الطلب الآن
                            </button>
                        </div>
                    </form>

                    <!-- Fast Delivery Info -->
                    <div class="flex items-center gap-4 p-5 bg-emerald-500/5 rounded-2xl border border-emerald-500/10">
                        <div class="w-12 h-12 rounded-xl bg-emerald-500 flex items-center justify-center text-white shadow-lg shadow-emerald-500/30">
                            <i class="ph ph-lightning-fill text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-black text-emerald-600 dark:text-emerald-400">تسليم فوري ومؤتمت</p>
                            <p class="text-[10px] text-slate-500 font-bold">سيتم إرسال الكود فوراً بعد نجاح عملية الدفع</p>
                        </div>
                    </div>
                </div>

                <!-- Trust Section -->
                <div class="grid grid-cols-3 gap-8">
                    <div class="space-y-3 text-center">
                        <i class="ph ph-shield-check text-3xl text-slate-300 dark:text-slate-700"></i>
                        <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">آمن تماماً</p>
                    </div>
                    <div class="space-y-3 text-center border-x border-slate-200 dark:border-white/5">
                        <i class="ph ph-headset text-3xl text-slate-300 dark:text-slate-700"></i>
                        <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">دعم 24/7</p>
                    </div>
                    <div class="space-y-3 text-center">
                        <i class="ph ph-arrows-counter-clockwise text-3xl text-slate-300 dark:text-slate-700"></i>
                        <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">ضمان ذهبي</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
