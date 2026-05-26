@extends('layouts.admin')

@php
    $themeColor = \App\Models\Setting::get('theme_color', '#6366f1');
@endphp


@section('title', 'أدلة التشغيل')
@section('subtitle', 'إدارة شروحات الأجهزة وطرق التفعيل')

@section('actions')
    <a href="{{ route('admin.guides.create') }}" class="bento-button !h-11 !text-xs">
        <i class="ph ph-plus-circle text-lg"></i> إضافة دليل جديد
    </a>
@endsection

@section('content')
    <div class="space-y-8">
        <div class="bento-card overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 dark:border-white/5 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white">الأدلة التعليمية</h3>
                    <p class="text-xs text-slate-400 font-bold mt-1">إدارة المحتوى المساعد للعملاء</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead>
                        <tr class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 dark:border-white/5">
                            <th class="px-8 py-5">الأيقونة</th>
                            <th class="px-8 py-5">العنوان</th>
                            <th class="px-8 py-5">الفئة</th>
                            <th class="px-8 py-5 text-center">المراحل</th>
                            <th class="px-8 py-5 text-center">الحالة</th>
                            <th class="px-8 py-5 text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-white/5">
                        @forelse($guides as $guide)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-white/[0.01] transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="w-12 h-12 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center text-2xl font-black border border-brand-500/10">
                                        <i class="ph {{ $guide->icon ?? 'ph-book-open' }}"></i>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-brand-500 transition-colors">{{ $guide->title }}</p>
                                    <p class="text-xs text-slate-400 font-bold mt-1">تحديث: {{ $guide->updated_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    @if($guide->category)
                                        <span class="inline-flex items-center px-2 py-1 rounded border border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-300 text-xs font-bold">
                                            {{ $guide->category }}
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-brand-50 dark:bg-brand-500/10 text-brand-500 text-xs font-black">
                                        {{ $guide->steps_count ?? $guide->steps()->count() }} مراحل
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @if($guide->is_active)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 text-xs font-black">نشط</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-slate-50 dark:bg-white/5 text-slate-400 text-xs font-black">مخفي</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.guides.edit', $guide->id) }}" class="w-9 h-9 rounded-lg bg-slate-50 dark:bg-slate-800 text-slate-500 hover:bg-brand-500 hover:text-white transition-all flex items-center justify-center">
                                            <i class="ph ph-pencil-simple text-lg"></i>
                                        </a>
                                        <form action="{{ route('admin.guides.destroy', $guide->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
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
                                <td colspan="6" class="px-8 py-20 text-center text-slate-400 text-sm font-bold italic">لا توجد أدلة مسجلة</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection