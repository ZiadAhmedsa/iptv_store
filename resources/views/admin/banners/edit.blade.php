@extends('layouts.admin')

@section('title', 'تعديل البنر')
@section('subtitle', 'تحكم في العروض الترويجية والواجهة الرئيسية')

@section('actions')
    <a href="{{ route('admin.banners.index') }}" class="flex items-center gap-2 text-xs font-black text-slate-400 uppercase tracking-widest hover:text-brand-500 transition-colors">
        <i class="ph ph-arrow-right text-lg"></i> العودة للقائمة
    </a>
@endsection

@section('content')
<div class="max-w-6xl mx-auto">
    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        @csrf
        @method('PUT')

        <!-- Main Column -->
        <div class="lg:col-span-8 space-y-8">
            <div class="bento-card p-10">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-10 h-10 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center">
                        <i class="ph ph-text-aa text-xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white">محتوى البنر</h3>
                </div>

                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">عنوان العرض</label>
                        <input type="text" name="title" value="{{ old('title', $banner->title) }}" placeholder="مثلاً: خصم 50% على باقات IPTV السنوية" class="bento-input">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">رابط التوجه (URL)</label>
                        <input type="text" name="link_url" value="{{ old('link_url', $banner->link_url) }}" placeholder="/products/vip-package" class="bento-input" dir="ltr">
                    </div>
                </div>
            </div>

            <div class="bento-card p-10">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center">
                        <i class="ph ph-image text-xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white">الوسائط البصرية</h3>
                </div>

                <div class="space-y-6">
                    <div id="imagePreviewContainer" class="{{ ($banner->full_image_url ?? null) || $banner->image_path ? '' : 'hidden' }} relative w-full h-64 rounded-2xl overflow-hidden border border-slate-100 dark:border-white/5 mb-4 group shadow-xl">
                        <img id="imagePreview" src="{{ ($banner->full_image_url ?? null) ? $banner->full_image_url : ($banner->image_path ? asset('storage/' . $banner->image_path) : '#') }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-brand-500/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-white font-black text-xs uppercase tracking-widest">معاينة الصورة</span>
                        </div>
                    </div>
                    
                    <div class="p-10 border-2 border-dashed border-slate-100 dark:border-white/5 rounded-3xl text-center group hover:border-brand-500 transition-all bg-slate-50 dark:bg-white/[0.01] cursor-pointer" onclick="document.getElementById('bannerImageInput').click()">
                        <i class="ph ph-cloud-arrow-up text-5xl text-slate-300 group-hover:text-brand-500 transition-colors mb-4 block mx-auto"></i>
                        <p class="text-sm font-black text-slate-900 dark:text-white">تغيير صورة البنر</p>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">المقاس الموصى به: 1920x800</p>
                        <input type="file" name="image_file" id="bannerImageInput" class="hidden" onchange="previewBannerImage(this)">
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-4 space-y-8">
            <div class="bento-card p-8">
                <h3 class="text-sm font-black text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                    <i class="ph ph-gear text-lg text-brand-500"></i> الإعدادات
                </h3>
                
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">ترتيب العرض</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $banner->sort_order) }}" class="bento-input">
                    </div>

                    <div class="p-5 bg-slate-50 dark:bg-white/5 rounded-2xl border border-slate-100 dark:border-white/5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-black text-slate-900 dark:text-white">حالة البنر</p>
                                <p class="text-[9px] text-slate-500 font-bold">عرض البنر للعملاء</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" {{ old('is_active', $banner->is_active) ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-10 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-brand-500"></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="bento-button !w-full !h-14">
                <i class="ph ph-check-circle text-xl"></i> تحديث البنر
            </button>
        </div>
    </form>
</div>

<script>
    function previewBannerImage(input) {
        const preview = document.getElementById('imagePreview');
        const container = document.getElementById('imagePreviewContainer');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
