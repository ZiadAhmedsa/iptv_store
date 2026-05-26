@extends('layouts.admin')

@php
    $themeColor = $settings['theme_color'] ?? '#6366f1';
@endphp

@section('title', 'مركز التقارير')
@section('subtitle', 'تحليل استخباراتي دقيق لنشاط المتجر والمبيعات')

@section('actions')
    <button onclick="window.print()" class="bento-button !h-11 !text-xs !bg-slate-900 dark:!bg-white dark:!text-slate-900 !shadow-none">
        <i class="ph ph-file-pdf text-lg"></i> تصدير التقرير
    </button>
@endsection

@section('content')
    <div class="space-y-10">
        <!-- Stats Matrix -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bento-card p-8 group relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl group-hover:bg-emerald-500/20 transition-all duration-700"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center text-2xl shadow-inner group-hover:scale-110 transition-transform">
                        <i class="ph ph-chart-line-up font-black"></i>
                    </div>
                    <div class="mt-8">
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">إيرادات الشهر الحالي</p>
                        <div class="flex items-baseline gap-2">
                            <h3 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight leading-none">
                                {{ number_format($stats['monthly_sales'], 0) }}
                            </h3>
                            <span class="text-sm font-black text-emerald-500 mr-1">⃁</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bento-card p-8 group relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-500/10 rounded-full blur-3xl group-hover:bg-brand-500/20 transition-all duration-700"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center text-2xl shadow-inner group-hover:scale-110 transition-transform">
                        <i class="ph ph-shopping-bag-open font-black"></i>
                    </div>
                    <div class="mt-8">
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">الطلبات المكتملة</p>
                        <div class="flex items-baseline gap-2">
                            <h3 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight leading-none">
                                {{ $stats['completed_orders'] }}
                            </h3>
                            <span class="text-xs font-black text-brand-500 uppercase tracking-widest">معاملة</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bento-card p-8 group relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-amber-500/10 rounded-full blur-3xl group-hover:bg-amber-500/20 transition-all duration-700"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center text-2xl shadow-inner group-hover:scale-110 transition-transform">
                        <i class="ph ph-users-four font-black"></i>
                    </div>
                    <div class="mt-8">
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">العملاء الجدد</p>
                        <div class="flex items-baseline gap-2">
                            <h3 class="text-4xl font-black text-slate-900 dark:text-white tracking-tight leading-none">
                                {{ $stats['new_users'] }}
                            </h3>
                            <span class="text-xs font-black text-amber-500 uppercase tracking-widest">عضو</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Master Analytics Chart -->
        <div class="bento-card p-10 relative overflow-hidden">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-12 gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center shadow-inner">
                        <i class="ph ph-waveform text-2xl"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-slate-900 dark:text-white tracking-tight leading-none">مخطط التدفق المالي</h4>
                        <p class="text-xs text-slate-400 font-bold mt-1.5 uppercase tracking-widest">تحليل آخر 15 يوماً</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 px-5 py-2 bg-slate-50 dark:bg-white/[0.03] rounded-xl border border-slate-100 dark:border-white/5">
                    <span class="w-2.5 h-2.5 rounded-full bg-brand-500 animate-pulse"></span>
                    <span class="text-xs font-black text-slate-500 uppercase tracking-widest">الإيرادات اليومية</span>
                </div>
            </div>

            <div class="h-[400px] w-full">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-10">
            <!-- Strategic KPIs -->
            <div class="bento-card p-10">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-12 h-12 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center shadow-inner">
                        <i class="ph ph-target text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-black text-slate-900 dark:text-white tracking-tight">مؤشرات الأداء (KPIs)</h4>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="p-8 bg-slate-50 dark:bg-white/[0.02] rounded-[1.5rem] border border-slate-100 dark:border-white/5">
                        <p class="text-xs text-slate-400 font-black uppercase tracking-widest mb-4">متوسط قيمة الطلب</p>
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">{{ number_format($stats['average_order_value'], 2) }}</span>
                            <span class="text-sm font-black text-brand-500 mr-1">⃁</span>
                        </div>
                    </div>

                    <div class="p-8 bg-slate-50 dark:bg-white/[0.02] rounded-[1.5rem] border border-slate-100 dark:border-white/5">
                        <p class="text-xs text-slate-400 font-black uppercase tracking-widest mb-4">الطلبات المعلقة</p>
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl font-black text-amber-500 tracking-tight">{{ $stats['pending_orders'] }}</span>
                            <span class="text-xs font-black text-slate-400 uppercase tracking-widest">معاملة</span>
                        </div>
                    </div>
                </div>

                <div class="mt-8 p-8 bg-brand-500/5 rounded-[1.5rem] border border-brand-500/10 flex items-center gap-6 group hover:bg-brand-500/10 transition-all cursor-pointer">
                    <div class="w-16 h-16 rounded-xl bg-brand-500 text-white flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform">
                        <i class="ph ph-trend-up text-3xl font-black"></i>
                    </div>
                    <div>
                        <p class="text-lg font-black text-slate-900 dark:text-white tracking-tight">توقعات النمو</p>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 font-bold leading-relaxed">بناءً على النشاط الحالي، نتوقع نمو المبيعات بنسبة 18% قريباً</p>
                    </div>
                </div>
            </div>

            <!-- Top Categories -->
            <div class="bento-card p-10">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-12 h-12 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center shadow-inner">
                        <i class="ph ph-crown-simple text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-black text-slate-900 dark:text-white tracking-tight">الأقسام الأعلى طلباً</h4>
                </div>

                <div class="space-y-4">
                    @foreach($stats['top_categories'] as $category)
                        <div class="flex items-center justify-between p-6 bg-slate-50 dark:bg-white/[0.02] rounded-2xl border border-slate-100 dark:border-white/5 group hover:border-brand-500/30 transition-all cursor-pointer">
                            <div class="flex items-center gap-5">
                                <div class="w-10 h-10 rounded-lg bg-white dark:bg-slate-800 border border-slate-100 dark:border-white/10 flex items-center justify-center font-black text-brand-500 text-sm shadow-sm group-hover:scale-110 transition-transform">
                                    {{ $loop->iteration }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900 dark:text-white group-hover:text-brand-500 transition-colors">{{ $category->name }}</p>
                                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-0.5">
                                        {{ $category->products_count ?? $category->products()->count() }} منتج نشط
                                    </p>
                                </div>
                            </div>
                            <i class="ph ph-caret-left text-slate-300 group-hover:text-brand-500 transition-all"></i>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('salesChart').getContext('2d');
                const rawData = @json($stats['daily_sales_data']);
                const isDark = document.documentElement.classList.contains('dark');

                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, '{{ $themeColor }}66');
                gradient.addColorStop(1, '{{ $themeColor }}00');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: rawData.map(d => d.date),
                        datasets: [{
                            label: 'إيرادات المبيعات',
                            data: rawData.map(d => d.total),
                            borderColor: '{{ $themeColor }}',
                            backgroundColor: gradient,
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointRadius: 0,
                            pointHoverRadius: 6,
                            pointHoverBackgroundColor: '{{ $themeColor }}',
                            pointHoverBorderColor: '#ffffff',
                            pointHoverBorderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: isDark ? '#1e293b' : '#ffffff',
                                titleColor: isDark ? '#ffffff' : '#0f172a',
                                bodyColor: isDark ? '#94a3b8' : '#64748b',
                                titleFont: { size: 12, family: 'Cairo', weight: 'bold' },
                                bodyFont: { size: 12, family: 'Cairo' },
                                padding: 12,
                                cornerRadius: 12,
                                displayColors: false,
                                borderColor: isDark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.05)',
                                borderWidth: 1,
                                callbacks: {
                                    label: function(context) {
                                        return context.parsed.y.toLocaleString() + ' ⃁';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: isDark ? 'rgba(255, 255, 255, 0.03)' : 'rgba(0, 0, 0, 0.02)', drawBorder: false },
                                ticks: {
                                    color: '#94a3b8',
                                    font: { family: 'Cairo', size: 10 },
                                    padding: 10,
                                    callback: function(value) { return value.toLocaleString(); }
                                }
                            },
                            x: {
                                grid: { display: false },
                                ticks: {
                                    color: '#94a3b8',
                                    font: { family: 'Cairo', size: 10 },
                                    padding: 10
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection