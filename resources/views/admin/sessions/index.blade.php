@extends('layouts.admin')

@section('title', 'سجلات الوصول')
@section('subtitle', 'مراقبة محاولات الدخول والعمليات الأمنية')

@section('actions')
    <div class="px-6 py-3 bg-brand-500/10 text-brand-500 rounded-xl border border-brand-500/10 flex items-center gap-4">
        <div>
            <p class="text-[9px] font-black uppercase tracking-widest leading-none mb-1 opacity-60">نشاط اليوم</p>
            <p class="text-lg font-black leading-none">{{ $sessions->where('created_at', '>=', now()->startOfDay())->count() }}</p>
        </div>
        <div class="w-px h-8 bg-brand-500/20"></div>
        <i class="ph ph-shield-check text-2xl animate-pulse"></i>
    </div>
@endsection

@section('content')
    <div class="space-y-8">
        <div class="bento-card overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 dark:border-white/5 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-slate-50/50 dark:bg-white/[0.01]">
                <div>
                    <h3 class="text-sm font-black text-slate-900 dark:text-white flex items-center gap-3">
                        <i class="ph ph-fingerprint text-lg text-brand-500"></i>
                        مركز المراقبة الأمنية
                    </h3>
                    <p class="text-xs text-slate-400 font-bold mt-1 uppercase tracking-widest">تحليل عمليات الدخول والوصول</p>
                </div>
                
                <form action="{{ route('admin.session-logs.index') }}" method="GET" class="relative group w-full md:w-80">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="بحث بالاسم أو IP..." class="bento-input !h-11 !pr-10 !text-xs">
                    <i class="ph ph-magnifying-glass absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg group-focus-within:text-brand-500 transition-colors"></i>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 dark:border-white/5">
                            <th class="px-8 py-5">المستخدم</th>
                            <th class="px-8 py-5">العنوان الرقمي (IP)</th>
                            <th class="px-8 py-5">الجهاز</th>
                            <th class="px-8 py-5 text-center">الحالة</th>
                            <th class="px-8 py-5">التوقيت</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-white/5">
                        @forelse($sessions as $log)
                            <tr class="hover:bg-slate-50/30 dark:hover:bg-white/[0.01] transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 flex items-center justify-center text-xl">
                                            <i class="ph ph-user"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-brand-500 transition-colors">{{ $log->user->name ?? 'زائر مجهول' }}</p>
                                            <p class="text-xs text-slate-400 font-bold truncate max-w-[150px]">{{ $log->user->email ?? 'Visitor Access' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-50 dark:bg-white/5 text-slate-500 dark:text-slate-400 text-xs font-black font-mono border border-slate-100 dark:border-white/5">
                                        {{ $log->ip_address }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="max-w-[200px] truncate text-xs font-bold text-slate-400" title="{{ $log->user_agent }}">
                                        {{ $log->user_agent }}
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @if($log->status == 'success')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 text-xs font-black">ناجح</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-red-50 dark:bg-red-500/10 text-red-500 text-xs font-black">فاشل</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $log->created_at->format('Y/m/d') }}</p>
                                    <p class="text-xs text-slate-400 font-bold uppercase">{{ $log->created_at->format('H:i:s') }} - {{ $log->created_at->diffForHumans() }}</p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center text-slate-400 text-sm font-bold italic italic">لا توجد سجلات وصول</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($sessions->hasPages())
                <div class="px-8 py-6 border-t border-slate-50 dark:border-white/5">
                    {{ $sessions->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection