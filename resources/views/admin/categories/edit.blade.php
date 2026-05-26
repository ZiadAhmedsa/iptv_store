@extends('layouts.admin')

@section('title', 'تعديل القسم')
@section('subtitle', 'قم بتحديث بيانات الفئة الحالية بسهولة')

@section('content')
<div class="max-w-4xl mx-auto space-y-10">
    <div class="bento-card p-10">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white">تعديل القسم</h1>
                <p class="text-slate-500 dark:text-slate-400 mt-2">قم بتحديث اسم الفئة أو أيقونتها دون التأثير على المنتجات المرتبطة.</p>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="text-brand-500 font-black hover:underline">العودة لقائمة الأقسام</a>
        </div>

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-black text-slate-700 dark:text-slate-300 mb-3">اسم الفئة بالعربية</label>
                <input type="text" name="name_ar" value="{{ old('name_ar', $category->name_ar) }}" required
                    class="bento-input">
            </div>

            <div>
                <label class="block text-sm font-black text-slate-700 dark:text-slate-300 mb-3">اسم الفئة بالإنجليزية</label>
                <input type="text" name="name_en" value="{{ old('name_en', $category->name_en) }}"
                    class="bento-input">
            </div>

            <div>
                <label class="block text-sm font-black text-slate-700 dark:text-slate-300 mb-3">وصف الفئة</label>
                <textarea name="description" rows="4" class="bento-input">{{ old('description', $category->description) }}</textarea>
                <p class="text-xs text-slate-500 mt-2">وصف مختصر يظهر في صفحات القسم.</p>
            </div>

            <div>
                <label class="block text-sm font-black text-slate-700 dark:text-slate-300 mb-3">صورة الفئة</label>
                @if($category->image)
                    <div class="mb-3">
                        <img src="{{ asset($category->image) }}" class="w-16 h-16 object-contain rounded-xl bg-slate-50 dark:bg-slate-800 p-2 border border-slate-200 dark:border-white/10" alt="{{ $category->name_ar }}">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="bento-input !p-2">
                <p class="text-xs text-slate-500 mt-2">يفضل استخدام صور شفافة (PNG) أو أيقونات عالية الدقة.</p>
            </div>

            <div>
                <label class="block text-sm font-black text-slate-700 dark:text-slate-300 mb-3">ترتيب الفئة</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}"
                    class="bento-input" min="0">
                <p class="text-xs text-slate-500 mt-2">الأرقام الأقل تظهر أولاً (مثال: 0 تظهر قبل 1).</p>
            </div>

            <button type="submit" class="bento-button w-full">
                حفظ التعديلات
            </button>
        </form>
    </div>
</div>
@endsection
