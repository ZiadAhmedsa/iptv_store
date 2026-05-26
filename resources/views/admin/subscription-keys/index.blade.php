@extends('layouts.admin')

@section('title', 'مفاتيح الاشتراك')
@section('subtitle', 'إدارة وتخصيص اشتراكات IPTV للعملاء')

@section('actions')
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.subscription-keys.expiring') }}" class="bento-button !h-11 !text-xs !bg-red-500 !shadow-red-500/20">
            <i class="ph ph-warning-circle text-lg"></i> مقاربة على الانتهاء
            @php
                $twoWeeksFromNow = now()->addDays(14);
                $expiringCount = \App\Models\UserFreeSubscription::whereNotNull('expires_at')
                    ->where('expires_at', '>', now())
                    ->where('expires_at', '<=', $twoWeeksFromNow)
                    ->where('status', 'active')
                    ->count();
            @endphp
            @if($expiringCount > 0)
                <span class="bg-white text-red-600 text-[9px] px-1.5 py-0.5 rounded-full font-black animate-pulse">{{ $expiringCount }}</span>
            @endif
        </a>
        <a href="{{ route('admin.subscription-keys.claims') }}" class="bento-button !h-11 !text-xs !bg-amber-500 !shadow-amber-500/20">
            <i class="ph ph-hand-pointing text-lg"></i> طلبات التفعيل
            @php
                $pendingCount = \App\Models\UserFreeSubscription::where('status', 'requested')->count();
            @endphp
            @if($pendingCount > 0)
                <span class="bg-white text-amber-600 text-[9px] px-1.5 py-0.5 rounded-full font-black animate-pulse">{{ $pendingCount }}</span>
            @endif
        </a>
    </div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Creation Sidebar -->
    <div class="lg:col-span-4">
        <div class="bento-card p-8 lg:sticky lg:top-8">
            <h3 class="text-lg font-black text-slate-900 dark:text-white mb-8 flex items-center gap-3">
                <i class="ph ph-plus-circle text-brand-500 text-xl"></i> إصدار جديد
            </h3>

            <form action="{{ route('admin.subscription-keys.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">عنوان الاشتراك</label>
                    <input type="text" name="title" placeholder="مثلاً: باقة VIP" required class="bento-input !h-11 !text-xs">
                </div>

                <div class="space-y-4 p-4 bg-slate-50 dark:bg-white/[0.02] rounded-xl border border-slate-100 dark:border-white/5">
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">السيرفر (Host)</label>
                        <input type="text" name="host" placeholder="http://domain.com:8080" required class="bento-input !h-9 !text-xs !font-mono">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">المستخدم</label>
                            <input type="text" name="username" required class="bento-input !h-9 !text-xs !font-mono">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">كلمة السر</label>
                            <input type="text" name="password" required class="bento-input !h-9 !text-xs !font-mono">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">مدة الاشتراك (بالأيام)</label>
                            <input type="number" name="duration_days" placeholder="مثال: 365 (سنة)" class="bento-input !h-9 !text-xs">
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">ملاحظات (تظهر للعميل)</label>
                    <textarea name="description" placeholder="ملاحظات أو تفاصيل إضافية..." rows="2" class="bento-input !text-xs">{{ old('description') }}</textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">بريد العميل</label>
                    <input name="assigned_email" type="email" list="userEmails" value="{{ request('email') ?? old('assigned_email') }}" required placeholder="customer@email.com" class="bento-input !h-11 !text-xs">
                    <datalist id="userEmails">
                        @foreach($userEmails as $email)
                            <option value="{{ $email }}">{{ $email }}</option>
                        @endforeach
                    </datalist>
                </div>

                <div class="flex items-center gap-3 px-1">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked class="w-4 h-4 rounded border-slate-300 text-brand-500 focus:ring-brand-500">
                    <label for="is_active" class="text-xs font-bold text-slate-500">تفعيل فوري</label>
                </div>

                <button type="submit" class="bento-button !w-full !h-12 !text-xs">
                    <i class="ph ph-lightning text-lg"></i> إنشاء وتفعيل
                </button>
            </form>
        </div>
    </div>

    <!-- Main List -->
    <div class="lg:col-span-8">
        <div class="bento-card overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 dark:border-white/5 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white">الاشتراكات الصادرة</h3>
                    <p class="text-xs text-slate-400 font-bold mt-1">إجمالي النشط: {{ $plans->where('is_active', true)->count() }}</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead>
                        <tr class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 dark:border-white/5">
                            <th class="px-8 py-5">الاشتراك</th>
                            <th class="px-8 py-5">بيانات السيرفر</th>
                            <th class="px-8 py-5 text-center">المدة والانتهاء</th>
                            <th class="px-8 py-5 text-center">الحالة</th>
                            <th class="px-8 py-5 text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-white/5">
                        @forelse($plans as $plan)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-white/[0.01] transition-colors group">
                                <td class="px-8 py-6">
                                    <p class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-brand-500 transition-colors">{{ $plan->title }}</p>
                                    <p class="text-xs text-slate-400 font-bold mt-1">{{ $plan->assigned_email }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-xs font-mono text-slate-500 truncate max-w-[180px]">{{ $plan->host }}</p>
                                    <p class="text-xs text-brand-500 font-mono mt-1">User: {{ $plan->username }}</p>
                                </td>
                                @php
                                    $subscription = \App\Models\UserFreeSubscription::where('free_subscription_plan_id', $plan->id)->latest()->first();
                                    $isExpiringSoon = $subscription && $subscription->expires_at && $subscription->expires_at->isFuture() && $subscription->expires_at->diffInDays(now()) <= 7;
                                    $isExpired = $subscription && $subscription->expires_at && $subscription->expires_at->isPast();
                                @endphp
                                <td class="px-8 py-6 text-center">
                                    <p class="text-xs font-bold text-slate-500 mb-1">
                                        {{ $plan->duration_days ? $plan->duration_days . ' يوم' : 'غير محدد' }}
                                    </p>
                                    @if($subscription && $subscription->expires_at)
                                        <p class="text-[9px] font-black {{ $isExpired ? 'text-red-500' : ($isExpiringSoon ? 'text-amber-500' : 'text-emerald-500') }} uppercase tracking-widest">
                                            {{ $subscription->expires_at->format('Y-m-d') }}
                                        </p>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @if($isExpired)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-red-50 dark:bg-red-500/10 text-red-500 text-xs font-black">منتهي</span>
                                    @elseif($plan->is_active)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 text-xs font-black">نشط</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-slate-50 dark:bg-white/5 text-slate-400 text-xs font-black">معطل</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <div class="flex justify-center gap-2">
                                        @if($isExpiringSoon)
                                            <form action="{{ route('admin.subscription-keys.alert', $plan->id) }}" method="POST" title="إرسال تنبيه بالبريد لاقتراب الانتهاء">
                                                @csrf
                                                <button type="submit" class="w-9 h-9 rounded-lg bg-amber-50 dark:bg-amber-500/10 text-amber-500 hover:bg-amber-500 hover:text-white transition-all flex items-center justify-center animate-pulse">
                                                    <i class="ph ph-envelope-simple text-lg"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.subscription-keys.edit', $plan->id) }}" class="w-9 h-9 rounded-lg bg-slate-50 dark:bg-slate-800 text-slate-500 hover:bg-brand-500 hover:text-white transition-all flex items-center justify-center">
                                            <i class="ph ph-pencil-simple text-lg"></i>
                                        </a>
                                        <form action="{{ route('admin.subscription-keys.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد؟')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-9 h-9 rounded-lg bg-slate-50 dark:bg-slate-800 text-slate-500 hover:bg-red-500 hover:text-white transition-all flex items-center justify-center">
                                                <i class="ph ph-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
@empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center text-slate-400 text-sm font-bold italic">لا توجد بيانات مسجلة</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($plans->hasPages())
                <div class="px-8 py-6 border-t border-slate-50 dark:border-white/5">
                    {{ $plans->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
