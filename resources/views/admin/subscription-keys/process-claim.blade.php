@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-black text-slate-900 dark:text-white flex items-center gap-3">
            <i class="ph ph-gift text-brand-500"></i> معالجة طلب الاشتراك
        </h2>
        <a href="{{ route('admin.subscription-keys.claims') }}" class="text-slate-500 hover:text-brand-500 font-bold transition">العودة للطلبات</a>
    </div>

    <!-- Claim Info Card -->
    <div class="bento-card p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-4">
                <h3 class="text-sm font-black text-slate-500 uppercase tracking-widest">معلومات العميل</h3>
                <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/50">
                    <div class="w-12 h-12 rounded-full brand-gradient text-white flex items-center justify-center font-black text-xl shadow-lg">
                        {{ substr($claim->user->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-bold text-slate-900 dark:text-white">{{ $claim->user->name }}</div>
                        <div class="text-xs text-slate-500">{{ $claim->user->email }}</div>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-sm font-black text-slate-500 uppercase tracking-widest">تفاصيل الطلب</h3>
                <div class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">MAC Address:</span>
                        <span class="font-mono font-bold text-brand-500">{{ $claim->mac_address }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">تاريخ الطلب:</span>
                        <span class="font-bold text-slate-700 dark:text-slate-300">{{ $claim->claimed_at->format('Y-m-d H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activation Form -->
    <form action="{{ route('admin.subscription-keys.claims.finalize', $claim->id) }}" method="POST" class="bento-card p-10 space-y-8">
        @csrf

        <div class="space-y-6">
            <h3 class="text-xl font-black text-slate-900 dark:text-white">تخصيص بيانات الاشتراك</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <label class="block text-sm font-black text-slate-700 dark:text-slate-300">اختيار السيرفر / الخطة</label>
                    <select name="plan_id" class="bento-input appearance-none">
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}" {{ $claim->free_subscription_plan_id == $plan->id ? 'selected' : '' }}>
                                {{ $plan->title }} ({{ $plan->host }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-3">
                    <label class="block text-sm font-black text-slate-700 dark:text-slate-300">مدة التفعيل (بالأيام)</label>
                    <input type="number" name="days" value="30" class="w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-white/10 focus:border-brand-500 outline-none transition" placeholder="30">
                </div>
            </div>

            <div class="p-6 bg-brand-500/5 rounded-3xl border border-brand-500/10">
                <p class="text-sm text-brand-600 font-bold leading-relaxed">
                    <i class="ph ph-info mr-2"></i> عند حفظ التفعيل، سيتم إرسال بيانات الاشتراك (Host, User, Pass) تلقائياً إلى لوحة تحكم العميل في قسم "اشتراك مجاني".
                </p>
            </div>
        </div>

        <button type="submit" class="bento-button w-full flex items-center justify-center gap-3">
            حفظ وتفعيل الاشتراك للعميل <i class="ph ph-check-circle text-2xl"></i>
        </button>
    </form>
</div>
@endsection
