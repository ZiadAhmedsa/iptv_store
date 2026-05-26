@extends('layouts.admin')

@section('title', 'إضافة منتج')
@section('subtitle', 'تعبئة بيانات الخدمة أو الاشتراك الجديد')

@section('content')
<div class="max-w-6xl mx-auto">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        @csrf
        
        <!-- Right Column: Basic Info -->
        <div class="lg:col-span-8 space-y-8">
            <div class="bento-card p-10">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-10 h-10 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center">
                        <i class="ph ph-info text-xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white">المعلومات الأساسية</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="name_ar" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">اسم المنتج بالعربية</label>
                        <input type="text" name="name_ar" id="name_ar" value="{{ old('name_ar') }}" required placeholder="مثلاً: اشتراك IPTV سنة" class="bento-input">
                        @error('name_ar') <span class="text-red-500 text-[9px] font-bold mt-1 block px-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="name_en" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">اسم المنتج بالإنجليزية</label>
                        <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}" placeholder="Product Name" class="bento-input" dir="ltr">
                        @error('name_en') <span class="text-red-500 text-[9px] font-bold mt-1 block px-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2 space-y-2">
                        <label for="category_id" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">الفئة / القسم</label>
                        <select name="category_id" id="category_id" required class="bento-input appearance-none cursor-pointer">
                            <option value="">اختر الفئة...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-red-500 text-[9px] font-bold mt-1 block px-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2 space-y-2">
                        <label for="description_ar" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">وصف المنتج بالعربية</label>
                        <textarea name="description_ar" id="description_ar" rows="4" placeholder="اكتب تفاصيل المنتج المميزة هنا..." class="bento-input !h-auto !py-4">{{ old('description_ar') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="bento-card p-10">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center">
                        <i class="ph ph-currency-circle-dollar text-xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white">التسعير والمخزون</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="space-y-2">
                        <label for="price" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">السعر الأصلي</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required placeholder="0.00" class="bento-input !pl-12 text-left" dir="ltr">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-xs uppercase">SAR</span>
                        </div>
                        @error('price') <span class="text-red-500 text-[9px] font-bold mt-1 block px-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="discount_price" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">السعر المخفض</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="discount_price" id="discount_price" value="{{ old('discount_price') }}" placeholder="0.00" class="bento-input !pl-12 text-left" dir="ltr">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-xs uppercase">SAR</span>
                        </div>
                        @error('discount_price') <span class="text-red-500 text-[9px] font-bold mt-1 block px-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="stock" class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">الكمية المتاحة</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" required class="bento-input">
                        @error('stock') <span class="text-red-500 text-[9px] font-bold mt-1 block px-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Left Column: Media & Settings -->
        <div class="lg:col-span-4 space-y-8">
            <div class="bento-card p-8">
                <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1 mb-6 block text-center">صورة المنتج الرئيسية</label>
                <div class="relative group">
                    <div id="imagePreview" class="w-full h-60 bg-slate-50 dark:bg-white/[0.01] border-2 border-dashed border-slate-100 dark:border-white/5 rounded-2xl flex flex-col items-center justify-center cursor-pointer hover:border-brand-500 transition-all overflow-hidden" onclick="document.getElementById('image').click()">
                        <div id="imagePlaceholder" class="flex flex-col items-center justify-center space-y-3">
                            <div class="w-12 h-12 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="ph ph-cloud-arrow-up text-2xl"></i>
                            </div>
                            <span class="text-xs font-black text-slate-400 uppercase tracking-widest">اختر صورة</span>
                        </div>
                        <img id="imagePreviewTag" src="#" alt="Preview" class="hidden w-full h-full object-cover" />
                    </div>
                    <input type="file" name="image" id="image" class="hidden" accept="image/*">
                </div>
                @error('image') <span class="text-red-500 text-[9px] font-bold mt-3 block text-center">{{ $message }}</span> @enderror
            </div>

            <div class="bento-card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-black text-slate-900 dark:text-white">حالة العرض</p>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-0.5">تفعيل فوري</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                        <div class="w-10 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-brand-500 shadow-sm"></div>
                    </label>
                </div>
            </div>

            <div class="space-y-4">
                <button type="submit" class="bento-button !w-full !h-14 !text-sm">
                    <i class="ph ph-plus-circle text-xl"></i> إضافة المنتج
                </button>
                <a href="{{ route('admin.products.index') }}" class="flex items-center justify-center gap-2 text-xs font-black text-slate-400 uppercase tracking-widest hover:text-brand-500 transition-colors">
                    <i class="ph ph-arrow-right"></i> العودة للمستودع
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
        if (!file) {
            previewTag.classList.add('hidden');
            placeholder.classList.remove('hidden');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            previewTag.src = e.target.result;
            previewTag.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection
