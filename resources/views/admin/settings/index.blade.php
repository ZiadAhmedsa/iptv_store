@extends('layouts.admin')

@php
    $themeColor = $settings['theme_color'] ?? '#6366f1';
@endphp


@section('title', 'إعدادات النظام')
@section('subtitle', 'تخصيص الهوية، الربط، وتفضيلات المتجر')

@section('content')
    <div class="max-w-[1200px] mx-auto">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                <!-- Navigation Tabs (Vertical) -->
                <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-8">
                    <div class="bento-card p-2 space-y-1">
                        <button type="button" onclick="showTab('general')" id="tab-general"
                            class="w-full flex items-center gap-3 px-6 py-4 rounded-xl font-bold text-sm transition-all active-settings-tab">
                            <i class="ph ph-gear text-xl"></i> الإعدادات العامة
                        </button>
                        <button type="button" onclick="showTab('branding')" id="tab-branding"
                            class="w-full flex items-center gap-3 px-6 py-4 rounded-xl font-bold text-sm transition-all text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5">
                            <i class="ph ph-palette text-xl"></i> الهوية البصرية
                        </button>
                        <button type="button" onclick="showTab('contact')" id="tab-contact"
                            class="w-full flex items-center gap-3 px-6 py-4 rounded-xl font-bold text-sm transition-all text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5">
                            <i class="ph ph-phone text-xl"></i> معلومات التواصل
                        </button>
                        <button type="button" onclick="showTab('payment')" id="tab-payment"
                            class="w-full flex items-center gap-3 px-6 py-4 rounded-xl font-bold text-sm transition-all text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5">
                            <i class="ph ph-bank text-xl"></i> بيانات الدفع والحسابات
                        </button>
                        <button type="button" onclick="showTab('loyalty')" id="tab-loyalty"
                            class="w-full flex items-center gap-3 px-6 py-4 rounded-xl font-bold text-sm transition-all text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5">
                            <i class="ph ph-gift text-xl"></i> برنامج الولاء والمكافآت
                        </button>
                    </div>

                    <button type="submit" class="bento-button !w-full !h-14 !text-sm">
                        <i class="ph ph-floppy-disk text-xl"></i> حفظ التغييرات
                    </button>
                </div>

                <!-- Form Content -->
                <div class="lg:col-span-8">
                    <!-- General Settings -->
                    <div id="section-general" class="setting-section space-y-6">
                        <div class="bento-card p-10">
                            <div class="flex items-center gap-4 mb-10">
                                <div class="w-10 h-10 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center">
                                    <i class="ph ph-house text-xl"></i>
                                </div>
                                <h3 class="text-lg font-black text-slate-900 dark:text-white">الإعدادات العامة</h3>
                            </div>

                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">اسم المتجر</label>
                                    <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'INZO STORE' }}" class="bento-input">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">وصف المتجر (SEO)</label>
                                    <textarea name="site_description" rows="4" class="bento-input !h-auto !py-4">{{ $settings['site_description'] ?? '' }}</textarea>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">الكلمات المفتاحية (SEO)</label>
                                    <textarea name="site_keywords" rows="3" class="bento-input !h-auto !py-4" placeholder="مثال: اشتراك iptv, قنوات 4k...">{{ $settings['site_keywords'] ?? '' }}</textarea>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">تم التطوير بواسطة (تظهر أسفل الموقع)</label>
                                    <input type="text" name="developer_info" value="{{ $settings['developer_info'] ?? '' }}" class="bento-input" placeholder="مثال: المهندس زياد">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">رابط تواصل المطور (مثال: رابط واتساب)</label>
                                    <input type="url" name="developer_link" value="{{ $settings['developer_link'] ?? '' }}" class="bento-input" placeholder="مثال: https://wa.me/966..." dir="ltr">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Branding Settings -->
                    <div id="section-branding" class="setting-section space-y-6 hidden">
                        <div class="bento-card p-10">
                            <div class="flex items-center gap-4 mb-10">
                                <div class="w-10 h-10 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center">
                                    <i class="ph ph-palette text-xl"></i>
                                </div>
                                <h3 class="text-lg font-black text-slate-900 dark:text-white">الهوية البصرية</h3>
                            </div>

                            <div class="space-y-10">
                                <div class="flex flex-col md:flex-row gap-10 items-start">
                                    <div class="flex-1 space-y-4">
                                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">شعار المتجر (Logo)</label>
                                        <div class="bento-card p-10 border-dashed border-2 border-slate-100 dark:border-white/5 text-center group cursor-pointer hover:border-brand-500 transition-all rounded-2xl bg-slate-50/50 dark:bg-white/[0.01]">
                                            <input type="file" name="logo" class="hidden" id="logo-input">
                                            <label for="logo-input" class="cursor-pointer space-y-4 block">
                                                <i class="ph ph-cloud-arrow-up text-4xl text-slate-300 group-hover:text-brand-500 transition-all"></i>
                                                <p class="text-xs font-bold text-slate-400">اضغط لرفع شعار جديد</p>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="w-40 h-40 rounded-3xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center overflow-hidden border border-slate-100 dark:border-white/5">
                                        <img id="logo-preview" src="{{ asset($settings['logo_path'] ?? 'logo.png') }}" class="w-24 h-24 object-contain">
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">لون السمة الرئيسي</label>
                                    <div class="flex items-center gap-6">
                                        <input type="color" name="theme_color" value="{{ $settings['theme_color'] ?? '#6366f1' }}" class="w-14 h-14 rounded-xl cursor-pointer border-none bg-transparent">
                                        <div>
                                            <p class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-wider">{{ $settings['theme_color'] ?? '#6366f1' }}</p>
                                            <p class="text-xs text-slate-400 font-bold uppercase">Color HEX Code</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Settings -->
                    <div id="section-contact" class="setting-section space-y-6 hidden">
                        <div class="bento-card p-10">
                            <div class="flex items-center gap-4 mb-10">
                                <div class="w-10 h-10 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center">
                                    <i class="ph ph-phone text-xl"></i>
                                </div>
                                <h3 class="text-lg font-black text-slate-900 dark:text-white">معلومات التواصل</h3>
                            </div>

                            <div class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">رقم الواتساب</label>
                                        <input type="text" name="whatsapp" value="{{ $settings['whatsapp'] ?? '' }}" class="bento-input" dir="ltr">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">البريد الإلكتروني للدعم</label>
                                        <input type="email" name="support_email" value="{{ $settings['support_email'] ?? '' }}" class="bento-input" dir="ltr">
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">روابط التواصل الاجتماعي</label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="relative">
                                            <i class="ph ph-instagram-logo absolute right-4 top-1/2 -translate-y-1/2 text-xl text-pink-500"></i>
                                            <input type="text" name="social_instagram" value="{{ $settings['social_instagram'] ?? '' }}" placeholder="انستجرام" class="bento-input !pr-12" dir="ltr">
                                        </div>
                                        <div class="relative">
                                            <i class="ph ph-twitter-logo absolute right-4 top-1/2 -translate-y-1/2 text-xl text-blue-400"></i>
                                            <input type="text" name="social_twitter" value="{{ $settings['social_twitter'] ?? '' }}" placeholder="تويتر" class="bento-input !pr-12" dir="ltr">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Settings -->
                    <div id="section-payment" class="setting-section space-y-6 hidden">
                        <div class="bento-card p-10">
                            <div class="flex items-center gap-4 mb-10">
                                <div class="w-10 h-10 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center">
                                    <i class="ph ph-bank text-xl"></i>
                                </div>
                                <h3 class="text-lg font-black text-slate-900 dark:text-white">بيانات التحويل البنكي</h3>
                            </div>

                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">الأسم</label>
                                    <input type="text" name="payment_bank_name" value="{{ $settings['payment_bank_name'] ?? '' }}" placeholder="مثال: مؤسسة التقنية الحديثة" class="bento-input">
                                </div>
                                
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">رقم حساب مصرف الراجحي</label>
                                    <input type="text" name="payment_bank_account" value="{{ $settings['payment_bank_account'] ?? '' }}" placeholder="123456789" class="bento-input">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">رقم الآيبان (IBAN)</label>
                                    <input type="text" name="payment_bank_iban" value="{{ $settings['payment_bank_iban'] ?? '' }}" placeholder="SA..." class="bento-input" dir="ltr">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Loyalty Settings -->
                    <div id="section-loyalty" class="setting-section space-y-6 hidden">
                        <div class="bento-card p-10">
                            <div class="flex items-center gap-4 mb-10">
                                <div class="w-10 h-10 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center">
                                    <i class="ph ph-gift text-xl"></i>
                                </div>
                                <h3 class="text-lg font-black text-slate-900 dark:text-white">برنامج الولاء والمكافآت</h3>
                            </div>

                            <div class="space-y-8">
                                <div class="space-y-2">
                                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">طرق كسب النقاط (سطر لكل طريقة)</label>
                                    <textarea name="loyalty_earn_methods" rows="6" class="bento-input !h-auto !py-4" placeholder="مثال: اشترك واحصل على 50 نقطة">{{ $settings['loyalty_earn_methods'] ?? '' }}</textarea>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">طرق استبدال النقاط (سطر لكل طريقة)</label>
                                    <textarea name="loyalty_redeem_methods" rows="6" class="bento-input !h-auto !py-4" placeholder="مثال: استبدل 500 نقطة بخصم 10%">{{ $settings['loyalty_redeem_methods'] ?? '' }}</textarea>
                                </div>

                                <div class="p-6 rounded-2xl bg-amber-500/5 border border-amber-500/10 flex items-start gap-4">
                                    <i class="ph ph-info text-2xl text-amber-500"></i>
                                    <p class="text-xs text-amber-700/70 font-bold leading-relaxed">
                                        يتم عرض هذه التعليمات داخل المنبثقة (Popup) الخاصة ببرنامج الولاء في الواجهة الرئيسية للمتجر.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <style>
        .active-settings-tab {
            @php
                $hex = str_replace('#', '', $themeColor);
                if(strlen($hex) == 3) {
                    $r = hexdec(str_repeat(substr($hex, 0, 1), 2));
                    $g = hexdec(str_repeat(substr($hex, 1, 1), 2));
                    $b = hexdec(str_repeat(substr($hex, 2, 1), 2));
                } else {
                    $r = hexdec(substr($hex, 0, 2));
                    $g = hexdec(substr($hex, 2, 2));
                    $b = hexdec(substr($hex, 4, 2));
                }
                $rgb = "$r, $g, $b";
            @endphp
            background: rgba({{ $rgb }}, 0.1) !important;
            color: {{ $themeColor }} !important;
        }
    </style>

    <script>
        function showTab(tabId) {
            document.querySelectorAll('.setting-section').forEach(s => s.classList.add('hidden'));
            document.getElementById('section-' + tabId).classList.remove('hidden');

            document.querySelectorAll('[id^="tab-"]').forEach(t => {
                t.classList.remove('active-settings-tab', 'text-brand-500');
                t.classList.add('text-slate-400', 'hover:bg-slate-50', 'dark:hover:bg-white/5');
            });
            const activeTab = document.getElementById('tab-' + tabId);
            activeTab.classList.add('active-settings-tab');
            activeTab.classList.remove('text-slate-400', 'hover:bg-slate-50', 'dark:hover:bg-white/5');
        }

        document.getElementById('logo-input').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    document.getElementById('logo-preview').setAttribute('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection