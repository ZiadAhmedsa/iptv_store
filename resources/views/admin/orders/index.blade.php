@extends('layouts.admin')

@php
    $themeColor = \App\Models\Setting::get('theme_color', '#6366f1');
@endphp


@section('title', 'إدارة الطلبات')
@section('subtitle', 'تتبع ومراجعة كافة العمليات التجارية والاشتراكات')

@section('content')
    <div class="space-y-8">
        <!-- Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bento-card p-8 group">
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">إجمالي الطلبات</p>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">{{ $totalOrders }}</h3>
                    <span class="text-xs font-bold text-slate-400">طلب</span>
                </div>
            </div>
            <div class="bento-card p-8 group border-emerald-500/10">
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">المكتملة</p>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-3xl font-black text-emerald-500 tracking-tight">{{ $completedCount }}</h3>
                    <span class="text-xs font-bold text-slate-400">طلب</span>
                </div>
            </div>
            <div class="bento-card p-8 group border-amber-500/10">
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">قيد الانتظار</p>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-3xl font-black text-amber-500 tracking-tight">{{ $pendingCount }}</h3>
                    <span class="text-xs font-bold text-slate-400">طلب</span>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="bento-card">
            <div class="px-8 py-6 border-b border-slate-100 dark:border-white/5 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-4 w-full md:w-auto">
                    <form action="{{ route('admin.orders.index') }}" method="GET" class="relative group w-full md:w-80">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="بحث في الطلبات..."
                            class="bento-input !h-11 !text-xs !px-11">
                        <i class="ph ph-magnifying-glass absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg group-focus-within:text-brand-500 transition-colors"></i>
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead>
                        <tr class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 dark:border-white/5">
                            <th class="px-8 py-5">الطلب</th>
                            <th class="px-8 py-5">العميل</th>
                            <th class="px-8 py-5">المبلغ</th>
                            <th class="px-8 py-5 text-center">الحالة</th>
                            <th class="px-8 py-5">التاريخ</th>
                            <th class="px-8 py-5 text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-white/5">
                        @forelse($orders as $order)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-white/[0.01] transition-colors group">
                                <td class="px-8 py-6">
                                    <p class="text-sm font-black text-slate-900 dark:text-white">#{{ $order->id }}</p>
                                    <p class="text-[9px] text-brand-500 font-black uppercase mt-1">Order Log</p>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-sm font-bold text-slate-900 dark:text-white leading-none">{{ $order->user->name }}</p>
                                    <p class="text-xs text-slate-400 font-bold mt-1.5">{{ $order->user->phone }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-sm font-black text-slate-900 dark:text-white">
                                        {{ number_format($order->total, 0) }} <span class="text-sm font-black text-slate-400 dark:text-slate-500 mr-1">⃁</span>
                                    </p>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @if($order->status == 'completed')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 text-xs font-black">مكتمل</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-amber-50 dark:bg-amber-500/10 text-amber-500 text-xs font-black">معلق</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-xs font-bold text-slate-400">{{ $order->created_at->format('Y/m/d') }}</p>
                                    <p class="text-xs text-slate-400 mt-1">{{ $order->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.orders.show', $order) }}"
                                            class="w-9 h-9 rounded-lg bg-slate-50 dark:bg-slate-800 text-slate-500 hover:bg-brand-500 hover:text-white transition-all flex items-center justify-center">
                                            <i class="ph ph-eye text-lg"></i>
                                        </a>
                                        @if($order->status != 'completed')
                                            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="delivery_status" value="completed">
                                                <button type="submit"
                                                    class="w-9 h-9 rounded-lg bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 hover:bg-emerald-500 hover:text-white transition-all flex items-center justify-center">
                                                    <i class="ph ph-check text-lg"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-20 text-center text-slate-400 text-sm font-bold italic">لا توجد طلبات مسجلة</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="px-8 py-6 border-t border-slate-50 dark:border-white/5">
                    {{ $orders->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection