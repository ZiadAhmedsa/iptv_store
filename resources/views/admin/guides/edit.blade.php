@extends('layouts.admin')

@section('title', 'تعديل الدليل')
@section('subtitle', 'تحديث خطوات التفعيل والتعليمات')

@section('actions')
    <a href="{{ route('admin.guides.index') }}" class="flex items-center gap-2 text-xs font-black text-slate-400 uppercase tracking-widest hover:text-brand-500 transition-colors">
        <i class="ph ph-arrow-right text-lg"></i> العودة للقائمة
    </a>
@endsection

@section('content')
<div class="max-w-6xl mx-auto" x-data="{ 
    steps: {{ $guide->steps->map(fn($s) => ['id' => $s->id, 'image_path' => $s->image_path, 'description' => $s->description])->toJson() }} 
}">
    <form action="{{ route('admin.guides.update', $guide->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        @csrf
        @method('PUT')

        <!-- Main Column -->
        <div class="lg:col-span-8 space-y-8">
            <div class="bento-card p-10">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-10 h-10 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center">
                        <i class="ph ph-device-mobile text-xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white">بيانات الجهاز</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">اسم الجهاز</label>
                        <input type="text" name="title" value="{{ old('title', $guide->title) }}" placeholder="مثلاً: Smart TV" class="bento-input" required>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">الفئة (القسم)</label>
                        <input type="text" name="category" list="categories-list" value="{{ old('category', $guide->category ?? '') }}" placeholder="مثلاً: Android" class="bento-input">
                        <datalist id="categories-list">
                            @if(isset($categories))
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                            @endif
                        </datalist>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">كود الأيقونة</label>
                        <input type="text" name="icon" value="{{ old('icon', $guide->icon) }}" class="bento-input" dir="ltr" required>
                    </div>

                    <div class="md:col-span-3 space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">مقدمة الشرح</label>
                        <textarea name="content" rows="3" class="bento-input !h-auto !py-4" placeholder="أدخل مقدمة قصيرة للعميل...">{{ old('content', $guide->content) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Steps Builder -->
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center">
                            <i class="ph ph-steps text-xl"></i>
                        </div>
                        <h3 class="text-lg font-black text-slate-900 dark:text-white">خطوات الشرح</h3>
                    </div>
                    <button type="button" @click="steps.push({id: Date.now(), description: '', image_path: null, preview: null})" class="bento-button !h-10 !text-xs !px-4 !bg-emerald-500 shadow-emerald-500/20">
                        <i class="ph ph-plus-circle text-lg"></i> إضافة خطوة
                    </button>
                </div>

                <div class="space-y-6">
                    <template x-for="(step, index) in steps" :key="step.id">
                        <div class="bento-card p-8 group relative overflow-hidden border-r-4 border-r-brand-500/30">
                            <div class="absolute -right-2 -top-2 w-12 h-12 bg-brand-500/5 rounded-full flex items-center justify-center font-black text-brand-500/30 group-hover:text-brand-500 transition-colors" x-text="index + 1"></div>
                            
                            <button type="button" @click="steps.splice(index, 1)" class="absolute top-4 left-4 w-8 h-8 bg-red-500/10 text-red-500 rounded-lg flex items-center justify-center hover:bg-red-500 hover:text-white transition-all">
                                <i class="ph ph-trash text-lg"></i>
                            </button>

                            <div class="grid grid-cols-1 md:grid-cols-[180px_1fr] gap-8 mt-4">
                                <div class="space-y-4">
                                    <div class="relative w-full aspect-square bg-slate-50 dark:bg-white/[0.02] rounded-2xl border-2 border-dashed border-slate-100 dark:border-white/5 flex flex-col items-center justify-center text-center p-3 group/upload overflow-hidden" onclick="this.nextElementSibling.click()">
                                        <template x-if="step.preview || step.image_path">
                                            <img :src="step.preview || (step.image_path.startsWith('http') ? step.image_path : '/storage/' + step.image_path)" class="absolute inset-0 w-full h-full object-cover">
                                        </template>
                                        <div class="relative z-10" x-show="!step.preview && !step.image_path">
                                            <i class="ph ph-image-square text-2xl text-slate-300"></i>
                                            <span class="block text-[9px] font-black text-slate-400 mt-1 uppercase tracking-widest">الصورة</span>
                                        </div>
                                        <div class="absolute inset-0 bg-brand-500/60 opacity-0 group-hover/upload:opacity-100 transition-opacity flex items-center justify-center z-20" x-show="step.preview || step.image_path">
                                            <span class="text-white font-black text-[9px] uppercase tracking-widest">تغيير</span>
                                        </div>
                                    </div>
                                    <input type="file" :name="`steps[${index}][image]`" class="hidden" 
                                        @change="
                                            const file = $event.target.files[0];
                                            if (file) {
                                                const reader = new FileReader();
                                                reader.onload = (e) => { step.preview = e.target.result; };
                                                reader.readAsDataURL(file);
                                            }
                                        ">
                                </div>
                                <div class="space-y-4">
                                    <div class="space-y-2">
                                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest px-1">وصف الخطوة</label>
                                        <textarea :name="`steps[${index}][description]`" x-model="step.description" rows="4" class="bento-input !h-auto !py-4 !text-sm" placeholder="ماذا يجب على العميل فعله؟"></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" :name="`steps[${index}][id]`" :value="step.id ? (step.id.toString().length > 10 ? '' : step.id) : ''">
                            <input type="hidden" :name="`steps[${index}][old_image]`" :value="step.image_path || ''">
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-4 space-y-8">
            <div class="bento-card p-8">
                <h3 class="text-sm font-black text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                    <i class="ph ph-gear text-lg text-brand-500"></i> إعدادات العرض
                </h3>
                
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">ترتيب الظهور</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $guide->sort_order) }}" class="bento-input">
                    </div>

                    <div class="p-5 bg-slate-50 dark:bg-white/5 rounded-2xl border border-slate-100 dark:border-white/5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-black text-slate-900 dark:text-white">حالة التفعيل</p>
                                <p class="text-[9px] text-slate-500 font-bold">عرض الدليل للعملاء</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" {{ old('is_active', $guide->is_active) ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-10 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-brand-500"></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="bento-button !w-full !h-14">
                <i class="ph ph-floppy-disk text-xl"></i> تحديث الدليل
            </button>
        </div>
    </form>
</div>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
