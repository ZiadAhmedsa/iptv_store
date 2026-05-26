@extends('layouts.app')

@section('content')
<div class="w-full max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-12 2xl:px-24 py-24">
    <!-- Page Header -->
    <div class="text-center mb-24 space-y-8">
        <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-brand-500/10 text-brand-500 text-[10px] font-black uppercase tracking-[0.3em] border border-brand-500/20">
            <i class="ph ph-grid-four"></i>
            أقسام المتجر
        </div>
        <h1 class="text-5xl md:text-8xl font-black text-slate-900 dark:text-white leading-tight tracking-tighter">
            استكشف <span class="brand-text">عالم الترفيه</span>
        </h1>
        <p class="text-xl text-slate-500 dark:text-slate-400 font-bold max-w-2xl mx-auto leading-relaxed">
            اختر الفئة التي تناسب اهتماماتك لتبدأ رحلتك مع أفضل الاشتراكات الرقمية والبث المباشر.
        </p>
    </div>

    <div class="flex overflow-x-auto lg:grid lg:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6 md:gap-8 lg:gap-12 pb-8 lg:pb-0 scrollbar-hide snap-x snap-mandatory">
        @foreach($categories as $category)
            <a href="{{ route('categories.show', $category->slug) }}" class="min-w-[280px] md:min-w-0 snap-center group relative aspect-[4/5] rounded-[3rem] overflow-hidden shadow-2xl hover:shadow-brand-500/20 transition-all duration-500 hover:-translate-y-2 border border-slate-200 dark:border-white/10 block">
                @if($category->image)
                    <img src="{{ asset($category->image) }}" alt="{{ $category->name_ar }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                @else
                    <div class="absolute inset-0 bg-slate-100 dark:bg-slate-800 flex items-center justify-center transition-transform duration-1000 group-hover:scale-110">
                        <i class="ph-duotone ph-folders text-[8rem] text-slate-300 dark:text-slate-600"></i>
                    </div>
                @endif
                
                <!-- Enhanced Gradient Overlays -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/95 via-slate-900/40 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300 z-10"></div>
                
                <!-- Top Badge -->
                <div class="absolute top-6 left-6 z-20">
                    <div class="bg-black/30 backdrop-blur-md text-white border border-white/20 px-4 py-2 rounded-2xl text-xs font-black tracking-widest shadow-lg flex items-center gap-2">
                        <i class="ph-fill ph-stack"></i>
                        {{ $category->products_count }} باقة
                    </div>
                </div>

                <!-- Content -->
                <div class="absolute inset-0 p-8 flex flex-col justify-end z-20">
                    <div class="transform transition-transform duration-500 translate-y-8 group-hover:translate-y-0">
                        <div class="w-14 h-14 rounded-full bg-brand-500/20 backdrop-blur-md flex items-center justify-center text-brand-300 mb-6 border border-brand-500/30 group-hover:bg-brand-500 group-hover:text-white group-hover:border-transparent transition-all duration-500 shadow-lg shadow-brand-500/20">
                            <i class="ph-bold ph-arrow-up-left text-2xl"></i>
                        </div>
                        <h3 class="text-3xl md:text-4xl font-black text-white mb-4 drop-shadow-md tracking-tight">{{ $category->name_ar }}</h3>
                        <p class="text-sm text-slate-300 font-bold leading-relaxed line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                            {{ $category->description_ar ?? 'تصفح تشكيلة واسعة من أفضل الاشتراكات المتوفرة حالياً في هذا القسم.' }}
                        </p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
