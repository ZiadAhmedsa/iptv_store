@extends('layouts.app')

@section('content')
@php
    $contactWhatsapp = \App\Models\Setting::get('contact_whatsapp', '+967 778340075');
    $contactEmail = \App\Models\Setting::get('contact_email', config('mail.from.address', 'support@inzo-store.com'));
@endphp

<div class="w-full max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-12 2xl:px-24 py-16 md:py-24 relative overflow-hidden">
    <!-- Decorative background glow -->
    <div class="absolute -top-48 -left-48 w-96 h-96 brand-gradient opacity-10 blur-[150px] rounded-full animate-pulse-glow"></div>
    <div class="absolute top-1/2 -right-48 w-96 h-96 brand-gradient opacity-5 blur-[150px] rounded-full"></div>

    <!-- Breadcrumbs & Step Indicator -->
    <div class="max-w-5xl mx-auto mb-16 relative z-10">
        <nav class="flex items-center gap-3 text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-brand-500 transition-colors">الرئيسية</a>
            <i class="ph ph-caret-left text-xs"></i>
            <span class="text-brand-500">إتمام الطلب</span>
        </nav>

        <!-- Visual Step Progress -->
        <div class="flex items-center justify-between relative">
            <div class="absolute top-1/2 left-0 w-full h-1 bg-slate-100 dark:bg-slate-800 -translate-y-1/2 z-0 rounded-full">
                <div class="h-full w-1/3 brand-gradient rounded-full shadow-[0_0_15px_rgba(var(--brand-glow))]"></div>
            </div>
            
            <div class="relative z-10 flex flex-col items-center gap-3">
                <div class="w-12 h-12 rounded-2xl brand-gradient text-white flex items-center justify-center text-xl shadow-xl shadow-brand-500/20 border-4 border-white dark:border-slate-950">
                    <i class="ph-bold ph-user"></i>
                </div>
                <span class="text-xs font-black text-brand-500 uppercase tracking-widest">بياناتك</span>
            </div>

            <div class="relative z-10 flex flex-col items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center text-xl border-4 border-white dark:border-slate-950">
                    <i class="ph-bold ph-credit-card"></i>
                </div>
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">الدفع</span>
            </div>

            <div class="relative z-10 flex flex-col items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center text-xl border-4 border-white dark:border-slate-950">
                    <i class="ph-bold ph-check"></i>
                </div>
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">التأكيد</span>
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <div class="max-w-5xl mx-auto mb-16 text-center space-y-6 relative z-10">
        <div class="inline-flex items-center gap-3 px-6 py-2 rounded-full bg-brand-500/10 text-brand-500 text-xs font-black uppercase tracking-[0.3em] border border-brand-500/20 backdrop-blur-sm">
            <i class="ph-bold ph-shield-check"></i>
            بوابة دفع آمنة 100%
        </div>
        <h1 class="text-5xl md:text-7xl font-black text-slate-900 dark:text-white leading-tight tracking-tighter">
            لنقم بتجهيز <span class="brand-text">اشتراكك</span>
        </h1>
        <p class="text-lg md:text-xl text-slate-500 dark:text-slate-400 font-bold max-w-xl mx-auto leading-relaxed">
            أدخل بيانات التواصل الخاصة بك لنتمكن من تزويدك ببيانات الاشتراك وتفعيله لك فوراً.
        </p>
    </div>

    <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8 relative z-10">
        <!-- Main Form Column -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-2xl overflow-hidden group hover:border-brand-500/30 transition-all duration-500">
                <div class="p-8 md:p-12">
                    <form action="{{ route('checkout.confirm') }}" method="POST" id="checkout-form" class="space-y-10">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- WhatsApp Number -->
                            <div class="space-y-4">
                                <label class="text-xs font-black uppercase text-slate-400 tracking-widest px-2 flex items-center gap-2">
                                    <i class="ph-bold ph-whatsapp-logo text-emerald-500 text-lg"></i>
                                    رقم الواتساب
                                </label>
                                <div class="relative group">
                                    <input type="text" name="whatsapp_number" required placeholder="05xxxxxxxx"
                                        class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 rounded-2xl px-8 py-5 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-black text-lg placeholder:text-slate-300 dark:placeholder:text-slate-700">
                                    <div class="absolute inset-0 rounded-2xl bg-brand-500/5 opacity-0 group-focus-within:opacity-100 pointer-events-none transition-opacity"></div>
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="space-y-4">
                                <label class="text-xs font-black uppercase text-slate-400 tracking-widest px-2 flex items-center gap-2">
                                    <i class="ph-bold ph-envelope-simple text-brand-500 text-lg"></i>
                                    البريد الإلكتروني
                                </label>
                                <div class="relative group">
                                    <input type="email" name="email" required placeholder="example@mail.com"
                                        class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 rounded-2xl px-8 py-5 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-black text-lg placeholder:text-slate-300 dark:placeholder:text-slate-700">
                                    <div class="absolute inset-0 rounded-2xl bg-brand-500/5 opacity-0 group-focus-within:opacity-100 pointer-events-none transition-opacity"></div>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="space-y-4 md:col-span-2">
                                <label class="text-xs font-black uppercase text-slate-400 tracking-widest px-2 flex items-center gap-2">
                                    <i class="ph-bold ph-note-pencil text-slate-400 text-lg"></i>
                                    ملاحظات إضافية (اختياري)
                                </label>
                                <textarea name="notes" rows="4" placeholder="هل لديك طلب خاص أو استفسار؟"
                                    class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 rounded-2xl px-8 py-5 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold placeholder:text-slate-300 dark:placeholder:text-slate-700 resize-none"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Trust Badges Bento -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="p-6 rounded-[2rem] bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/5 flex flex-col items-center justify-center text-center gap-3 group hover:scale-[1.02] transition-all">
                    <i class="ph-fill ph-lightning text-amber-500 text-3xl"></i>
                    <span class="text-xs font-black text-slate-500">تفعيل فوري</span>
                </div>
                <div class="p-6 rounded-[2rem] bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/5 flex flex-col items-center justify-center text-center gap-3 group hover:scale-[1.02] transition-all">
                    <i class="ph-fill ph-shield-check text-emerald-500 text-3xl"></i>
                    <span class="text-xs font-black text-slate-500">آمن وموثوق</span>
                </div>
                <div class="p-6 rounded-[2rem] bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/5 flex flex-col items-center justify-center text-center gap-3 group hover:scale-[1.02] transition-all">
                    <i class="ph-fill ph-headphones text-brand-500 text-3xl"></i>
                    <span class="text-xs font-black text-slate-500">دعم 24/7</span>
                </div>
                <div class="p-6 rounded-[2rem] bg-white dark:bg-slate-900 border border-slate-100 dark:border-white/5 flex flex-col items-center justify-center text-center gap-3 group hover:scale-[1.02] transition-all">
                    <i class="ph-fill ph-sketch-logo text-purple-500 text-3xl"></i>
                    <span class="text-xs font-black text-slate-500">جودة 4K</span>
                </div>
            </div>
        </div>

        <!-- Sidebar Summary Column -->
        <div class="space-y-8">
            <div class="bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-2xl overflow-hidden sticky top-32">
                <div class="brand-gradient p-8 text-white relative">
                    <div class="absolute -top-12 -right-12 w-32 h-32 bg-white/10 blur-3xl rounded-full"></div>
                    <h2 class="text-2xl font-black mb-1 relative z-10">ملخص الطلب</h2>
                    <p class="text-brand-100 text-xs font-bold opacity-80 relative z-10">راجع طلبك قبل الدفع</p>
                </div>
                
                <div class="p-8 space-y-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-slate-400">عدد المنتجات</span>
                            <span class="text-sm font-black text-slate-900 dark:text-white">باقة مختارة</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-slate-400">الضريبة (VAT)</span>
                            <span class="text-base md:text-lg font-black text-emerald-500">0.00 <span class="text-xl md:text-2xl">⃁</span></span>
                        </div>
                    </div>

                    <div class="h-px bg-slate-100 dark:bg-white/5 w-full"></div>

                    <div class="py-4">
                        <p class="text-xs font-black uppercase text-slate-400 tracking-widest mb-2">إجمالي المبلغ</p>
                        <div class="flex items-baseline gap-2">
                            <span class="text-6xl md:text-7xl font-black text-slate-900 dark:text-white tracking-tighter">
                                {{ number_format($total, 0) }}
                            </span>
                            <span class="text-3xl md:text-4xl font-black text-slate-400 dark:text-slate-500">⃁</span>
                        </div>
                    </div>

                    <button type="submit" form="checkout-form" class="w-full brand-gradient text-white py-6 rounded-2xl font-black text-xl shadow-2xl shadow-brand-500/40 transition-all hover:scale-[1.05] active:scale-95 flex items-center justify-center gap-4 group">
                        الاستمرار للدفع
                        <i class="ph ph-arrow-left text-2xl group-hover:translate-x-[-8px] transition-transform"></i>
                    </button>
                    
                    <p class="text-[10px] text-slate-400 font-bold text-center px-4 leading-relaxed">
                        بالضغط على زر الاستمرار، أنت توافق على شروط الخدمة وسياسة الخصوصية الخاصة بنا.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection