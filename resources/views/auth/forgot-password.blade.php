@extends('layouts.app')

@php
    $siteName = \App\Models\Setting::get('site_name', 'World Cup 4K Store');
@endphp

@section('meta_title', 'استعادة كلمة المرور - ' . $siteName)

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
                        <i class="ph-bold ph-key"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-black tracking-tighter">نسيت كلمة المرور؟</h2>
                        <p class="text-brand-100 font-bold opacity-80 text-sm">سنرسل لك كوداً لاستعادة الوصول لحسابك</p>
                    </div>
                </div>
            </div>

            <div class="p-10 md:p-14">
                @if(session('info'))
                    <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-xs font-black text-center mb-6">
                        {{ session('info') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="p-4 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 text-xs font-black text-center mb-6">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-8">
                    @csrf
                    
                    <div class="space-y-3">
                        <label for="email" class="text-xs font-black uppercase text-slate-400 tracking-widest px-2">البريد الإلكتروني</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                                <i class="ph-bold ph-envelope-simple text-xl"></i>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@example.com"
                                class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 rounded-2xl pl-6 pr-14 py-4.5 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold placeholder:text-slate-300 dark:placeholder:text-slate-700">
                        </div>
                        @error('email')
                            <span class="text-red-500 text-[10px] font-black block px-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="w-full brand-gradient text-white py-6 rounded-2xl font-black text-xl shadow-2xl shadow-brand-500/40 transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-4 group">
                        إرسال كود التحقق
                        <i class="ph ph-paper-plane-tilt text-2xl group-hover:translate-x-[-8px] group-hover:translate-y-[-4px] transition-transform"></i>
                    </button>

                    <div class="text-center pt-4">
                        <a href="{{ route('login') }}" class="text-xs font-black text-slate-400 hover:text-brand-500 transition-colors flex items-center justify-center gap-2">
                            <i class="ph ph-arrow-right"></i>
                            العودة لتسجيل الدخول
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
