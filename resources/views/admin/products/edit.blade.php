@extends('layouts.admin')

@section('title', 'تعديل المنتج')
@section('subtitle', 'تعديل بيانات المنتج: ' . ($product->name_ar ?? $product->name) . ' باحترافية')

@section('content')
<div class="max-w-6xl mx-auto">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        @csrf
        @method('PUT')
        
        <!-- Right Column: Basic Info -->
        <div class="lg:col-span-8 space-y-8">
            <div class="bento-card p-10">
                <h3 class="font-black text-2xl text-slate-900 dark:text-white mb-10 tracking-tight flex items-center gap-4">
                    <span class="w-10 h-10 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center"><i class="ph ph-info"></i></span>
                    تحديث المعلومات
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label for="name_ar" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">اسم المنتج بالعربية</label>
                        <input type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', $product->name_ar ?? $product->name) }}" required
                            class="bento-input">
                        @error('name_ar') <span class="text-red-500 text-xs font-bold mt-1 block px-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-3">
                        <label for="name_en" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">اسم المنتج بالإنجليزية</label>
                        <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $product->name_en ?? $product->name) }}"
                            class="bento-input" dir="ltr">
                        @error('name_en') <span class="text-red-500 text-xs font-bold mt-1 block px-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2 space-y-3">
                        <label for="category_id" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">الفئة / القسم</label>
                        <select name="category_id" id="category_id" required
                            class="bento-input appearance-none cursor-pointer">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name_ar ?? $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2 space-y-3">
                        <label for="description_ar" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">وصف المنتج بالعربية</label>
                        <textarea name="description_ar" id="description_ar" rows="5"
                            class="bento-input !h-auto !py-4">{{ old('description_ar', $product->description_ar ?? $product->description) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="bento-card p-10">
                <h3 class="font-black text-2xl text-slate-900 dark:text-white mb-10 tracking-tight flex items-center gap-4">
                    <span class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center"><i class="ph ph-currency-circle-dollar"></i></span>
                    تعديل الأسعار والمخزون
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="space-y-3">
                        <label for="price" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">السعر الأصلي</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" required
                                class="bento-input !pl-12" dir="ltr">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-xs">SAR</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label for="discount_price" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">السعر المخفض</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="discount_price" id="discount_price" value="{{ old('discount_price', $product->discount_price) }}"
                                class="bento-input !pl-12" dir="ltr">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-xs">SAR</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label for="stock" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">الكمية</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required
                            class="bento-input">
                    </div>
                </div>
            </div>
        </div>

        <!-- Left Column -->
        <div class="lg:col-span-4 space-y-8">
            <div class="bento-card p-8">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1 mb-6 block text-center">صورة المنتج</label>
                <div class="relative group">
                    <div id="imagePreview" class="w-full h-64 bg-slate-100 dark:bg-white/[0.01] border-2 border-dashed border-slate-200 dark:border-white/10 rounded-2xl flex flex-col items-center justify-center cursor-pointer hover:border-brand-500 transition-all overflow-hidden shadow-inner relative" onclick="document.getElementById('image').click()">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" id="imagePreviewTag" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center gap-2">
                                <i class="ph ph-pencil-simple text-white text-3xl"></i>
                                <span class="text-white text-xs font-black uppercase tracking-widest">تغيير الصورة</span>
                            </div>
                        @else
                            <div id="imagePlaceholder" class="flex flex-col items-center justify-center space-y-4">
                                <i class="ph ph-image text-4xl text-slate-300"></i>
                                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">رفع صورة</span>
                            </div>
                            <img id="imagePreviewTag" src="#" class="hidden w-full h-full object-cover">
                        @endif
                    </div>
                    <input type="file" name="image" id="image" class="hidden" accept="image/*">
                </div>
            </div>

            <div class="bento-card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="font-black text-slate-900 dark:text-white text-base tracking-tight">الحالة التشغيلية</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $product->is_active ? 'checked' : '' }}>
                        <div class="w-12 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-brand-500 shadow-sm"></div>
                    </label>
                </div>
            </div>

            <div class="space-y-4">
                <button type="submit" class="bento-button w-full">
                    <i class="ph ph-floppy-disk text-2xl"></i> حفظ التعديلات
                </button>
                <a href="{{ route('admin.products.index') }}" class="flex items-center justify-center gap-2 text-xs font-black text-slate-400 uppercase tracking-[0.2em] hover:text-slate-600 dark:hover:text-slate-200 transition-colors">
                    <i class="ph ph-arrow-right"></i> إلغاء والعودة
                </a>
            </div>
        </div>
    </form>
</div>

<script>
    const imageInput = document.getElementById('image');
    const previewTag = document.getElementById('imagePreviewTag');
    const placeholder = document.getElementById('imagePlaceholder');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            previewTag.src = e.target.result;
            previewTag.classList.remove('hidden');
            if(placeholder) placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection
