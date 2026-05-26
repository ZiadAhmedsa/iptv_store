@extends('layouts.admin')

@php
    $themeColor = \App\Models\Setting::get('theme_color', '#6366f1');
@endphp


@section('title', 'المنتجات')
@section('subtitle', 'إدارة قائمة الخدمات والاشتراكات المتوفرة')

@section('actions')
    <a href="{{ route('admin.products.create') }}" class="bento-button !h-11 !text-xs">
        <i class="ph ph-plus-circle text-lg"></i> إضافة منتج جديد
    </a>
@endsection

@section('content')
    <div class="space-y-8">
        <div class="bento-card">
            <div class="px-8 py-6 border-b border-slate-100 dark:border-white/5 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white">قائمة المنتجات</h3>
                    <p class="text-xs text-slate-400 font-bold mt-1">إجمالي المتاح: {{ $products->total() }}</p>
                </div>
                
                <form action="{{ route('admin.products.index') }}" method="GET" class="relative group w-full md:w-80">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="بحث عن منتج..."
                        class="bento-input !h-11 !text-xs !px-11">
                    <i class="ph ph-magnifying-glass absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg group-focus-within:text-brand-500 transition-colors"></i>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead>
                        <tr class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 dark:border-white/5">
                            <th class="px-8 py-5">المنتج</th>
                            <th class="px-8 py-5">القسم</th>
                            <th class="px-8 py-5">السعر</th>
                            <th class="px-8 py-5 text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-white/5">
                        @forelse($products as $product)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-white/[0.01] transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 rounded-xl bg-slate-50 dark:bg-slate-800 overflow-hidden border border-slate-100 dark:border-white/5">
                                            @php 
                                                $primaryImage = $product->images->where('is_primary', true)->first(); 
                                                $imagePath = $primaryImage ? $primaryImage->image_url : ($product->image ?? null);
                                            @endphp
                                            @if($imagePath)
                                                <img src="{{ asset('storage/' . $imagePath) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-300 dark:text-slate-600">
                                                    <i class="ph ph-image text-2xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-slate-900 dark:text-white group-hover:text-brand-500 transition-colors">{{ $product->name }}</p>
                                            <p class="text-[9px] text-slate-400 font-bold uppercase mt-1">ID: #{{ $product->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-50 dark:bg-white/5 text-slate-500 text-xs font-black border border-slate-100 dark:border-white/5 uppercase tracking-widest">
                                        {{ $product->category->name ?? 'غير مصنف' }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-sm font-black text-slate-900 dark:text-white">
                                        {{ number_format($product->price, 0) }} <span class="text-sm font-black text-slate-400 dark:text-slate-500 mr-1">⃁</span>
                                    </p>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="w-9 h-9 rounded-lg bg-slate-50 dark:bg-slate-800 text-slate-500 hover:bg-brand-500 hover:text-white transition-all flex items-center justify-center">
                                            <i class="ph ph-pencil-simple text-lg"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
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
                                <td colspan="4" class="px-8 py-20 text-center text-slate-400 text-sm font-bold italic">لا توجد منتجات مسجلة</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
                <div class="px-8 py-6 border-t border-slate-50 dark:border-white/5">
                    {{ $products->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection