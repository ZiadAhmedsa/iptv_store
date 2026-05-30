@extends('layouts.app')

@section('content')
    <div class="min-h-[80vh] flex items-center justify-center py-20 px-4 relative overflow-hidden">
        <!-- Decorative background glow -->
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none overflow-hidden">
            <div
                class="absolute -top-48 -left-48 w-96 h-96 brand-gradient opacity-10 blur-[150px] rounded-full animate-pulse-glow">
            </div>
            <div class="absolute -bottom-48 -right-48 w-96 h-96 brand-gradient opacity-10 blur-[150px] rounded-full"></div>
        </div>

        <div class="w-full max-w-2xl relative z-10">
            <!-- Register Card -->
            <div
                class="bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-white/5 shadow-2xl overflow-hidden">
                <!-- Card Header -->
                <div class="brand-gradient p-12 text-white relative text-center">
                    <div class="absolute inset-0 bg-black/10"></div>
                    <div class="relative z-10 space-y-4">
                        <div
                            class="w-20 h-20 mx-auto rounded-3xl bg-white/10 backdrop-blur-md flex items-center justify-center text-4xl border border-white/20 shadow-xl">
                            <i class="ph-bold ph-user-plus"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl font-black tracking-tighter">إنشاء حساب جديد</h2>
                            <p class="text-brand-100 font-bold opacity-80 text-sm">انضم الآن واحصل على أفضل تجربة IPTV</p>
                        </div>
                    </div>
                </div>

                <div class="p-10 md:p-14">
                    @if(session('show_register_verification'))
                        <div class="space-y-8">
                            <div
                                class="luxury-glass p-8 rounded-[2.5rem] border-brand-500/20 text-center space-y-6 relative overflow-hidden">
                                <div
                                    class="absolute -top-10 -right-10 w-32 h-32 brand-gradient opacity-10 blur-3xl rounded-full">
                                </div>

                                <div
                                    class="w-16 h-16 mx-auto rounded-2xl brand-gradient flex items-center justify-center text-white text-2xl shadow-lg">
                                    <i class="ph-fill ph-envelope-open"></i>
                                </div>

                                <div class="space-y-2">
                                    <h3 class="text-xl font-black text-slate-900 dark:text-white">تحقق من بريدك</h3>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 font-bold leading-relaxed px-4">
                                        لقد أرسلنا كود التحقق المكون من 6 أرقام إلى:
                                    </p>
                                    <div
                                        class="inline-flex items-center gap-2 bg-brand-500/10 text-brand-600 dark:text-brand-400 px-4 py-2 rounded-xl font-black text-sm border border-brand-500/20">
                                        {{ session('temp_register_email') }}
                                    </div>
                                </div>

                                <form action="{{ route('register.reset') }}" method="POST" id="reset-register-form"
                                    class="hidden">@csrf</form>
                                <button type="button" onclick="document.getElementById('reset-register-form').submit()"
                                    class="text-[10px] font-black text-brand-500 hover:text-brand-600 transition-colors uppercase tracking-widest flex items-center justify-center gap-2 mx-auto">
                                    <i class="ph-bold ph-note-pencil"></i>
                                    هل البريد خاطئ؟ تعديل البيانات
                                </button>
                            </div>

                            <form method="POST" action="{{ route('register') }}" class="space-y-8">
                                @csrf
                                @if(session('message'))
                                    <div
                                        class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-xs font-black text-center">
                                        <i class="ph-bold ph-check-circle ml-1"></i> {{ session('message') }}
                                    </div>
                                @endif

                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] px-2 flex items-center justify-center gap-2">
                                        أدخل كود التحقق
                                    </label>
                                    <input type="text" name="verification_code" maxlength="6" required placeholder="------"
                                        class="w-full bg-slate-50 dark:bg-white/[0.02] border-2 border-slate-100 dark:border-white/5 rounded-3xl px-8 py-6 text-slate-900 dark:text-white focus:outline-none focus:ring-4 focus:ring-brand-500/20 focus:border-brand-500 transition-all font-black text-4xl text-center tracking-[0.5em] placeholder:text-slate-200 dark:placeholder:text-slate-800">
                                    @error('verification_code')
                                        <span class="text-red-500 text-xs font-black text-center block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="w-full brand-gradient text-white py-6 rounded-2xl font-black text-xl shadow-2xl shadow-brand-500/40 transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-4 group">
                                    تفعيل الحساب الآن
                                    <i class="ph ph-check-circle text-2xl group-hover:scale-110 transition-transform"></i>
                                </button>

                                <div class="text-center">
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest leading-relaxed">
                                        تأكد من فحص البريد الوارد أو المجلدات الأخرى (Spam/Junk)
                                    </p>
                                </div>
                            </form>
                        </div>
                    @else
                        <form method="POST" action="{{ route('register') }}" class="space-y-8">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div class="space-y-3">
                                    <label for="name"
                                        class="text-xs font-black uppercase text-slate-400 tracking-widest px-2">الاسم
                                        الكامل</label>
                                    <div class="relative group">
                                        <div
                                            class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                                            <i class="ph-bold ph-user text-xl"></i>
                                        </div>
                                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                            placeholder="الاسم الكريم"
                                            class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 rounded-2xl pl-6 pr-14 py-4.5 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold">
                                    </div>
                                    @error('name')
                                        <span class="text-red-500 text-[10px] font-black block px-2">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div class="space-y-3">
                                    <label for="phone"
                                        class="text-xs font-black uppercase text-slate-400 tracking-widest px-2">رقم الهاتف
                                        (الواتساب)</label>
                                    <div class="relative group">
                                        <div
                                            class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                                            <i class="ph-bold ph-phone text-xl"></i>
                                        </div>
                                        <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required
                                            placeholder="+966..."
                                            class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 rounded-2xl pl-6 pr-14 py-4.5 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold">
                                    </div>
                                    @error('phone')
                                        <span class="text-red-500 text-[10px] font-black block px-2">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="space-y-3 md:col-span-2">
                                    <label for="email"
                                        class="text-xs font-black uppercase text-slate-400 tracking-widest px-2">البريد
                                        الإلكتروني</label>
                                    <div class="relative group">
                                        <div
                                            class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                                            <i class="ph-bold ph-envelope-simple text-xl"></i>
                                        </div>
                                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                            placeholder="example@mail.com"
                                            class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 rounded-2xl pl-6 pr-14 py-4.5 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold">
                                    </div>
                                    @error('email')
                                        <span class="text-red-500 text-[10px] font-black block px-2">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="space-y-3">
                                    <label for="password"
                                        class="text-xs font-black uppercase text-slate-400 tracking-widest px-2">كلمة
                                        المرور</label>
                                    <div class="relative group">
                                        <div
                                            class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                                            <i class="ph-bold ph-lock-key text-xl"></i>
                                        </div>
                                        <input id="password" type="password" name="password" required placeholder="••••••••"
                                            class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 rounded-2xl pl-6 pr-14 py-4.5 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold">
                                    </div>
                                    @error('password')
                                        <span class="text-red-500 text-[10px] font-black block px-2">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="space-y-3">
                                    <label for="password_confirmation"
                                        class="text-xs font-black uppercase text-slate-400 tracking-widest px-2">تأكيد كلمة
                                        المرور</label>
                                    <div class="relative group">
                                        <div
                                            class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                                            <i class="ph-bold ph-lock-key-fill text-xl"></i>
                                        </div>
                                        <input id="password_confirmation" type="password" name="password_confirmation" required
                                            placeholder="••••••••"
                                            class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 rounded-2xl pl-6 pr-14 py-4.5 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold">
                                    </div>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full brand-gradient text-white py-6 rounded-2xl font-black text-xl shadow-2xl shadow-brand-500/40 transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-4 group">
                                إنشاء الحساب
                                <i class="ph ph-user-plus text-2xl group-hover:scale-110 transition-transform"></i>
                            </button>

                            <div class="text-center pt-2">
                                <p class="text-xs font-black text-slate-400">
                                    لديك حساب بالفعل؟
                                    <a href="{{ route('login') }}"
                                        class="text-brand-500 hover:text-brand-600 transition-colors font-bold">سجل دخولك
                                        الآن</a>
                                </p>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Footer Note -->
            <p class="mt-8 text-center text-xs font-bold text-slate-400 dark:text-slate-500">
                باستمرارك في التسجيل، أنت توافق على شروط الخدمة وسياسة الخصوصية.
            </p>
        </div>
    </div>
@endsection