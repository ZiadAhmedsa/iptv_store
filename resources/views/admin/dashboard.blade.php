@extends('layouts.admin')

@php
    $themeColor = $settings['theme_color'] ?? '#6366f1';
@endphp

@section('title', 'لوحة التحكم')
@section('subtitle', 'نظرة شمولية على أداء المتجر والعمليات الجارية')

@section('content')
    <!-- Metric Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 md:mb-12">
        <!-- Revenue Card -->
        <div class="bento-card p-6 md:p-8 group">
            <div class="flex items-start justify-between mb-6">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 flex items-center justify-center transition-transform group-hover:scale-110">
                    <i class="ph ph-trend-up text-2xl font-bold"></i>
                </div>
                <span class="text-xs font-bold text-emerald-500 bg-emerald-50 dark:bg-emerald-500/10 px-3 py-1.5 rounded-xl">+12.5%</span>
            </div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">إجمالي المبيعات</p>
            <div class="flex items-baseline gap-2">
                <h3 id="stat-total-sales" class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white tracking-tight">{{ number_format($stats['total_sales'], 0) }}</h3>
                <span class="text-lg md:text-xl font-black text-brand-500 mr-1">⃁</span>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="bento-card p-6 md:p-8 group">
            <div class="flex items-start justify-between mb-6">
                <div class="w-12 h-12 rounded-2xl bg-brand-50 dark:bg-brand-500/10 text-brand-500 flex items-center justify-center transition-transform group-hover:scale-110">
                    <i class="ph ph-shopping-cart text-2xl font-bold"></i>
                </div>
                <div class="flex items-center gap-1.5 text-xs font-bold text-brand-500 bg-brand-50 dark:bg-brand-500/10 px-3 py-1.5 rounded-xl">
                    <span id="stat-pending-orders">{{ $stats['pending_orders'] }}</span>
                    <span>معلق</span>
                </div>
            </div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">إجمالي الطلبات</p>
            <div class="flex items-baseline gap-2">
                <h3 id="stat-total-orders" class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">{{ $stats['total_orders'] }}</h3>
                <span class="text-xs font-bold text-slate-400 uppercase">طلب</span>
            </div>
        </div>

        <!-- Inventory Card -->
        <div class="bento-card p-6 md:p-8 group">
            <div class="flex items-start justify-between mb-6">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 dark:bg-amber-500/10 text-amber-500 flex items-center justify-center transition-transform group-hover:scale-110">
                    <i class="ph ph-package text-2xl font-bold"></i>
                </div>
            </div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">المخزون الرقمي</p>
            <div class="flex items-baseline gap-2">
                <h3 id="stat-total-products" class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">{{ $stats['total_products'] }}</h3>
                <span class="text-xs font-bold text-slate-400 uppercase">منتج</span>
            </div>
        </div>

        <!-- Users Card -->
        <div class="bento-card p-6 md:p-8 group">
            <div class="flex items-start justify-between mb-6">
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 text-indigo-500 flex items-center justify-center transition-transform group-hover:scale-110">
                    <i class="ph ph-users text-2xl font-bold"></i>
                </div>
            </div>
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">قاعدة العملاء</p>
            <div class="flex items-baseline gap-2">
                <h3 id="stat-total-users" class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">{{ $stats['total_users'] }}</h3>
                <span class="text-xs font-bold text-slate-400 uppercase">عميل</span>
            </div>
        </div>
    </div>

    <!-- Main Content Sections -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
        <!-- Recent Orders -->
        <div class="xl:col-span-8 space-y-8">
            <div class="bento-card">
                <div class="px-8 py-6 border-b border-slate-100 dark:border-white/[0.05] flex items-center justify-between bg-slate-50/50 dark:bg-white/[0.01]">
                    <div>
                        <h3 class="text-lg font-black text-slate-900 dark:text-white">أحدث الطلبات</h3>
                        <p class="text-xs text-slate-400 font-bold mt-1">تتبع حركة المبيعات الأخيرة</p>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="text-xs font-black text-brand-500 hover:bg-brand-500/10 px-4 py-2 rounded-xl transition-colors">عرض الكل</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 dark:border-white/[0.02]">
                                <th class="px-8 py-5">العميل</th>
                                <th class="px-8 py-5">القيمة</th>
                                <th class="px-8 py-5">الحالة</th>
                                <th class="px-8 py-5">الوقت</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-white/[0.02]">
                            @forelse($recent_orders as $order)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-white/[0.02] transition-colors group">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-sm font-black text-slate-600 dark:text-slate-400 shadow-inner">
                                                {{ substr($order->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $order->user->name }}</p>
                                                <p class="text-xs text-slate-400 font-bold mt-0.5">{{ $order->user->phone }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <p class="text-sm md:text-base font-black text-slate-900 dark:text-white">{{ number_format($order->total, 0) }} <span class="text-base md:text-lg font-black text-slate-400 dark:text-slate-500 mr-1">⃁</span></p>
                                    </td>
                                    <td class="px-8 py-5">
                                        @if($order->status == 'completed')
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 text-xs font-black">مكتمل</span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-xl bg-amber-50 dark:bg-amber-500/10 text-amber-500 text-xs font-black">معلق</span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-5 text-xs font-bold text-slate-400">
                                        {{ $order->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-16 text-center text-slate-400 text-sm font-bold">لا توجد طلبات حديثة</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Subscription Claims -->
            <div class="bento-card">
                <div class="px-8 py-6 border-b border-slate-100 dark:border-white/[0.05] flex items-center justify-between bg-slate-50/50 dark:bg-white/[0.01]">
                    <div>
                        <h3 class="text-lg font-black text-slate-900 dark:text-white">طلبات الاشتراكات المجانية</h3>
                        <p class="text-xs text-slate-400 font-bold mt-1">طلبات التفعيل بانتظار المراجعة</p>
                    </div>
                    <a href="{{ route('admin.subscription-keys.claims') }}" class="text-xs font-black text-brand-500 hover:bg-brand-500/10 px-4 py-2 rounded-xl transition-colors">إدارة الطلبات</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse">
                        <tbody class="divide-y divide-slate-50 dark:divide-white/[0.02]">
                            @forelse($recent_claims as $claim)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-white/[0.02] transition-colors">
                                    <td class="px-8 py-6">
                                        <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $claim->user->name }}</p>
                                        <p class="text-xs text-slate-400 font-bold mt-0.5">{{ $claim->user->email }}</p>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-brand-50 dark:bg-brand-500/10 text-xs font-black text-brand-500">
                                            <i class="ph ph-crown-simple text-sm"></i>
                                            {{ $claim->plan->title ?? 'باقة تجريبية' }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-left">
                                        <form action="{{ route('admin.subscription-keys.claims.approve', $claim->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="h-10 px-5 bg-brand-500 text-white rounded-xl font-bold text-xs hover:scale-105 transition-transform shadow-lg shadow-brand-500/20">تفعيل الآن</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-8 py-16 text-center text-slate-400 text-sm font-bold">لا توجد طلبات معلقة</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar Widgets -->
        <div class="xl:col-span-4 space-y-8">
            <!-- New Users Widget -->
            <div class="bento-card p-8">
                <h3 class="text-lg font-black text-slate-900 dark:text-white mb-8">آخر المسجلين</h3>
                <div class="space-y-6">
                    @foreach($latest_users as $user)
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-white/[0.03] flex items-center justify-center font-black text-slate-500 dark:text-slate-400 border border-slate-200 dark:border-white/5">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ $user->name }}</p>
                                <p class="text-xs text-slate-400 font-bold mt-0.5">{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- System Health Widget -->
            <div class="bento-card p-8 bg-brand-500 text-white border-none overflow-hidden relative">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-2xl shadow-inner border border-white/10">
                            <i class="ph ph-shield-check"></i>
                        </div>
                        <div>
                            <p class="text-sm font-black">حالة النظام</p>
                            <p class="text-xs font-bold opacity-80 uppercase tracking-widest mt-0.5">Secure & Active</p>
                        </div>
                    </div>
                    <p class="text-xs font-bold leading-relaxed opacity-90 mb-6">كافة الخدمات تعمل بكفاءة عالية، تم التحقق من سلامة البيانات والمزامنة بنجاح.</p>
                    <div class="flex items-center gap-3 text-xs font-black bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/10">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse shadow-[0_0_10px_rgba(52,211,153,0.8)]"></span>
                        قاعدة البيانات: متصلة
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Communication Matrix Section -->
    <div class="mt-8 mb-12">
        <div class="bento-card overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12">
                <!-- Branding Context -->
                <div class="lg:col-span-4 p-12 bg-slate-900 text-white relative overflow-hidden flex flex-col justify-center">
                    <div class="absolute inset-0 bg-brand-500/20 mix-blend-multiply"></div>
                    <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-brand-500/40 rounded-full blur-[80px]"></div>
                    <div class="relative z-10">
                        <span class="inline-block px-4 py-1.5 rounded-xl bg-white/10 backdrop-blur-md border border-white/10 text-xs font-black uppercase tracking-widest text-white mb-8">مركز التواصل</span>
                        <h3 class="text-3xl font-black leading-tight mb-6">تفاعل مباشر مع عملائك</h3>
                        <p class="text-sm text-slate-300 font-bold leading-loose opacity-90 mb-12">أرسل بيانات التراخيص والإشعارات الإدارية بسرعة عبر الواتساب أو البريد الرسمي.</p>
                        
                        <div class="space-y-6">
                            <div class="flex items-center gap-4 bg-white/5 p-4 rounded-2xl border border-white/5">
                                <i class="ph ph-whatsapp-logo text-2xl text-emerald-400"></i>
                                <p class="text-xs font-bold text-slate-200">الواتساب: متصل</p>
                            </div>
                            <div class="flex items-center gap-4 bg-white/5 p-4 rounded-2xl border border-white/5">
                                <i class="ph ph-envelope-simple text-2xl text-brand-400"></i>
                                <p class="text-xs font-bold text-slate-200">البريد: نشط</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Strategic Form Interface -->
                <div class="lg:col-span-8 p-8 md:p-12">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <!-- WhatsApp Hub -->
                        <div class="space-y-6">
                            <h4 class="font-black text-base text-slate-900 dark:text-white flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-500">
                                    <i class="ph ph-whatsapp-logo text-xl"></i>
                                </div>
                                واتساب
                            </h4>
                            
                            <div class="space-y-4">
                                <div class="flex gap-3" dir="ltr">
                                    <div class="relative">
                                        <button type="button" onclick="toggleCountryDropdown()" class="h-14 px-4 rounded-2xl bg-slate-50 dark:bg-white/[0.02] border border-slate-100 dark:border-white/[0.05] flex items-center gap-2 text-xs font-bold text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/[0.05] transition-colors">
                                            <img id="wa_flag" src="https://flagcdn.com/w40/sa.png" class="w-6 h-4 rounded-sm object-cover">
                                            <span id="wa_code_display">+966</span>
                                        </button>
                                        <!-- Country Dropdown -->
                                        <div id="country-dropdown" class="hidden absolute top-[calc(100%+0.5rem)] left-0 w-64 max-h-60 overflow-y-auto bg-white dark:bg-base-cardDark border border-slate-100 dark:border-white/[0.05] rounded-2xl shadow-2xl z-50 no-scrollbar p-2">
                                            <input type="text" id="country-search" placeholder="بحث..." class="w-full h-10 bg-slate-50 dark:bg-white/5 border-none rounded-xl px-4 text-xs font-bold mb-2 outline-none">
                                            <div id="country-list" class="space-y-1"></div>
                                        </div>
                                    </div>
                                    <input type="text" id="wa_phone" placeholder="رقم الهاتف" class="flex-1 bento-input" dir="ltr">
                                </div>
                                <textarea id="wa_message" rows="4" class="bento-input !h-auto !py-4 leading-relaxed resize-none" placeholder="اكتب رسالتك...">أهلاً بك، تم تفعيل اشتراكك بنجاح!</textarea>
                                <button onclick="sendAdminMessage('whatsapp')" class="bento-button !w-full !bg-emerald-500 !shadow-emerald-500/20">
                                    <i class="ph ph-paper-plane-right text-lg"></i> إرسال واتساب
                                </button>
                            </div>
                        </div>

                        <!-- Email Matrix -->
                        <div class="space-y-6">
                            <h4 class="font-black text-base text-slate-900 dark:text-white flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-brand-50 dark:bg-brand-500/10 flex items-center justify-center text-brand-500">
                                    <i class="ph ph-envelope-simple text-xl"></i>
                                </div>
                                البريد الرسمي
                            </h4>
                            <div class="space-y-4">
                                <input type="email" id="email_addr" placeholder="بريد العميل" class="bento-input" dir="ltr">
                                <textarea id="email_message" rows="4" class="bento-input !h-auto !py-4 leading-relaxed resize-none" placeholder="محتوى البريد...">مرحباً بك، يسعدنا إبلاغك بتحديث حالة طلبك...</textarea>
                                <button onclick="sendAdminMessage('email')" class="bento-button !w-full">
                                    <i class="ph ph-paper-plane-right text-lg"></i> إرسال بريد
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
const countryMap = {
    '1':    { flag: 'us', name: 'الولايات المتحدة / كندا' },
    '7':    { flag: 'ru', name: 'روسيا' },
    '20':   { flag: 'eg', name: 'مصر' },
    '27':   { flag: 'za', name: 'جنوب أفريقيا' },
    '30':   { flag: 'gr', name: 'اليونان' },
    '31':   { flag: 'nl', name: 'هولندا' },
    '32':   { flag: 'be', name: 'بلجيكا' },
    '33':   { flag: 'fr', name: 'فرنسا' },
    '34':   { flag: 'es', name: 'إسبانيا' },
    '36':   { flag: 'hu', name: 'المجر' },
    '39':   { flag: 'it', name: 'إيطاليا' },
    '40':   { flag: 'ro', name: 'رومانيا' },
    '41':   { flag: 'ch', name: 'سويسرا' },
    '43':   { flag: 'at', name: 'النمسا' },
    '44':   { flag: 'gb', name: 'المملكة المتحدة' },
    '45':   { flag: 'dk', name: 'الدنمارك' },
    '46':   { flag: 'se', name: 'السويد' },
    '47':   { flag: 'no', name: 'النرويج' },
    '48':   { flag: 'pl', name: 'بولندا' },
    '49':   { flag: 'de', name: 'ألمانيا' },
    '51':   { flag: 'pe', name: 'بيرو' },
    '52':   { flag: 'mx', name: 'المكسيك' },
    '53':   { flag: 'cu', name: 'كوبا' },
    '54':   { flag: 'ar', name: 'الأرجنتين' },
    '55':   { flag: 'br', name: 'البرازيل' },
    '56':   { flag: 'cl', name: 'تشيلي' },
    '57':   { flag: 'co', name: 'كولومبيا' },
    '58':   { flag: 've', name: 'فنزويلا' },
    '60':   { flag: 'my', name: 'ماليزيا' },
    '61':   { flag: 'au', name: 'أستراليا' },
    '62':   { flag: 'id', name: 'إندونيسيا' },
    '63':   { flag: 'ph', name: 'الفلبين' },
    '64':   { flag: 'nz', name: 'نيوزيلندا' },
    '65':   { flag: 'sg', name: 'سنغافورة' },
    '66':   { flag: 'th', name: 'تايلاند' },
    '81':   { flag: 'jp', name: 'اليابان' },
    '82':   { flag: 'kr', name: 'كوريا الجنوبية' },
    '84':   { flag: 'vn', name: 'فيتنام' },
    '86':   { flag: 'cn', name: 'الصين' },
    '90':   { flag: 'tr', name: 'تركيا' },
    '91':   { flag: 'in', name: 'الهند' },
    '92':   { flag: 'pk', name: 'باكستان' },
    '93':   { flag: 'af', name: 'أفغانستان' },
    '94':   { flag: 'lk', name: 'سريلانكا' },
    '95':   { flag: 'mm', name: 'ميانمار' },
    '98':   { flag: 'ir', name: 'إيران' },
    '211':  { flag: 'ss', name: 'جنوب السودان' },
    '212':  { flag: 'ma', name: 'المغرب' },
    '213':  { flag: 'dz', name: 'الجزائر' },
    '216':  { flag: 'tn', name: 'تونس' },
    '218':  { flag: 'ly', name: 'ليبيا' },
    '220':  { flag: 'gm', name: 'غامبيا' },
    '221':  { flag: 'sn', name: 'السنغال' },
    '222':  { flag: 'mr', name: 'موريتانيا' },
    '223':  { flag: 'ml', name: 'مالي' },
    '224':  { flag: 'gn', name: 'غينيا' },
    '225':  { flag: 'ci', name: 'ساحل العاج' },
    '226':  { flag: 'bf', name: 'بوركينا فاسو' },
    '227':  { flag: 'ne', name: 'النيجر' },
    '228':  { flag: 'tg', name: 'توغو' },
    '229':  { flag: 'bj', name: 'بنين' },
    '230':  { flag: 'mu', name: 'موريشيوس' },
    '231':  { flag: 'lr', name: 'ليبيريا' },
    '232':  { flag: 'sl', name: 'سيراليون' },
    '233':  { flag: 'gh', name: 'غانا' },
    '234':  { flag: 'ng', name: 'نيجيريا' },
    '235':  { flag: 'td', name: 'تشاد' },
    '236':  { flag: 'cf', name: 'أفريقيا الوسطى' },
    '237':  { flag: 'cm', name: 'الكاميرون' },
    '238':  { flag: 'cv', name: 'الرأس الأخضر' },
    '239':  { flag: 'st', name: 'ساو تومي وبرينسيب' },
    '240':  { flag: 'gq', name: 'غينيا الاستوائية' },
    '241':  { flag: 'ga', name: 'الغابون' },
    '242':  { flag: 'cg', name: 'الكونغو' },
    '243':  { flag: 'cd', name: 'الكونغو الديمقراطية' },
    '244':  { flag: 'ao', name: 'أنغولا' },
    '248':  { flag: 'sc', name: 'سيشل' },
    '249':  { flag: 'sd', name: 'السودان' },
    '250':  { flag: 'rw', name: 'رواندا' },
    '251':  { flag: 'et', name: 'إثيوبيا' },
    '252':  { flag: 'so', name: 'الصومال' },
    '253':  { flag: 'dj', name: 'جيبوتي' },
    '254':  { flag: 'ke', name: 'كينيا' },
    '255':  { flag: 'tz', name: 'تنزانيا' },
    '256':  { flag: 'ug', name: 'أوغندا' },
    '257':  { flag: 'bi', name: 'بوروندي' },
    '258':  { flag: 'mz', name: 'موزمبيق' },
    '260':  { flag: 'zm', name: 'زامبيا' },
    '261':  { flag: 'mg', name: 'مدغشقر' },
    '262':  { flag: 're', name: 'ريونيون' },
    '263':  { flag: 'zw', name: 'زيمبابوي' },
    '264':  { flag: 'na', name: 'ناميبيا' },
    '265':  { flag: 'mw', name: 'مالاوي' },
    '266':  { flag: 'ls', name: 'ليسوتو' },
    '267':  { flag: 'bw', name: 'بوتسوانا' },
    '268':  { flag: 'sz', name: 'إسواتيني' },
    '269':  { flag: 'km', name: 'جزر القمر' },
    '290':  { flag: 'sh', name: 'سانت هيلينا' },
    '291':  { flag: 'er', name: 'إريتريا' },
    '297':  { flag: 'aw', name: 'أروبا' },
    '298':  { flag: 'fo', name: 'جزر فارو' },
    '299':  { flag: 'gl', name: 'غرينلاند' },
    '352':  { flag: 'lu', name: 'لوكسمبورغ' },
    '353':  { flag: 'ie', name: 'أيرلندا' },
    '354':  { flag: 'is', name: 'آيسلندا' },
    '355':  { flag: 'al', name: 'ألبانيا' },
    '356':  { flag: 'mt', name: 'مالطا' },
    '357':  { flag: 'cy', name: 'قبرص' },
    '358':  { flag: 'fi', name: 'فنلندا' },
    '359':  { flag: 'bg', name: 'بلغاريا' },
    '370':  { flag: 'lt', name: 'ليتوانيا' },
    '371':  { flag: 'lv', name: 'لاتفيا' },
    '372':  { flag: 'ee', name: 'إستونيا' },
    '373':  { flag: 'md', name: 'مولدوفا' },
    '374':  { flag: 'am', name: 'أرمينيا' },
    '375':  { flag: 'by', name: 'بيلاروسيا' },
    '376':  { flag: 'ad', name: 'أندورا' },
    '377':  { flag: 'mc', name: 'موناكو' },
    '378':  { flag: 'sm', name: 'سان مارينو' },
    '380':  { flag: 'ua', name: 'أوكرانيا' },
    '381':  { flag: 'rs', name: 'صربيا' },
    '382':  { flag: 'me', name: 'الجبل الأسود' },
    '385':  { flag: 'hr', name: 'كرواتيا' },
    '386':  { flag: 'si', name: 'سلوفينيا' },
    '387':  { flag: 'ba', name: 'البوسنة والهرسك' },
    '389':  { flag: 'mk', name: 'مقدونيا الشمالية' },
    '420':  { flag: 'cz', name: 'التشيك' },
    '421':  { flag: 'sk', name: 'سلوفاكيا' },
    '423':  { flag: 'li', name: 'ليختنشتاين' },
    '501':  { flag: 'bz', name: 'بليز' },
    '502':  { flag: 'gt', name: 'غواتيمالا' },
    '503':  { flag: 'sv', name: 'السلفادور' },
    '504':  { flag: 'hn', name: 'هندوراس' },
    '505':  { flag: 'ni', name: 'نيكاراغوا' },
    '506':  { flag: 'cr', name: 'كوستاريكا' },
    '507':  { flag: 'pa', name: 'بنما' },
    '509':  { flag: 'ht', name: 'هايتي' },
    '590':  { flag: 'gp', name: 'غوادلوب' },
    '591':  { flag: 'bo', name: 'بوليفيا' },
    '592':  { flag: 'gy', name: 'غيانا' },
    '593':  { flag: 'ec', name: 'الإكوادور' },
    '594':  { flag: 'gf', name: 'غويانا الفرنسية' },
    '595':  { flag: 'py', name: 'باراغواي' },
    '596':  { flag: 'mq', name: 'مارتينيك' },
    '597':  { flag: 'sr', name: 'سورينام' },
    '598':  { flag: 'uy', name: 'أوروغواي' },
    '599':  { flag: 'cw', name: 'كوراساو' },
    '670':  { flag: 'tl', name: 'تيمور الشرقية' },
    '673':  { flag: 'bn', name: 'بروناي' },
    '674':  { flag: 'nr', name: 'ناورو' },
    '675':  { flag: 'pg', name: 'بابوا غينيا الجديدة' },
    '676':  { flag: 'to', name: 'تونغا' },
    '677':  { flag: 'sb', name: 'جزر سليمان' },
    '678':  { flag: 'vu', name: 'فانواتو' },
    '679':  { flag: 'fj', name: 'فيجي' },
    '680':  { flag: 'pw', name: 'بالاو' },
    '681':  { flag: 'wf', name: 'واليس وفوتونا' },
    '682':  { flag: 'ck', name: 'جزر كوك' },
    '683':  { flag: 'nu', name: 'نيوي' },
    '685':  { flag: 'ws', name: 'ساموا' },
    '686':  { flag: 'ki', name: 'كيريباتي' },
    '687':  { flag: 'nc', name: 'كاليدونيا الجديدة' },
    '688':  { flag: 'tv', name: 'توفالو' },
    '689':  { flag: 'pf', name: 'بولينيزيا الفرنسية' },
    '690':  { flag: 'tk', name: 'توكيلاو' },
    '691':  { flag: 'fm', name: 'ميكرونيزيا' },
    '692':  { flag: 'mh', name: 'جزر مارشال' },
    '850':  { flag: 'kp', name: 'كوريا الشمالية' },
    '852':  { flag: 'hk', name: 'هونغ كونغ' },
    '853':  { flag: 'mo', name: 'ماكاو' },
    '855':  { flag: 'kh', name: 'كمبوديا' },
    '856':  { flag: 'la', name: 'لاوس' },
    '880':  { flag: 'bd', name: 'بنغلاديش' },
    '886':  { flag: 'tw', name: 'تايوان' },
    '960':  { flag: 'mv', name: 'المالديف' },
    '961':  { flag: 'lb', name: 'لبنان' },
    '962':  { flag: 'jo', name: 'الأردن' },
    '963':  { flag: 'sy', name: 'سوريا' },
    '964':  { flag: 'iq', name: 'العراق' },
    '965':  { flag: 'kw', name: 'الكويت' },
    '966':  { flag: 'sa', name: 'السعودية' },
    '967':  { flag: 'ye', name: 'اليمن' },
    '968':  { flag: 'om', name: 'عُمان' },
    '970':  { flag: 'ps', name: 'فلسطين' },
    '971':  { flag: 'ae', name: 'الإمارات العربية المتحدة' },
    '972':  { flag: 'il', name: 'إسرائيل' },
    '973':  { flag: 'bh', name: 'البحرين' },
    '974':  { flag: 'qa', name: 'قطر' },
    '975':  { flag: 'bt', name: 'بوتان' },
    '976':  { flag: 'mn', name: 'منغوليا' },
    '977':  { flag: 'np', name: 'نيبال' },
    '992':  { flag: 'tj', name: 'طاجيكستان' },
    '993':  { flag: 'tm', name: 'تركمانستان' },
    '994':  { flag: 'az', name: 'أذربيجان' },
    '995':  { flag: 'ge', name: 'جورجيا' },
    '996':  { flag: 'kg', name: 'قيرغيزستان' },
    '998':  { flag: 'uz', name: 'أوزبكستان' }
};

            let selectedCountryCode = '966';

            function populateCountries() {
                const list = document.getElementById('country-list');
                list.innerHTML = '';
                Object.keys(countryMap).forEach(code => {
                    const country = countryMap[code];
                    const item = document.createElement('div');
                    item.className = 'flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 dark:hover:bg-white/5 cursor-pointer text-xs font-bold text-slate-700 dark:text-slate-300 transition-colors';
                    item.setAttribute('data-name', country.name);
                    item.innerHTML = `
                        <img src="https://flagcdn.com/w40/${country.flag}.png" class="w-6 h-4 rounded-sm object-cover">
                        <span class="flex-1">${country.name}</span>
                        <span class="text-brand-500 bg-brand-500/10 px-2 py-0.5 rounded-md">+${code}</span>
                    `;
                    item.onclick = () => {
                        selectedCountryCode = code;
                        document.getElementById('wa_flag').src = `https://flagcdn.com/w40/${country.flag}.png`;
                        document.getElementById('wa_code_display').innerText = `+${code}`;
                        toggleCountryDropdown();
                    };
                    list.appendChild(item);
                });
            }

            function toggleCountryDropdown() {
                document.getElementById('country-dropdown').classList.toggle('hidden');
            }

            document.getElementById('country-search').addEventListener('input', (e) => {
                const term = e.target.value.toLowerCase();
                document.querySelectorAll('#country-list > div').forEach(item => {
                    const name = item.getAttribute('data-name').toLowerCase();
                    item.style.display = name.includes(term) ? 'flex' : 'none';
                });
            });

            populateCountries();

            // Communication Actions
            function sendAdminMessage(type) {
                const url = type === 'whatsapp' ? "{{ route('admin.send.whatsapp') }}" : "{{ route('admin.send.email') }}";
                let phone = document.getElementById('wa_phone').value.replace(/^0+/, '').replace(/\s+/g, '');

                if (type === 'whatsapp' && !phone) {
                    Toast.fire({ icon: 'error', title: 'يرجى إدخال رقم الهاتف' });
                    return;
                }

                const data = type === 'whatsapp' ? {
                    phone: selectedCountryCode + phone,
                    message: document.getElementById('wa_message').value,
                    _token: "{{ csrf_token() }}"
                } : {
                    email: document.getElementById('email_addr').value,
                    subject: 'تنبيه من إدارة المتجر',
                    message: document.getElementById('email_message').value,
                    _token: "{{ csrf_token() }}"
                };

                const btn = event.currentTarget;
                const originalContent = btn.innerHTML;
                btn.innerHTML = '<i class="ph ph-spinner animate-spin text-lg"></i> جاري الإرسال...';
                btn.disabled = true;

                fetch(url, {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    btn.innerHTML = originalContent;
                    btn.disabled = false;
                    if (data.success) {
                        if (type === 'whatsapp' && data.redirect_url) window.open(data.redirect_url, '_blank');
                        Toast.fire({ icon: 'success', title: data.message });
                    } else {
                        Toast.fire({ icon: 'error', title: data.message });
                    }
                })
                .catch(() => {
                    btn.innerHTML = originalContent;
                    btn.disabled = false;
                    Toast.fire({ icon: 'error', title: 'حدث خطأ غير متوقع' });
                });
            }

            // Real-time Stats Refresher
            function refreshDashboardStats() {
                fetch("{{ route('admin.dashboard.realtime') }}")
                    .then(response => response.json())
                    .then(data => {
                        updateStat('stat-total-sales', data.total_sales, true);
                        updateStat('stat-total-orders', data.total_orders);
                        updateStat('stat-pending-orders', data.pending_orders);
                        updateStat('stat-total-products', data.total_products);
                        updateStat('stat-total-users', data.total_users);
                    });
            }

            function updateStat(id, value, isCurrency = false) {
                const el = document.getElementById(id);
                if (el) {
                    const formattedValue = isCurrency ? Number(value).toLocaleString() : value;
                    if (el.innerText != formattedValue) {
                        el.classList.add('scale-110', 'text-brand-500');
                        setTimeout(() => {
                            el.innerText = formattedValue;
                            el.classList.remove('scale-110', 'text-brand-500');
                        }, 400);
                    }
                }
            }

            setInterval(refreshDashboardStats, 30000); // Every 30 seconds
        </script>
    @endpush
@endsection