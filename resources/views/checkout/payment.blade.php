@extends('layouts.app')

@section('content')
<div class="w-full max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-12 2xl:px-24 py-16 md:py-24 relative overflow-hidden">
    <!-- Decorative background glow -->
    <div class="absolute -top-48 -left-48 w-96 h-96 brand-gradient opacity-10 blur-[150px] rounded-full animate-pulse-glow"></div>
    <div class="absolute bottom-0 -right-48 w-96 h-96 brand-gradient opacity-5 blur-[150px] rounded-full"></div>

    <!-- Breadcrumbs & Step Indicator -->
    <div class="max-w-5xl mx-auto mb-16 relative z-10">
        <nav class="flex items-center gap-3 text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-brand-500 transition-colors">الرئيسية</a>
            <i class="ph ph-caret-left text-xs"></i>
            <a href="{{ route('checkout.index') }}" class="hover:text-brand-500 transition-colors">إتمام الطلب</a>
            <i class="ph ph-caret-left text-xs"></i>
            <span class="text-brand-500">الدفع</span>
        </nav>

        <!-- Visual Step Progress -->
        <div class="flex items-center justify-between relative">
            <div class="absolute top-1/2 left-0 w-full h-1 bg-slate-100 dark:bg-slate-800 -translate-y-1/2 z-0 rounded-full">
                <div class="h-full w-2/3 brand-gradient rounded-full shadow-[0_0_15px_rgba(var(--brand-glow))] transition-all duration-1000"></div>
            </div>
            
            <div class="relative z-10 flex flex-col items-center gap-3">
                <div class="w-12 h-12 rounded-2xl brand-gradient text-white flex items-center justify-center text-xl shadow-xl shadow-brand-500/20 border-4 border-white dark:border-slate-950">
                    <i class="ph-bold ph-check"></i>
                </div>
                <span class="text-xs font-black text-brand-500 uppercase tracking-widest">بياناتك</span>
            </div>

            <div class="relative z-10 flex flex-col items-center gap-3">
                <div class="w-12 h-12 rounded-2xl brand-gradient text-white flex items-center justify-center text-xl shadow-xl shadow-brand-500/20 border-4 border-white dark:border-slate-950 scale-110">
                    <i class="ph-bold ph-credit-card"></i>
                </div>
                <span class="text-xs font-black text-brand-500 uppercase tracking-widest">الدفع</span>
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
    <div class="max-w-5xl mx-auto mb-12 text-center space-y-6 relative z-10">
        <div class="inline-flex items-center gap-3 px-6 py-2 rounded-full bg-amber-500/10 text-amber-500 text-xs font-black uppercase tracking-[0.3em] border border-amber-500/20 backdrop-blur-sm">
            <i class="ph-bold ph-hourglass-high"></i>
            خطوة واحدة أخيرة
        </div>
        <h1 class="text-4xl md:text-6xl font-black text-slate-900 dark:text-white leading-tight tracking-tighter">
            الدفع عبر <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-amber-600">التحويل البنكي</span>
        </h1>
        <p class="text-lg text-slate-500 dark:text-slate-400 font-bold max-w-xl mx-auto leading-relaxed">
            الرجاء تحويل مبلغ الطلب إلى الحساب الموضح أدناه، ثم أرسل الإيصال لتفعيل طلبك.
        </p>
    </div>

    <div class="max-w-4xl mx-auto relative z-10">
        <!-- Main Payment Card -->
        <div class="bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-2xl overflow-hidden mb-8">
            <!-- Amount Header -->
            <div class="bg-slate-50 dark:bg-white/[0.02] p-10 text-center border-b border-slate-100 dark:border-white/5 relative overflow-hidden">
                <div class="absolute inset-0 brand-gradient opacity-[0.03]"></div>
                <p class="text-xs font-black uppercase text-slate-400 tracking-widest mb-4 relative z-10">إجمالي المبلغ المطلوب للتحويل</p>
                <div class="flex items-baseline justify-center gap-2 relative z-10">
                    <span class="text-7xl md:text-8xl font-black text-slate-900 dark:text-white tracking-tighter">
                        {{ number_format($total, 0) }}
                    </span>
                    <span class="text-4xl md:text-5xl font-black text-slate-400 dark:text-slate-500">⃁</span>
                </div>
            </div>

            <div class="p-8 md:p-16 space-y-12">
                <!-- Bank Details Bento Grid -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-black text-slate-900 dark:text-white flex items-center gap-3">
                            <i class="ph-bold ph-bank text-brand-500 text-2xl"></i>
                            بيانات الحساب البنكي
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Account Name -->
                        <div class="p-6 rounded-3xl bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 space-y-2">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">اسم الحساب</span>
                            <p class="text-lg font-black text-slate-900 dark:text-white">{{ $bankName ?: 'غير محدد' }}</p>
                        </div>
                        
                        <!-- Bank Name -->
                        <div class="p-6 rounded-3xl bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 space-y-2">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">المصرف</span>
                            <p class="text-lg font-black text-slate-900 dark:text-white">مصرف الراجحي</p>
                        </div>

                        <!-- Account Number -->
                        <div class="md:col-span-2 p-6 rounded-3xl bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="space-y-2">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">رقم الحساب</span>
                                <p class="text-2xl font-black text-slate-900 dark:text-white tracking-wider" dir="ltr">{{ $bankAccount ?: '-' }}</p>
                            </div>
                            @if($bankAccount)
                            <button onclick="navigator.clipboard.writeText('{{ $bankAccount }}'); Swal.fire({icon: 'success', title: 'تم النسخ', text: 'تم نسخ رقم الحساب بنجاح', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000})" 
                                class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-brand-500 text-white font-black text-sm hover:scale-[1.05] transition-all shadow-lg shadow-brand-500/20">
                                <i class="ph-bold ph-copy"></i>
                                نسخ الرقم
                            </button>
                            @endif
                        </div>

                        <!-- IBAN -->
                        <div class="md:col-span-2 p-6 rounded-3xl bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="space-y-2 w-full">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">رقم الآيبان (IBAN)</span>
                                <p class="text-xl font-black text-brand-500 tracking-wider break-all" dir="ltr">{{ $bankIban ?: '-' }}</p>
                            </div>
                            @if($bankIban)
                            <button onclick="navigator.clipboard.writeText('{{ $bankIban }}'); Swal.fire({icon: 'success', title: 'تم النسخ', text: 'تم نسخ الآيبان بنجاح', toast: true, position: 'top-end', showConfirmButton: false, timer: 3000})" 
                                class="flex items-center gap-2 px-6 py-3 rounded-2xl bg-slate-500 text-white font-black text-sm hover:scale-[1.05] transition-all shadow-lg shadow-slate-500/20 flex-shrink-0">
                                <i class="ph-bold ph-copy"></i>
                                نسخ الآيبان
                            </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Proof Submission -->
                <div class="space-y-6">
                    <h3 class="text-xl font-black text-slate-900 dark:text-white flex items-center gap-3">
                        <i class="ph-bold ph-whatsapp-logo text-emerald-500 text-2xl"></i>
                        تأكيد عملية التحويل
                    </h3>
                    
                    <div class="bg-emerald-500/5 dark:bg-emerald-500/[0.02] rounded-[2.5rem] p-8 md:p-12 border border-emerald-500/10 text-center space-y-8 group">
                        <p class="text-emerald-800 dark:text-emerald-400 font-bold text-lg leading-relaxed max-w-lg mx-auto">
                            بعد إتمام عملية التحويل، يرجى إرسال صورة الإيصال إلى رقم الواتساب التالي لنقوم بمراجعة الدفعة وتفعيل طلبك فوراً.
                        </p>
                        
                        <div class="inline-flex flex-col md:flex-row items-center gap-6">
                            <div class="px-8 py-4 rounded-2xl bg-white dark:bg-slate-950 border border-emerald-500/20 shadow-xl shadow-emerald-500/5 flex items-center gap-4" dir="ltr">
                                <span class="text-3xl font-black text-slate-900 dark:text-white">{{ $whatsapp ?: 'لم يتم تحديد رقم' }}</span>
                                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                            </div>
                            
                            @if($whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" target="_blank" 
                                class="flex items-center gap-3 px-10 py-5 rounded-2xl bg-emerald-500 text-white font-black text-lg hover:scale-[1.05] hover:shadow-2xl hover:shadow-emerald-500/30 transition-all group">
                                <i class="ph-fill ph-whatsapp-logo text-3xl"></i>
                                إرسال الإيصال الآن
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Final Action -->
                <div class="space-y-6">
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full brand-gradient text-white py-8 rounded-3xl font-black text-2xl shadow-2xl shadow-brand-500/40 transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-4 group">
                            لقد قمت بالتحويل - تأكيد الطلب
                            <i class="ph-bold ph-check-circle text-3xl group-hover:scale-110 transition-transform"></i>
                        </button>
                    </form>
                    
                    <div class="text-center">
                        <a href="{{ route('checkout.index') }}" class="text-xs font-black text-slate-400 hover:text-brand-500 transition-colors flex items-center justify-center gap-2 uppercase tracking-widest">
                            <i class="ph-bold ph-arrow-right"></i>
                            العودة لتعديل بيانات التواصل
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trust Note -->
        <div class="text-center space-y-2 opacity-60">
            <p class="text-xs font-bold text-slate-400">نحن نضمن حماية بياناتك وعملياتك المالية بأعلى معايير التشفير العالمي.</p>
            <div class="flex items-center justify-center gap-4 text-2xl text-slate-300">
                <i class="ph ph-shield-check"></i>
                <i class="ph ph-lock-key"></i>
                <i class="ph ph-certificate"></i>
            </div>
        </div>
    </div>
</div>
@endsection
