@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-20 px-4 relative overflow-hidden">
    <!-- Decorative background glow -->
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none overflow-hidden">
        <div class="absolute -top-48 -left-48 w-96 h-96 brand-gradient opacity-10 blur-[150px] rounded-full animate-pulse-glow"></div>
        <div class="absolute -bottom-48 -right-48 w-96 h-96 brand-gradient opacity-10 blur-[150px] rounded-full"></div>
    </div>

    <div class="w-full max-w-lg relative z-10">
        <div class="bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-2xl overflow-hidden">
            <div class="brand-gradient p-12 text-white relative text-center">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10 space-y-4">
                    <div class="w-20 h-20 mx-auto rounded-3xl bg-white/10 backdrop-blur-md flex items-center justify-center text-4xl border border-white/20 shadow-xl">
                        <i class="ph-bold ph-shield-check"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-black tracking-tighter">تأكيد التغيير</h2>
                        <p class="text-brand-100 font-bold opacity-80 text-sm">خطوة واحدة متبقية لتأمين حسابك</p>
                    </div>
                </div>
            </div>

            <div class="p-10 md:p-14">
                <form method="POST" action="{{ route('profile.password.confirm') }}" class="space-y-8">
                    @csrf
                    
                    <div class="luxury-glass p-8 rounded-[2.5rem] border-brand-500/20 text-center space-y-6 relative overflow-hidden">
                        <div class="absolute -top-10 -right-10 w-32 h-32 brand-gradient opacity-10 blur-3xl rounded-full"></div>
                        
                        <div class="space-y-2">
                            <h3 class="text-xl font-black text-slate-900 dark:text-white">كود التحقق</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 font-bold leading-relaxed px-4">
                                أدخل الكود المكون من 6 أرقام المرسل إلى بريدك:
                            </p>
                            <div class="inline-flex items-center gap-2 bg-brand-500/10 text-brand-600 dark:text-brand-400 px-4 py-2 rounded-xl font-black text-sm border border-brand-500/20">
                                {{ Auth::user()->email }}
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <input type="text" name="verification_code" maxlength="6" required placeholder="------"
                            class="w-full bg-slate-50 dark:bg-white/[0.02] border-2 border-slate-100 dark:border-white/5 rounded-3xl px-8 py-6 text-slate-900 dark:text-white focus:outline-none focus:ring-4 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-black text-4xl text-center tracking-[0.5em] placeholder:text-slate-200 dark:placeholder:text-slate-800">
                        @error('verification_code')
                            <span class="text-red-500 text-xs font-black text-center block">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="w-full brand-gradient text-white py-6 rounded-2xl font-black text-xl shadow-2xl shadow-brand-500/40 transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-4 group">
                        تحديث كلمة المرور
                        <i class="ph ph-lock-key-open text-2xl group-hover:rotate-12 transition-transform"></i>
                    </button>

                    <div class="text-center pt-4">
                        <a href="{{ route('profile.index') }}" class="text-xs font-black text-slate-400 hover:text-slate-600 transition-colors">
                            إلغاء العملية والعودة
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
