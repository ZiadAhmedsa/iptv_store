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
                        <h2 class="text-3xl font-black tracking-tighter">إعادة تعيين كلمة المرور</h2>
                        <p class="text-brand-100 font-bold opacity-80 text-sm">أدخل الكود المرسل إليك وكلمة المرور الجديدة</p>
                    </div>
                </div>
            </div>

            <div class="p-10 md:p-14">
                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    
                    <div class="luxury-glass p-6 rounded-3xl border-brand-500/20 text-center space-y-2">
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">الكود مرسل إلى:</p>
                        <p class="text-sm font-black text-brand-500">{{ session('reset_password_email') }}</p>
                    </div>

                    <div class="space-y-2 text-center">
                        <label class="text-xs font-black uppercase text-slate-400 tracking-widest">كود التحقق (6 أرقام)</label>
                        <input type="text" name="verification_code" maxlength="6" required placeholder="------"
                            class="w-full bg-slate-50 dark:bg-white/[0.02] border-2 border-slate-100 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-4 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-black text-3xl text-center tracking-[0.5em] placeholder:text-slate-200">
                        @error('verification_code')
                            <span class="text-red-500 text-[10px] font-black block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-4 pt-4">
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase text-slate-400 tracking-widest px-2">كلمة المرور الجديدة</label>
                            <input type="password" name="password" required placeholder="••••••••"
                                class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold">
                            @error('password')
                                <span class="text-red-500 text-[10px] font-black block px-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase text-slate-400 tracking-widest px-2">تأكيد كلمة المرور</label>
                            <input type="password" name="password_confirmation" required placeholder="••••••••"
                                class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold">
                        </div>
                    </div>

                    <button type="submit" class="w-full brand-gradient text-white py-6 rounded-2xl font-black text-xl shadow-2xl shadow-brand-500/40 transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-4 group mt-4">
                        حفظ كلمة المرور الجديدة
                        <i class="ph ph-check-circle text-2xl group-hover:scale-110 transition-transform"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
