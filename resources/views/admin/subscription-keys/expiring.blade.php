@extends('layouts.admin')

@section('title', 'الاشتراكات المقاربة على الانتهاء')
@section('subtitle', 'عرض الاشتراكات التي تنتهي خلال 14 يوماً أو أقل')

@section('content')
    <div class="space-y-8">
        <div class="bento-card overflow-hidden">
            <div class="px-10 py-8 border-b border-slate-100 dark:border-white/5 bg-slate-50/30 dark:bg-white/[0.01]">
                <div>
                    <h3 class="font-black text-2xl text-slate-900 dark:text-white tracking-tight">الاشتراكات المقاربة على الانتهاء (أسبوعين أو أقل)</h3>
                    <p class="text-xs text-slate-400 font-bold mt-1">يجب التواصل مع العملاء لتجديد اشتراكاتهم قبل انقطاع الخدمة</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-white/[0.01] text-slate-400 text-xs uppercase tracking-[0.2em] font-black">
                            <th class="px-10 py-6">المستخدم</th>
                            <th class="px-10 py-6">الخطة</th>
                            <th class="px-10 py-6 text-center">تاريخ الانتهاء</th>
                            <th class="px-10 py-6 text-center">الأيام المتبقية</th>
                            <th class="px-10 py-6 text-center">تنبيه يدوي</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                        @forelse($expiringSubscriptions as $sub)
                            @php
                                $daysRemaining = round(now()->floatDiffInDays($sub->expires_at));
                            @endphp
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-white/[0.01] transition-all group">
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl brand-gradient text-white flex items-center justify-center font-black text-lg shadow-lg group-hover:scale-110 transition-transform">
                                            {{ substr($sub->user->name ?? '?', 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-black text-slate-900 dark:text-white text-base mb-1 group-hover:text-brand-500 transition-colors">{{ $sub->user->name ?? 'مستخدم غير معروف' }}</div>
                                            <div class="text-xs text-slate-400 font-bold tracking-widest uppercase">{{ $sub->user->email ?? '---' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <div class="flex flex-col gap-2">
                                        <span class="inline-flex items-center justify-center px-4 py-1.5 bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-400 rounded-xl text-xs font-black border border-slate-200 dark:border-white/5 uppercase tracking-widest">
                                            {{ $sub->plan->title ?? 'باقة مجانية' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    <div class="text-xs font-black text-slate-600 dark:text-slate-400 uppercase tracking-widest">{{ $sub->expires_at->format('Y-m-d') }}</div>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full {{ $daysRemaining <= 3 ? 'bg-red-500/10 text-red-500' : 'bg-amber-500/10 text-amber-500' }} text-xs font-black">
                                        {{ $daysRemaining }} يوم
                                    </span>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    @if($sub->plan)
                                        <div x-data="{ open: false }">
                                            <button @click="open = true" type="button" class="bento-button text-white h-10 px-6 rounded-xl font-black text-xs transition-all scale-100 hover:scale-105 active:scale-95 shadow-lg bg-amber-500 hover:bg-amber-600">
                                                <i class="ph ph-envelope-simple mr-2 text-lg"></i> إرسال تنبيه
                                            </button>

                                            <!-- Modal -->
                                            <div x-show="open" class="fixed inset-0 z-50 overflow-y-auto text-right" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
                                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                    <div x-show="open" x-transition.opacity class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="open = false"></div>
                                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                                    <div x-show="open" x-transition.scale.origin.bottom class="inline-block align-bottom bg-white dark:bg-slate-900 rounded-3xl text-right overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-200 dark:border-white/10 relative z-50">
                                                        <div class="px-8 py-6">
                                                            <div class="flex justify-between items-center mb-6">
                                                                <h3 class="text-xl font-black text-slate-900 dark:text-white" id="modal-title">إرسال تنبيه الانتهاء</h3>
                                                                <button @click="open = false" type="button" class="text-slate-400 hover:text-slate-500 transition-colors">
                                                                    <i class="ph ph-x text-2xl"></i>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('admin.subscription-keys.alert', $sub->plan->id) }}" method="POST">
                                                                @csrf
                                                                <div class="mb-6">
                                                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">نص الرسالة</label>
                                                                    <textarea name="message_body" rows="6" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-white/10 rounded-2xl p-4 text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all font-bold text-slate-900 dark:text-white">مرحباً {{ $sub->user->name ?? 'عميلنا العزيز' }}،

نود تذكيرك بأن اشتراكك المجاني ({{ $sub->plan->title }}) شارف على الانتهاء.
تاريخ الانتهاء: {{ $sub->expires_at->format('Y-m-d') }}

يرجى تجديد الاشتراك لضمان استمرار الخدمة.
مع تحيات فريق متجرنا.</textarea>
                                                                </div>
                                                                <div class="flex justify-end gap-3">
                                                                    <button @click="open = false" type="button" class="px-6 py-3 rounded-xl font-black text-sm bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 text-slate-700 dark:text-slate-300 transition-colors">إلغاء</button>
                                                                    <button type="submit" class="px-6 py-3 rounded-xl font-black text-sm text-white bg-amber-500 hover:bg-amber-600 shadow-lg shadow-amber-500/30 transition-all flex items-center gap-2 hover:scale-105 active:scale-95">
                                                                        <i class="ph ph-paper-plane-right"></i> إرسال الإيميل
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-10 py-20 text-center text-slate-400 text-sm font-bold opacity-60 italic">لا توجد اشتراكات مقاربة على الانتهاء حالياً</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($expiringSubscriptions->hasPages())
                <div class="px-10 py-6 border-t border-slate-100 dark:border-white/5 bg-slate-50/20 dark:bg-white/[0.01]">
                    {{ $expiringSubscriptions->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
