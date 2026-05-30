@extends('layouts.app')

@php
    $siteName = \App\Models\Setting::get('site_name', 'World Cup 4K Store');
@endphp

@section('meta_title', 'حسابي - ' . $siteName)

@section('content')
<div class="min-h-[80vh] py-20 px-4 relative overflow-hidden">
    <!-- Decorative background glow -->
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none overflow-hidden">
        <div class="absolute -top-48 -left-48 w-96 h-96 brand-gradient opacity-10 blur-[150px] rounded-full animate-pulse-glow"></div>
        <div class="absolute -bottom-48 -right-48 w-96 h-96 brand-gradient opacity-10 blur-[150px] rounded-full"></div>
    </div>

    <div class="max-w-4xl mx-auto relative z-10">
        <!-- Page Header -->
        <div class="flex items-center gap-6 mb-12" data-aos="fade-down">
            <div class="w-20 h-20 rounded-3xl brand-gradient flex items-center justify-center text-white text-4xl shadow-2xl shadow-brand-500/20">
                <i class="ph-fill ph-user-circle-gear"></i>
            </div>
            <div>
                <h1 class="text-4xl font-black text-slate-900 dark:text-white tracking-tighter">الملف الشخصي</h1>
                <p class="text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest text-xs mt-1">إدارة بياناتك الشخصية وإعدادات الأمان</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Sidebar/Quick Info -->
            <div class="lg:col-span-1 space-y-6" data-aos="fade-left">
                <div class="luxury-glass p-8 rounded-[2.5rem] border-white/10 text-center space-y-6">
                    <div class="relative inline-block">
                        <div class="w-32 h-32 rounded-full brand-gradient p-1 shadow-2xl">
                            <div class="w-full h-full rounded-full bg-white dark:bg-slate-900 flex items-center justify-center text-5xl text-slate-300">
                                <i class="ph-fill ph-user"></i>
                            </div>
                        </div>
                        <div class="absolute bottom-0 right-0 w-8 h-8 bg-emerald-500 border-4 border-white dark:border-slate-900 rounded-full"></div>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-900 dark:text-white">{{ $user->name }}</h2>
                        <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest">{{ $user->role == 'admin' ? 'مدير النظام' : 'عميل متميز' }}</p>
                    </div>
                    <div class="pt-6 border-t border-slate-100 dark:border-white/5 space-y-4">
                        <div class="flex items-center gap-4 text-right">
                            <div class="w-10 h-10 rounded-xl bg-slate-50 dark:bg-white/5 flex items-center justify-center text-slate-400">
                                <i class="ph-bold ph-calendar"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-400 font-black uppercase">عضو منذ</p>
                                <p class="text-xs font-bold text-slate-700 dark:text-slate-300">{{ $user->created_at->format('Y/m/d') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats/Activity -->
                <div class="luxury-glass p-8 rounded-[2.5rem] border-white/10 space-y-6">
                    <h3 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-widest">إحصائيات الحساب</h3>
                    <div class="space-y-4">
                        <div class="p-4 rounded-2xl bg-slate-50 dark:bg-white/5 border border-slate-100 dark:border-white/5">
                            <p class="text-[10px] text-slate-400 font-black uppercase">الطلبات المكتملة</p>
                            <p class="text-2xl font-black text-brand-500">{{ $completedOrdersCount }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8" data-aos="fade-right">
                <!-- Alerts -->
                @if(session('success'))
                    <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-sm font-black flex items-center gap-3">
                        <i class="ph-fill ph-check-circle text-xl"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="p-4 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 text-sm font-black flex items-center gap-3">
                        <i class="ph-fill ph-warning-circle text-xl"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('info'))
                    <div class="p-4 rounded-2xl bg-brand-500/10 border border-brand-500/20 text-brand-600 dark:text-brand-400 text-sm font-black flex items-center gap-3">
                        <i class="ph-fill ph-info text-xl"></i>
                        {{ session('info') }}
                    </div>
                @endif

                <!-- Personal Info Form -->
                <div class="luxury-glass p-10 rounded-[3rem] border-white/10">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-2xl bg-brand-500/10 flex items-center justify-center text-brand-500 text-2xl">
                            <i class="ph-bold ph-identification-card"></i>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 dark:text-white">البيانات الشخصية</h3>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-2">الاسم الكامل</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                    class="w-full bg-slate-50 dark:bg-white/5 border border-slate-100 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold">
                                @error('name') <p class="text-red-500 text-[10px] font-black px-2">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-2">رقم الهاتف</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required
                                    class="w-full bg-slate-50 dark:bg-white/5 border border-slate-100 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold text-left" dir="ltr">
                                @error('phone') <p class="text-red-500 text-[10px] font-black px-2">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-2">البريد الإلكتروني</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                    class="w-full bg-slate-50 dark:bg-white/5 border border-slate-100 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold">
                                @error('email') <p class="text-red-500 text-[10px] font-black px-2">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <button type="submit" class="brand-gradient text-white px-10 py-4 rounded-2xl font-black text-sm shadow-xl shadow-brand-500/20 hover:scale-105 active:scale-95 transition-all">حفظ التعديلات</button>
                    </form>
                </div>

                <!-- Password Change Form -->
                <div class="luxury-glass p-10 rounded-[3rem] border-white/10">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-2xl bg-amber-500/10 flex items-center justify-center text-amber-500 text-2xl">
                            <i class="ph-bold ph-lock-key"></i>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 dark:text-white">تغيير كلمة المرور</h3>
                    </div>

                    <form action="{{ route('profile.password.request') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-2">كلمة المرور الحالية</label>
                                <input type="password" name="current_password" required placeholder="••••••••"
                                    class="w-full bg-slate-50 dark:bg-white/5 border border-slate-100 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500 transition-all font-bold">
                                @error('current_password') <p class="text-red-500 text-[10px] font-black px-2">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-2">كلمة المرور الجديدة</label>
                                <input type="password" name="password" required placeholder="••••••••"
                                    class="w-full bg-slate-50 dark:bg-white/5 border border-slate-100 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold">
                                @error('password') <p class="text-red-500 text-[10px] font-black px-2">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-2">تأكيد كلمة المرور</label>
                                <input type="password" name="password_confirmation" required placeholder="••••••••"
                                    class="w-full bg-slate-50 dark:bg-white/5 border border-slate-100 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold">
                            </div>
                        </div>
                        <div class="bg-amber-500/5 border border-amber-500/10 p-4 rounded-2xl flex items-start gap-4">
                            <i class="ph ph-info text-amber-500 text-xl mt-1"></i>
                            <p class="text-xs font-bold text-slate-500 dark:text-slate-400 leading-relaxed">
                                سيتم إرسال كود تحقق إلى بريدك الإلكتروني لتأكيد تغيير كلمة المرور للأمان الإضافي.
                            </p>
                        </div>
                        <button type="submit" class="bg-amber-500 text-white px-10 py-4 rounded-2xl font-black text-sm shadow-xl shadow-amber-500/20 hover:scale-105 active:scale-95 transition-all">طلب تغيير كلمة المرور</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
