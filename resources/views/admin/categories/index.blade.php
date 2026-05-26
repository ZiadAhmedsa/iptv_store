@extends('layouts.admin')

@php
    $themeColor = \App\Models\Setting::get('theme_color', '#6366f1');
@endphp


@section('title', 'الأقسام')
@section('subtitle', 'تنظيم تصنيفات المنتجات والخدمات')

@section('actions')
    <a href="{{ route('admin.categories.create') }}" class="bento-button !h-11 !text-xs">
        <i class="ph ph-plus-circle text-lg"></i> إضافة قسم جديد
    </a>
@endsection

@section('content')
    <div class="space-y-8">
        <div class="bento-card">
            <div class="px-8 py-6 border-b border-slate-100 dark:border-white/5 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white">هيكلية الأقسام</h3>
                    <p class="text-xs text-slate-400 font-bold mt-1">إجمالي التصنيفات: {{ $categories->count() }}</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead>
                        <tr class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 dark:border-white/5">
                            <th class="px-8 py-5">القسم</th>
                            <th class="px-8 py-5 text-center">الترتيب</th>
                            <th class="px-8 py-5 text-center">المنتجات</th>
                            <th class="px-8 py-5 text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-white/5">
                        @forelse($categories as $category)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-white/[0.01] transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-lg bg-brand-500/10 text-brand-500 flex items-center justify-center font-black text-sm">
                                            {{ mb_substr($category->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-brand-500 transition-colors">{{ $category->name }}</p>
                                            <p class="text-[9px] text-slate-400 font-bold uppercase mt-1">ID: #{{ $category->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="text-xs font-bold text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-white/5 px-3 py-1 rounded-md border border-slate-100 dark:border-white/5">
                                        {{ $category->sort_order ?? 0 }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 text-xs font-black">
                                        {{ $category->products_count ?? $category->products()->count() }} منتج
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="w-9 h-9 rounded-lg bg-slate-50 dark:bg-slate-800 text-slate-500 hover:bg-brand-500 hover:text-white transition-all flex items-center justify-center">
                                            <i class="ph ph-pencil-simple text-lg"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
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
                                <td colspan="4" class="px-8 py-20 text-center text-slate-400 text-sm font-bold italic">لا توجد أقسام مسجلة</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection