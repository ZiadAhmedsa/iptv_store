@extends('layouts.admin')

@section('title', 'إضافة قسم جديد')
@section('subtitle', 'أنشئ قسم متجر جديد بسرعة وسهولة')

@section('content')
<div class="max-w-4xl mx-auto space-y-10">
    <div class="bento-card p-10">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white">إضافة قسم جديد</h1>
                <p class="text-slate-500 dark:text-slate-400 mt-2">قم بإدارة بنية المتجر بإضافة فئة جديدة تناسب منتجاتك.</p>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="text-brand-500 font-black hover:underline">العودة لقائمة الأقسام</a>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 dark:text-slate-300 mb-3">اسم الفئة (افتراضي)</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="bento-input">
                </div>

                <div>
                    <label class="block text-sm font-black text-slate-700 dark:text-slate-300 mb-3">اسم الفئة بالعربية</label>
                    <input type="text" name="name_ar" value="{{ old('name_ar') }}" required class="bento-input">
                </div>

                <div>
                    <label class="block text-sm font-black text-slate-700 dark:text-slate-300 mb-3">اسم الفئة بالإنجليزية</label>
                    <input type="text" name="name_en" value="{{ old('name_en') }}" class="bento-input">
                </div>
            </div>

            <div>
                <label class="block text-sm font-black text-slate-700 dark:text-slate-300 mb-3">وصف الفئة</label>
                <textarea name="description" rows="4" class="bento-input">{{ old('description') }}</textarea>
                <p class="text-xs text-slate-500 mt-2">وصف مختصر يظهر في صفحات القسم.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 dark:text-slate-300 mb-3">Slug (رابط)</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" class="bento-input">
                    <p class="text-xs text-slate-500 mt-2">يُترك فارغًا لتوليد slug تلقائياً من الاسم.</p>
                </div>

                <div class="flex items-center space-x-3">
                    <input type="hidden" name="customization_enabled" value="0">
                    <input type="checkbox" id="customization_enabled" name="customization_enabled" value="1" class="h-4 w-4" {{ old('customization_enabled') ? 'checked' : '' }}>
                    <label for="customization_enabled" class="text-sm font-black text-slate-700 dark:text-slate-300">تمكين التخصيص</label>
                </div>
            </div>

            <div>
                <label class="block text-sm font-black text-slate-700 dark:text-slate-300 mb-3">صورة الفئة</label>
                <input type="file" name="image" accept="image/*" class="bento-input !p-2">
                <p class="text-xs text-slate-500 mt-2">يفضل استخدام صور شفافة (PNG) أو أيقونات عالية الدقة.</p>
            </div>

            <div>
                <label class="block text-sm font-black text-slate-700 dark:text-slate-300 mb-3">ترتيب الفئة (اختياري)</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="bento-input" min="0">
                <p class="text-xs text-slate-500 mt-2">الأرقام الأقل تظهر أولاً (مثال: 0 تظهر قبل 1).</p>
            </div>

            <button type="submit" class="bento-button w-full">
                حفظ الفئة الجديدة
            </button>
        </form>
    </div>
</div>
@endsection
