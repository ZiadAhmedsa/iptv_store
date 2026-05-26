@extends('layouts.admin')

@section('title', 'سجل طلبات الاشتراك')
@section('subtitle', 'إدارة طلبات تفعيل المفاتيح المجانية والنشاطات التلقائية باحترافية')

@section('content')
    <div class="space-y-8">
        <div class="bento-card overflow-hidden">
            <div class="px-10 py-8 border-b border-slate-100 dark:border-white/5 bg-slate-50/30 dark:bg-white/[0.01]">
                <div>
                    <h3 class="font-black text-2xl text-slate-900 dark:text-white tracking-tight">سجل الوصول والطلبات</h3>
                    <p class="text-xs text-slate-400 font-bold mt-1">يتم تسجيل المستخدمين بمجرد محاولة الوصول للخدمة</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-white/[0.01] text-slate-400 text-xs uppercase tracking-[0.2em] font-black">
                            <th class="px-10 py-6">المستخدم</th>
                            <th class="px-10 py-6">الخطة المطلوبة</th>
                            <th class="px-10 py-6 text-center">الحالة</th>
                            <th class="px-10 py-6">المعرف التقني</th>
                            <th class="px-10 py-6">التاريخ</th>
                            <th class="px-10 py-6 text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                        @forelse($claims as $claim)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-white/[0.01] transition-all group">
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl brand-gradient text-white flex items-center justify-center font-black text-lg shadow-lg group-hover:scale-110 transition-transform">
                                            {{ substr($claim->user->name ?? '?', 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-black text-slate-900 dark:text-white text-base mb-1 group-hover:text-brand-500 transition-colors">{{ $claim->user->name ?? 'مستخدم غير معروف' }}</div>
                                            <div class="text-xs text-slate-400 font-bold tracking-widest uppercase">{{ $claim->user->phone ?? '---' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <div class="flex flex-col gap-2">
                                        <span class="inline-flex items-center justify-center px-4 py-1.5 bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-400 rounded-xl text-xs font-black border border-slate-200 dark:border-white/5 uppercase tracking-widest">
                                            {{ $claim->plan->title ?? 'طلب اشتراك مجاني' }}
                                        </span>
                                        @if($claim->category_name)
                                            <span class="inline-flex items-center justify-center px-4 py-1.5 bg-brand-500/10 text-brand-500 rounded-xl text-xs font-black border border-brand-500/20 uppercase tracking-widest">
                                                الفئة: {{ $claim->category_name }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    <span class="status-badge {{ $claim->status === 'requested' ? 'bg-amber-500/10 text-amber-500 border-amber-500/20' : 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $claim->status === 'requested' ? 'bg-amber-500 shadow-[0_0_8px_rgba(245,158,11,0.6)]' : 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.6)]' }}"></span>
                                        {{ $claim->status === 'requested' ? 'طلب جديد' : 'مفعل' }}
                                    </span>
                                </td>
                                <td class="px-10 py-8">
                                    <code class="text-xs font-black text-slate-400 bg-slate-100 dark:bg-white/5 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-white/5 tracking-wider">{{ $claim->mac_address ?: 'No-MAC' }}</code>
                                </td>
                                <td class="px-10 py-8">
                                    <div class="text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-widest">{{ $claim->claimed_at->format('Y/m/d H:i') }}</div>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    @if($claim->status === 'requested')
                                        <form action="{{ route('admin.subscription-keys.claims.approve', $claim) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bento-button text-white h-10 px-6 rounded-xl font-black text-xs transition-all scale-100 hover:scale-105 active:scale-95 shadow-lg">تفعيل فوري</button>
                                        </form>
                                    @else
                                        <div class="flex items-center justify-center gap-2 text-emerald-500 text-xs font-black uppercase tracking-widest">
                                            <i class="ph ph-check-circle text-xl"></i> تم المعالجة
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-10 py-20 text-center text-slate-400 text-sm font-bold opacity-60 italic">لا توجد طلبات معلقة حالياً</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($claims->hasPages())
                <div class="px-10 py-6 border-t border-slate-100 dark:border-white/5 bg-slate-50/20 dark:bg-white/[0.01]">
                    {{ $claims->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
