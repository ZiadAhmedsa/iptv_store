@extends('layouts.app')

@section('content')
@php
    $contactWhatsapp = \App\Models\Setting::get('contact_whatsapp', '+967 778340075');
    $contactEmail = \App\Models\Setting::get('contact_email', config('mail.from.address', 'support@inzo-store.com'));
@endphp

<div class="min-h-screen bg-slate-50 dark:bg-slate-950 py-16 flex items-center justify-center transition-colors duration-300">
    <div class="max-w-3xl mx-auto px-4 w-full">
        <div class="rounded-[3rem] border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/50 backdrop-blur-xl shadow-[0_32px_64px_-15px_rgba(0,0,0,0.2)] overflow-hidden transition-all">
            <!-- Celebratory Header -->
            <div class="brand-gradient px-10 py-16 text-white text-center relative overflow-hidden">
                <!-- Decorative elements -->
                <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                    <i class="ph ph-confetti text-[20rem] rotate-12"></i>
                </div>
                
                <div class="relative z-10">
                    <div class="inline-flex items-center justify-center w-28 h-28 rounded-[2.5rem] bg-white/20 backdrop-blur-md border border-white/30 mx-auto mb-8 shadow-2xl animate-bounce-slow">
                        <i class="ph ph-check-circle text-6xl text-white"></i>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">شكراً لك، تم استلام طلبك!</h1>
                    <p class="mt-4 max-w-xl mx-auto text-brand-100 font-medium text-lg opacity-90">
                        سيتم مراجعة الدفعة البنكية لتأكيد طلبك من قبل فريق العمل المختص. يمكنك تتبع حالة الطلب الخاص بك.
                    </p>
                </div>
            </div>

            <div class="p-10 md:p-14 space-y-10">
                <!-- Info Section -->
                <div class="rounded-[2.5rem] bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 p-8 relative overflow-hidden">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 rounded-full bg-brand-500/10 flex items-center justify-center text-brand-500">
                            <i class="ph ph-info text-2xl font-bold"></i>
                        </div>
                        <h2 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tight">ماذا يحدث الآن؟</h2>
                    </div>
                    <p class="text-slate-600 dark:text-slate-400 font-medium leading-relaxed mb-4">
                        لقد تلقينا طلبك وإيصال التحويل ونقوم بمراجعته الآن. للمتابعة السريعة أو الاستفسار، يرجى التواصل معنا عبر الواتساب.
                    </p>
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-500/10 text-amber-600 dark:text-amber-400 text-xs font-black uppercase tracking-widest">
                        <i class="ph ph-shield-check text-base"></i>
                        بياناتك مشفرة ومحمية بالكامل
                    </div>
                </div>

                <!-- Contact Grid -->
                <div class="grid gap-6 md:grid-cols-2">
                    <a href="https://wa.me/{{ str_replace(['+',' '], '', $contactWhatsapp) }}" 
                       class="group rounded-[2rem] border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800/30 p-8 transition-all hover:border-emerald-500/50 hover:shadow-xl hover:shadow-emerald-500/5">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-500 group-hover:scale-110 transition-transform">
                                <i class="ph ph-whatsapp-logo text-3xl"></i>
                            </div>
                            <i class="ph ph-arrow-up-right text-slate-400 group-hover:text-emerald-500 transition-colors"></i>
                        </div>
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.2em] mb-2">WhatsApp Support</p>
                        <span class="text-xl font-black text-slate-900 dark:text-white">{{ $contactWhatsapp }}</span>
                    </a>

                    <a href="mailto:{{ $contactEmail }}" 
                       class="group rounded-[2rem] border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-800/30 p-8 transition-all hover:border-brand-500/50 hover:shadow-xl hover:shadow-brand-500/5">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-brand-500/10 flex items-center justify-center text-brand-500 group-hover:scale-110 transition-transform">
                                <i class="ph ph-envelope-simple text-3xl"></i>
                            </div>
                            <i class="ph ph-arrow-up-right text-slate-400 group-hover:text-brand-500 transition-colors"></i>
                        </div>
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.2em] mb-2">Official Email</p>
                        <span class="text-xl font-black text-slate-900 dark:text-white truncate block">{{ $contactEmail }}</span>
                    </a>
                </div>

                <!-- Footer Action -->
                <div class="text-center pt-4">
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center justify-center rounded-[1.5rem] brand-gradient text-white px-10 py-5 text-lg font-black hover:scale-105 active:scale-95 transition-all shadow-xl shadow-brand-500/30">
                        <i class="ph ph-house text-2xl ml-3"></i>
                        العودة للمتجر الرئيسي
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-bounce-slow {
        animation: bounce-slow 3s ease-in-out infinite;
    }
</style>
@endsection
