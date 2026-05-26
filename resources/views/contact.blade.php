@extends('layouts.app')

@section('content')
<div class="w-full max-w-[1920px] mx-auto px-4 sm:px-6 lg:px-12 2xl:px-24 py-24">
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_1.2fr] gap-24 items-start">
        <!-- Contact Info Section -->
        <div class="space-y-12">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-brand-500/10 text-brand-500 text-[10px] font-black uppercase tracking-[0.3em] border border-brand-500/20">
                    <i class="ph ph-chat-circle-dots"></i>
                    الدعم الفني المباشر
                </div>
                <h1 class="text-5xl md:text-8xl font-black text-slate-900 dark:text-white leading-tight tracking-tighter">
                    تواصل <span class="brand-text">معنا</span>
                </h1>
                <p class="text-xl text-slate-500 dark:text-slate-400 font-bold leading-relaxed max-w-lg">
                    فريقنا متواجد على مدار الساعة للرد على استفساراتكم بخصوص الاشتراكات، الدعم التقني، وطرق التفعيل.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6">
                <div class="modern-card p-10 rounded-[3rem] border border-slate-100 dark:border-white/5 bg-white dark:bg-slate-900 shadow-xl flex items-center gap-8 group">
                    <div class="w-16 h-16 rounded-2xl bg-brand-500/10 text-brand-500 flex items-center justify-center text-3xl group-hover:brand-gradient group-hover:text-white transition-all duration-500">
                        <i class="ph-bold ph-envelope"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-1">البريد الإلكتروني</p>
                        @php
                            $supportEmail = \App\Models\Setting::get('support_email', 'support@inzo-store.com');
                        @endphp
                        <a href="mailto:{{ $supportEmail }}?subject=استفسار%20من%20عميل" class="text-xl font-black text-slate-900 dark:text-white hover:text-brand-500 transition-colors block" dir="ltr">{{ $supportEmail }}</a>
                    </div>
                </div>

                <div class="modern-card p-10 rounded-[3rem] border border-slate-100 dark:border-white/5 bg-white dark:bg-slate-900 shadow-xl flex items-center gap-8 group">
                    <div class="w-16 h-16 rounded-2xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center text-3xl group-hover:bg-emerald-500 group-hover:text-white transition-all duration-500">
                        <i class="ph-bold ph-whatsapp-logo"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-1">رقم الواتساب</p>
                        @php
                            $contactWhatsapp = \App\Models\Setting::get('whatsapp', '+967 778340075');
                        @endphp
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactWhatsapp) }}?text=مرحباً،%20لدي%20استفسار%20بخصوص%20الاشتراكات" target="_blank" class="text-xl font-black text-slate-900 dark:text-white hover:text-emerald-500 transition-colors block" dir="ltr">{{ $contactWhatsapp }}</a>
                    </div>
                </div>
            </div>

            <div class="p-8 rounded-[2.5rem] bg-brand-500/5 border border-brand-500/10">
                <div class="flex items-center gap-4 mb-4">
                    <i class="ph ph-clock text-2xl text-brand-500"></i>
                    <h4 class="text-lg font-black text-slate-900 dark:text-white">ساعات العمل</h4>
                </div>
                <p class="text-slate-500 dark:text-slate-400 font-bold leading-relaxed">
                    نحن نعمل على مدار 24 ساعة، طوال أيام الأسبوع. الرد عادة ما يتم خلال دقائق قليلة.
                </p>
            </div>
        </div>

        <!-- Contact Form Section -->
        <div class="relative group">
            <div class="absolute -inset-10 brand-gradient opacity-5 blur-[100px] rounded-full"></div>
            <div class="relative bg-white dark:bg-slate-900 rounded-[4rem] p-12 border border-slate-100 dark:border-white/5 shadow-2xl">
                <h2 class="text-4xl font-black text-slate-900 dark:text-white mb-10 tracking-tight">أرسل لنا <span class="brand-text">رسالة</span></h2>
                
                <form method="POST" action="{{ route('contact.send') }}" class="space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest px-2">الاسم بالكامل</label>
                            <input type="text" name="name" value="{{ old('name') }}" required 
                                class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold placeholder:text-slate-300 dark:placeholder:text-slate-700" 
                                placeholder="أدخل اسمك هنا">
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest px-2">رقم الهاتف</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" 
                                class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold placeholder:text-slate-300 dark:placeholder:text-slate-700" 
                                placeholder="+967 7xxxxxxx">
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest px-2">البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ old('email') }}" required 
                            class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold placeholder:text-slate-300 dark:placeholder:text-slate-700" 
                            placeholder="example@mail.com">
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest px-2">محتوى الرسالة</label>
                        <textarea name="message" rows="6" required 
                            class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/5 rounded-2xl px-6 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500 transition-all font-bold placeholder:text-slate-300 dark:placeholder:text-slate-700" 
                            placeholder="كيف يمكننا مساعدتك اليوم؟">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="w-full brand-gradient text-white py-6 rounded-2xl font-black text-xl shadow-2xl shadow-brand-500/30 transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-4">
                        <i class="ph ph-paper-plane-tilt text-2xl"></i>
                        إرسال الرسالة الآن
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
