@extends('layouts.app')

@php
    $siteName = \App\Models\Setting::get('site_name', 'World Cup 4K Store');
@endphp

@section('meta_title', 'اشتراك IPTV مجاني - تجربة 4K بدون تقطيع | ' . $siteName)
@section('meta_keywords', 'تجربة iptv مجانية, 4k iptv free trial 24 hours, افضل اشتراك iptv رخيص')

@section('content')

<!-- TOAST SYSTEM -->
<div id="toast"
     class="fixed top-6 right-6 z-50 hidden px-6 py-4 rounded-2xl shadow-2xl text-white font-bold backdrop-blur-xl transition-all duration-300">
</div>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 px-4 py-20">

    <div class="w-full max-w-[1920px] mx-auto sm:px-6 lg:px-12 2xl:px-24 space-y-16">

        <!-- HEADER -->
        <div class="text-center space-y-5">
            <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-indigo-500/10 text-indigo-500 text-xs font-bold tracking-widest uppercase shadow-md">
                <i class="ph ph-gift text-lg"></i>
                Free Premium Access
            </div>

            <h1 class="text-5xl md:text-7xl font-black text-slate-900 dark:text-white tracking-tight">
                الاشتراكات <span class="text-indigo-500">المجانية</span>
            </h1>

            <p class="text-slate-500 text-lg max-w-2xl mx-auto">
                تجربة فاخرة للحصول على اشتراكك المجاني مع نظام حديث وسريع.
            </p>
        </div>

        @guest

        <!-- GUEST -->
        <div class="glass-card">
            <i class="ph ph-lock-key text-6xl text-indigo-500 animate-pulse"></i>

            <h2 class="text-3xl font-black mt-6 text-slate-900 dark:text-white">
                الوصول مقيد
            </h2>

            <p class="text-slate-500 mt-3">
                يجب تسجيل الدخول أولاً
            </p>

            <a href="{{ route('login') }}"
               class="mt-8 inline-flex px-10 py-4 rounded-2xl bg-indigo-600 text-white font-bold shadow-lg hover:shadow-indigo-500/40 hover:scale-105 transition-all duration-300">
                تسجيل الدخول
            </a>
        </div>

        @else

        @if($userSubscriptions->count() > 0)
            <div class="space-y-8">
            @foreach($userSubscriptions as $sub)
                @if($sub->status == 'active' && (!$sub->expires_at || $sub->expires_at->isFuture()))
                <!-- ACTIVE -->
                <div class="relative overflow-hidden rounded-[3rem] bg-slate-900 border border-white/10 shadow-[0_0_80px_rgba(99,102,241,0.15)] p-8 md:p-12">
                    <div class="absolute -top-32 -right-32 w-96 h-96 bg-indigo-500/20 blur-[100px] rounded-full pointer-events-none"></div>
                    <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-purple-500/10 blur-[100px] rounded-full pointer-events-none"></div>
                    
                    <div class="relative z-10 space-y-12">
                        <!-- STATUS HEADER -->
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 border-b border-white/10 pb-8">
                            <div class="flex items-center gap-5">
                                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/30">
                                    <i class="ph-bold ph-crown text-3xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-3xl md:text-4xl font-black text-white tracking-tight">
                                        {{ $sub->plan->title ?? 'باقة مجانية مميزة' }}
                                    </h2>
                                    <p class="text-indigo-400 font-bold mt-1">اشتراكك يعمل الآن بنجاح</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-black tracking-widest uppercase text-sm shadow-inner">
                                <span class="relative flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                                </span>
                                نشط (Active)
                            </div>
                        </div>

                        @if($sub->plan && $sub->plan->description)
                            <div class="relative overflow-hidden bg-indigo-500/10 border border-indigo-500/20 rounded-3xl p-6 md:p-8">
                                <div class="absolute top-0 left-0 w-2 h-full bg-indigo-500"></div>
                                <h4 class="text-white font-black mb-3 flex items-center gap-2 text-lg"><i class="ph-fill ph-info text-indigo-400 text-2xl"></i> ملاحظة هامة جداً:</h4>
                                <p class="text-indigo-200/80 font-bold leading-relaxed">{{ $sub->plan->description }}</p>
                            </div>
                        @endif

                        <div class="grid md:grid-cols-5 gap-8">
                            <div class="md:col-span-3 space-y-6">
                                <h3 class="text-xs font-black text-slate-500 uppercase tracking-[0.3em] flex items-center gap-2">
                                    <i class="ph-fill ph-key"></i> بيانات الدخول للسيرفر
                                </h3>
                                <div class="space-y-4">
                                    @foreach([
                                        'رابط الخادم (Host)' => $sub->plan->host ?? '---',
                                        'اسم المستخدم (User)' => $sub->plan->username ?? '---',
                                        'كلمة المرور (Pass)' => $sub->plan->password ?? '---'
                                    ] as $label => $value)
                                        <div class="group relative bg-white/5 border border-white/10 rounded-2xl p-4 md:p-5 flex flex-col md:flex-row md:items-center justify-between gap-4 hover:bg-white/10 hover:border-indigo-500/50 transition-all duration-300">
                                            <span class="text-slate-400 font-bold text-sm">{{ $label }}</span>
                                            <div class="flex items-center justify-between md:justify-end gap-4 w-full md:w-auto">
                                                <span class="font-mono text-white font-black text-lg truncate max-w-[200px] md:max-w-xs">{{ $value }}</span>
                                                <button onclick="copyText('{{ $value }}')" class="w-12 h-12 rounded-xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center hover:bg-indigo-500 hover:text-white transition-all duration-300 hover:scale-110 hover:-rotate-6 focus:scale-95 group-hover:shadow-[0_0_20px_rgba(99,102,241,0.4)]">
                                                    <i class="ph-bold ph-copy text-xl"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="md:col-span-2 space-y-6">
                                <h3 class="text-xs font-black text-slate-500 uppercase tracking-[0.3em] flex items-center gap-2">
                                    <i class="ph-fill ph-info"></i> معلومات الاشتراك
                                </h3>
                                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 space-y-6 h-[calc(100%-2.5rem)]">
                                    <div class="space-y-2">
                                        <span class="text-slate-400 font-bold text-xs uppercase tracking-widest">تاريخ الإنتهاء</span>
                                        <div class="flex items-center gap-3 text-white font-black text-xl">
                                            <i class="ph-duotone ph-calendar-blank text-indigo-400 text-3xl"></i>
                                            {{ optional($sub->expires_at)->format('Y-m-d') ?? 'مفتوح (Unlimited)' }}
                                        </div>
                                    </div>
                                    @if($sub->plan && $sub->plan->duration_days)
                                    <div class="space-y-2">
                                        <span class="text-slate-400 font-bold text-xs uppercase tracking-widest">مدة الاشتراك</span>
                                        <div class="flex items-center gap-3 text-white font-black text-xl">
                                            <i class="ph-duotone ph-clock text-indigo-400 text-3xl"></i>
                                            {{ $sub->plan->duration_days }} يوم
                                        </div>
                                    </div>
                                    @endif

                                    @php
                                        $daysRemaining = null;
                                        if($sub->expires_at && $sub->expires_at->isFuture()) {
                                            $daysRemaining = round(now()->floatDiffInDays($sub->expires_at));
                                        }
                                    @endphp

                                    @if($daysRemaining !== null)
                                    <div class="space-y-2">
                                        <span class="text-slate-400 font-bold text-xs uppercase tracking-widest">الوقت المتبقي</span>
                                        <div class="flex items-center gap-3 text-emerald-400 font-black text-xl">
                                            <i class="ph-duotone ph-hourglass-high text-3xl"></i>
                                            متبقي {{ $daysRemaining }} يوم
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="pt-8 text-center mt-12 border-t border-white/10">
                            <a href="{{ route('how-to-run') }}" class="inline-flex items-center justify-center gap-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-400 hover:to-teal-500 text-white px-10 py-5 rounded-2xl font-black text-lg transition-all duration-300 shadow-[0_0_40px_rgba(16,185,129,0.3)] hover:shadow-[0_0_60px_rgba(16,185,129,0.5)] hover:scale-105">
                                <i class="ph-fill ph-play-circle text-3xl"></i> طريقة تشغيل الاشتراك خطوة بخطوة
                            </a>
                        </div>
                    </div>
                </div>
                @elseif($sub->status == 'requested')
                <!-- REQUESTED PENDING -->
                <div class="glass-card text-center space-y-8 bg-amber-500/5 border-amber-500/20">
                    <i class="ph-duotone ph-hourglass-high text-6xl text-amber-500 animate-spin-slow"></i>
                    <h2 class="text-3xl font-black text-white">طلب قيد المراجعة</h2>
                    <p class="text-amber-200/80 text-lg">طلبك للاشتراك المجاني ({{ $sub->category_name }}) قيد المراجعة من قبل الإدارة. سيتم تفعيله قريباً.</p>
                </div>
                @elseif($sub->status == 'expired' || ($sub->expires_at && $sub->expires_at->isPast()))
                <!-- EXPIRED -->
                <div class="glass-card text-center space-y-8 bg-red-500/5 border-red-500/20 opacity-80">
                    <i class="ph-duotone ph-warning-circle text-6xl text-red-500"></i>
                    <h2 class="text-3xl font-black text-white">الاشتراك منتهي</h2>
                    <p class="text-red-200/80 text-lg">انتهت صلاحية اشتراكك المجاني ({{ $sub->plan->title ?? $sub->category_name }}). يمكنك طلب اشتراك جديد بعد مرور شهر من تاريخ طلبك السابق.</p>
                </div>
                @endif
            @endforeach
            </div>
        @endif

        @if($canClaim || $userSubscriptions->count() == 0)
        <!-- REQUEST -->
        <div class="glass-card text-center space-y-8 mt-12">

            <h2 class="text-4xl font-black text-white">
                طلب اشتراك مجاني
            </h2>

            <p class="text-slate-400">
                اضغط للحصول على اشتراك مجاني يتم تفعيله لاحقاً
            </p>

            @if($canClaim)

                <form method="POST" action="{{ route('free-subscriptions.claim') }}" onsubmit="showToast('تم إرسال الطلب بنجاح 🚀','success')" class="space-y-6">
                    @csrf
                    <input type="hidden" name="mac_address" value="{{ $macAddress }}">

                    <div class="max-w-xl mx-auto text-right">
                        <label class="block text-slate-300 font-bold mb-4 text-center">اختر فئة الاشتراك المطلوبة:</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($categories ?? [] as $cat)
                                <label class="cursor-pointer relative group block aspect-[4/5] rounded-[2rem] overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                                    <input type="radio" name="category_name" value="{{ $cat->name_ar }}" class="peer sr-only" required>
                                    
                                    <!-- Background Image -->
                                    @if($cat->image)
                                        <img src="{{ asset($cat->image) }}" alt="{{ $cat->name_ar }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 peer-checked:scale-110">
                                    @else
                                        <div class="absolute inset-0 bg-slate-800 flex items-center justify-center transition-transform duration-700 group-hover:scale-110 peer-checked:scale-110">
                                            <i class="ph-duotone ph-folders text-[5rem] text-slate-600"></i>
                                        </div>
                                    @endif

                                    <!-- Dark Gradient Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/95 via-slate-900/40 to-transparent z-10 transition-colors peer-checked:from-indigo-900/90 peer-checked:via-indigo-900/40"></div>

                                    <!-- Border / Selected Indicator -->
                                    <div class="absolute inset-0 rounded-[2rem] border-2 border-transparent peer-checked:border-indigo-500 z-20 transition-all"></div>
                                    <div class="absolute top-4 right-4 opacity-0 peer-checked:opacity-100 bg-indigo-500 text-white rounded-full flex items-center justify-center p-1 shadow-lg transform scale-50 peer-checked:scale-100 transition-all z-30">
                                        <i class="ph-fill ph-check-circle text-xl"></i>
                                    </div>

                                    <!-- Content -->
                                    <div class="absolute inset-0 p-6 flex flex-col justify-end z-20 text-center">
                                        <h3 class="text-xl md:text-2xl font-black text-white group-hover:text-indigo-400 peer-checked:text-indigo-300 transition-colors drop-shadow-md">
                                            {{ $cat->name_ar }}
                                        </h3>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <button class="main-btn">
                        إرسال الطلب
                    </button>
                </form>

            @endif
        </div>
        @elseif(!$canClaim && $userSubscriptions->count() > 0)
            <!-- CANNOT CLAIM YET -->
            <div class="warning-box mt-12 text-center">
                لقد قمت بطلب اشتراك مجاني مؤخراً. يمكنك الطلب مرة أخرى بتاريخ {{ $nextClaimAt?->format('Y-m-d') }}
            </div>
        @endif

        @endguest

    </div>
</div>

<!-- STYLE -->
<style>
.glass-card{
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(25px);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 2.5rem;
    padding: 3rem;
    box-shadow: 0 30px 80px rgba(0,0,0,0.3);
    transition: all 0.4s ease;
}
.glass-card:hover{
    transform: translateY(-6px);
    box-shadow: 0 40px 120px rgba(99,102,241,0.25);
}

.section-title{
    color: #cbd5e1;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    font-size: 12px;
}

.info-box{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding: 1.2rem;
    border-radius: 1.2rem;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.06);
    transition: all 0.3s ease;
}
.info-box:hover{
    transform: scale(1.02);
    border-color: rgba(99,102,241,0.5);
}

.copy-btn{
    padding: 0.5rem 0.8rem;
    border-radius: 0.8rem;
    background: rgba(99,102,241,0.15);
    color: #818cf8;
    transition: 0.3s;
}
.copy-btn:hover{
    background:#6366f1;
    color:white;
    transform: rotate(10deg);
}

.status-badge{
    display:flex;
    align-items:center;
    gap:8px;
    padding: 0.6rem 1.2rem;
    border-radius: 999px;
    background: rgba(34,197,94,0.1);
    color: #22c55e;
    font-weight: 900;
}
.status-badge .dot{
    width:8px;height:8px;
    background:#22c55e;
    border-radius:50%;
    animation:pulse 1.5s infinite;
}

@keyframes pulse{
    0%{transform:scale(1);opacity:1}
    50%{transform:scale(1.6);opacity:0.5}
    100%{transform:scale(1);opacity:1}
}

.main-btn{
    padding: 1rem 3rem;
    border-radius: 1.5rem;
    background: linear-gradient(135deg,#6366f1,#8b5cf6);
    color:white;
    font-weight:900;
    box-shadow:0 20px 60px rgba(99,102,241,0.4);
    transition: all 0.3s ease;
}
.main-btn:hover{
    transform: scale(1.05);
}

.warning-box{
    background: rgba(245,158,11,0.1);
    border:1px solid rgba(245,158,11,0.3);
    padding:1rem;
    border-radius:1rem;
    color:#fbbf24;
    font-weight:700;
}
</style>

<!-- SCRIPT -->
<script>
function showToast(message,type='info'){
    const toast=document.getElementById('toast');

    toast.innerText=message;
    toast.classList.remove('hidden');

    toast.style.background =
        type==='success' ? '#22c55e' :
        type==='error' ? '#ef4444' :
        '#6366f1';

    setTimeout(()=>{
        toast.classList.add('hidden');
    },2500);
}

function copyText(text){
    navigator.clipboard.writeText(text);
    showToast('تم النسخ 📋','success');
}
</script>

@endsection