@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-20 px-4 relative overflow-hidden">
    <!-- Decorative background glow -->
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none overflow-hidden">
        <div class="absolute -top-48 -left-48 w-96 h-96 brand-gradient opacity-10 blur-[150px] rounded-full animate-pulse-glow"></div>
        <div class="absolute -bottom-48 -right-48 w-96 h-96 brand-gradient opacity-10 blur-[150px] rounded-full"></div>
    </div>

    <div class="w-full max-w-lg relative z-10">
        <!-- Login Card -->
        <div class="bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-2xl overflow-hidden">
            <!-- Card Header -->
            <div class="brand-gradient p-12 text-white relative text-center">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10 space-y-4">
                    <div class="w-20 h-20 mx-auto rounded-3xl bg-white/10 backdrop-blur-md flex items-center justify-center text-4xl border border-white/20 shadow-xl">
                        <i class="ph-bold ph-user-circle"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-black tracking-tighter">تسجيل الدخول</h2>
                        <p class="text-brand-100 font-bold opacity-80 text-sm">أهلاً بك مجدداً في {{ \App\Models\Setting::get('site_name', 'INZO STORE') }}</p>
                    </div>
                </div>
            </div>

            <div class="p-10 md:p-14">
                @if(session('show_login_verification'))
                    <div class="space-y-8">
                        <div class="luxury-glass p-8 rounded-[2.5rem] border-brand-500/20 text-center space-y-6 relative overflow-hidden">
                            <div class="absolute -top-10 -right-10 w-32 h-32 brand-gradient opacity-10 blur-3xl rounded-full"></div>
                            
                            <div class="w-16 h-16 mx-auto rounded-2xl brand-gradient flex items-center justify-center text-white text-2xl shadow-lg">
                                <i class="ph-fill ph-shield-check"></i>
                            </div>
                            
                            <div class="space-y-2">
                                <h3 class="text-xl font-black text-slate-900 dark:text-white">تأكيد الهوية</h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400 font-bold leading-relaxed px-4">
                                    أرسلنا كود التحقق المكون من 4 أرقام إلى:
                                </p>
                                <div class="inline-flex items-center gap-2 bg-brand-500/10 text-brand-600 dark:text-brand-400 px-4 py-2 rounded-xl font-black text-sm border border-brand-500/20">
                                    {{ session('temp_login_email') }}
                                </div>
                            </div>

                            <form action="{{ route('login.reset') }}" method="POST" id="reset-login-form" class="hidden">@csrf</form>
                            <button type="button" onclick="document.getElementById('reset-login-form').submit()" class="text-[10px] font-black text-brand-500 hover:text-brand-600 transition-colors uppercase tracking-widest flex items-center justify-center gap-2 mx-auto">
                                <i class="ph-bold ph-note-pencil"></i>
                                ليس بريدك؟ تعديل البيانات
                            </button>
                        </div>

                        <form method="POST" action="{{ route('login') }}" class="space-y-8">
                            @csrf
                            @if(session('message'))
                                <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-xs font-black text-center">
                                    <i class="ph-bold ph-check-circle ml-1"></i> {{ session('message') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="p-4 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 text-xs font-black text-center">
                                    <i class="ph-bold ph-warning-circle ml-1"></i> {{ session('error') }}
                                </div>
                            @endif

                            <div class="space-y-4">
                                <label class="text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] px-2 flex items-center justify-center gap-2">
                                    أدخل كود التحقق
                                </label>
                                <input type="text" name="verification_code" maxlength="4" required placeholder="----"
                                    class="w-full bg-slate-50 dark:bg-white/[0.02] border-2 border-slate-100 dark:border-white/5 rounded-3xl px-8 py-6 text-slate-900 dark:text-white focus:outline-none focus:ring-4 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-black text-4xl text-center tracking-[0.5em] placeholder:text-slate-200 dark:placeholder:text-slate-800">
                                @error('verification_code')
                                    <span class="text-red-500 text-xs font-black text-center block">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="w-full brand-gradient text-white py-6 rounded-2xl font-black text-xl shadow-2xl shadow-brand-500/40 transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-4 group">
                                تأكيد ودخول
                                <i class="ph ph-arrow-left text-2xl group-hover:translate-x-[-8px] transition-transform"></i>
                            </button>

                            <div class="text-center space-y-2">
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">تحقق من صندوق البريد الوارد أو البريد المهمل (Spam)</p>
                            </div>
                        </form>
                    </div>
                @else
                    <form method="POST" action="{{ route('login') }}" class="space-y-8">
                        @csrf

                        @if(session('message'))
                            <div class="p-4 rounded-2xl bg-blue-500/10 border border-blue-500/20 text-blue-600 dark:text-blue-400 text-xs font-black text-center">
                                {{ session('message') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="p-4 rounded-2xl bg-red-500/10 border border-red-200 text-red-600 dark:text-red-400 text-xs font-black text-center">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="space-y-6">
                            <!-- Email -->
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

                            <!-- Password -->
                            <div class="space-y-3">
                                <label for="password" class="text-xs font-black uppercase text-slate-400 tracking-widest px-2">كلمة المرور</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                                        <i class="ph-bold ph-lock-key text-xl"></i>
                                    </div>
                                    <input id="password" type="password" name="password" required placeholder="••••••••"
                                        class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 rounded-2xl pl-6 pr-14 py-4.5 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold placeholder:text-slate-300 dark:placeholder:text-slate-700">
                                </div>
                                @error('password')
                                    <span class="text-red-500 text-[10px] font-black block px-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-between px-2">
                            <label class="inline-flex items-center gap-3 cursor-pointer group">
                                <input class="w-5 h-5 rounded-lg border-slate-200 dark:border-white/10 text-brand-500 focus:ring-brand-500/20 bg-slate-50 dark:bg-white/5" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="text-xs font-black text-slate-500 dark:text-slate-400 group-hover:text-slate-700 dark:group-hover:text-white transition-colors">تذكرني</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full brand-gradient text-white py-6 rounded-2xl font-black text-xl shadow-2xl shadow-brand-500/40 transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-4 group">
                            تسجيل الدخول
                            <i class="ph ph-arrow-left text-2xl group-hover:translate-x-[-8px] transition-transform"></i>
                        </button>

                        <div class="text-center space-y-4 pt-4">
                            <p class="text-xs font-black text-slate-400">
                                ليس لديك حساب؟ 
                                <a href="{{ route('register') }}" class="text-brand-500 hover:text-brand-600 transition-colors">أنشئ حساباً جديداً</a>
                            </p>
                            <div class="pt-4 border-t border-slate-100 dark:border-white/5">
                                <a href="{{ route('password.request') }}" class="group/reset flex items-center justify-center gap-2 text-slate-400 hover:text-brand-500 transition-all duration-300">
                                    <span class="w-8 h-8 rounded-full bg-slate-50 dark:bg-white/5 flex items-center justify-center group-hover/reset:bg-brand-500/10 group-hover/reset:text-brand-500 transition-colors">
                                        <i class="ph-bold ph-key text-sm"></i>
                                    </span>
                                    <span class="text-[10px] font-black uppercase tracking-[0.2em]">نسيت كلمة المرور؟ استعدها الآن</span>
                                </a>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        <!-- Footer Note -->
        <p class="mt-8 text-center text-xs font-bold text-slate-400 dark:text-slate-500">
            &copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'INZO STORE') }}. جميع الحقوق محفوظة.
        </p>
    </div>
</div>
@endsection
