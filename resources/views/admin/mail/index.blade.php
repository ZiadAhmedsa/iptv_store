@extends('layouts.admin')

@section('title', 'البريد الرسمي')
@section('subtitle', 'إرسال الرسائل والعروض للعملاء')

@section('content')
    <div class="space-y-12 relative">
        <!-- Ultra-luxury Background Glows -->
        <div
            class="absolute top-0 right-0 w-[500px] h-[500px] brand-gradient opacity-[0.03] dark:opacity-5 blur-[120px] rounded-full pointer-events-none -translate-y-1/2 translate-x-1/3">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-emerald-500 opacity-[0.03] dark:opacity-5 blur-[120px] rounded-full pointer-events-none translate-y-1/3 -translate-x-1/3">
        </div>

        <!-- Stats & System Status -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
            <!-- Users Stat -->
            <div
                class="bg-white/60 dark:bg-slate-900/40 backdrop-blur-3xl rounded-[3rem] p-8 border border-slate-100 dark:border-white/5 shadow-2xl relative overflow-hidden group hover:-translate-y-1 transition-transform duration-500">
                <div
                    class="absolute -right-20 -top-20 w-48 h-48 bg-brand-500/20 rounded-full blur-[60px] group-hover:bg-brand-500/30 transition-all duration-700">
                </div>
                <div class="flex items-center gap-6 relative z-10">
                    <div
                        class="w-20 h-20 rounded-[2rem] brand-gradient flex items-center justify-center text-white shadow-xl shadow-brand-500/30 group-hover:scale-105 transition-transform duration-500">
                        <i class="ph-fill ph-users-three text-4xl"></i>
                    </div>
                    <div>
                        <h3 class="text-slate-400 font-black text-[10px] uppercase tracking-[0.3em] mb-2">إجمالي العملاء
                        </h3>
                        <div class="flex items-baseline gap-2">
                            <p class="text-5xl font-black text-slate-900 dark:text-white">{{ $users->count() }}</p>
                            <span class="text-brand-500 font-bold text-sm">مستلم</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div
                class="bg-white/60 dark:bg-slate-900/40 backdrop-blur-3xl rounded-[3rem] p-8 border border-slate-100 dark:border-white/5 shadow-2xl relative overflow-hidden group hover:-translate-y-1 transition-transform duration-500">
                <div
                    class="absolute -left-20 -top-20 w-48 h-48 bg-emerald-500/20 rounded-full blur-[60px] group-hover:bg-emerald-500/30 transition-all duration-700">
                </div>
                <div class="flex items-center gap-6 relative z-10">
                    <div
                        class="w-20 h-20 rounded-[2rem] bg-gradient-to-br from-emerald-400 to-teal-600 flex items-center justify-center text-white shadow-xl shadow-emerald-500/30 group-hover:scale-105 transition-transform duration-500">
                        <i class="ph-fill ph-paper-plane-tilt text-4xl"></i>
                    </div>
                    <div>
                        <h3 class="text-slate-400 font-black text-[10px] uppercase tracking-[0.3em] mb-2">نظام الإرسال</h3>
                        <div class="flex items-center gap-3 mt-1">
                            <span class="relative flex h-4 w-4">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500"></span>
                            </span>
                            <p class="text-2xl font-black text-slate-900 dark:text-white">جاهز (SMTP)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Templates Gallery -->
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-6 px-4">
                <i class="ph-duotone ph-magic-wand text-brand-500 text-2xl"></i>
                <h2 class="text-xl font-black text-slate-900 dark:text-white">القوالب الجاهزة الذكية</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($templates as $index => $template)
                    <button type="button" onclick="loadTemplate({{ $index }})"
                        class="group text-right bg-white dark:bg-slate-900 rounded-3xl p-6 border border-slate-100 dark:border-white/5 shadow-lg hover:shadow-2xl hover:border-brand-500/30 hover:-translate-y-2 transition-all duration-300 relative overflow-hidden">
                        <div
                            class="absolute inset-0 brand-gradient opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                        </div>
                        <div class="flex items-start justify-between mb-4 relative z-10">
                            <div
                                class="w-12 h-12 rounded-2xl bg-brand-500/10 text-brand-500 flex items-center justify-center group-hover:bg-brand-500 group-hover:text-white transition-colors duration-300 shadow-inner">
                                <i class="ph-bold ph-envelope-simple-open text-xl"></i>
                            </div>
                            <span
                                class="text-[9px] font-black uppercase tracking-widest text-slate-400 bg-slate-50 dark:bg-white/5 px-3 py-1 rounded-full border border-slate-100 dark:border-white/5">
                                قالب سريع
                            </span>
                        </div>
                        <h3 class="text-lg font-black text-slate-900 dark:text-white mb-2 relative z-10">{{ $template['name'] }}
                        </h3>
                        <p
                            class="text-xs text-slate-500 dark:text-slate-400 font-bold line-clamp-2 leading-relaxed relative z-10">
                            {{ $template['subject'] }}</p>
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Main Mail Composer -->
        <div
            class="bg-white/80 dark:bg-slate-900/60 backdrop-blur-3xl rounded-[4rem] border border-slate-100 dark:border-white/5 shadow-[0_30px_80px_-20px_rgba(0,0,0,0.1)] relative overflow-hidden z-10">
            <div class="absolute top-0 left-0 w-full h-2 brand-gradient"></div>

            <div class="p-10 md:p-16 border-b border-slate-100 dark:border-white/5">
                <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">صياغة البريد الجديد</h2>
                <p class="text-slate-500 dark:text-slate-400 font-bold mt-2 text-sm">حدد المستلمين واكتب رسالتك، وسنتكفل نحن
                    بإرسالها بتصميم احترافي.</p>
            </div>

            <form action="{{ route('admin.mail.send') }}" method="POST" class="p-10 md:p-16 space-y-12" id="mailForm">
                @csrf

                <!-- Target Selection -->
                <div class="space-y-6">
                    <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.3em]">تحديد المستلمين
                        (To)</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Option: All -->
                        <label class="cursor-pointer relative group">
                            <input type="radio" name="target" value="all" class="peer sr-only" checked
                                onchange="toggleUserSelect()">
                            <div
                                class="rounded-[2rem] border-2 border-transparent bg-slate-50 dark:bg-white/[0.02] p-8 peer-checked:border-brand-500 peer-checked:bg-brand-500/5 transition-all duration-300 flex items-center gap-6 shadow-sm hover:shadow-md">
                                <div
                                    class="w-16 h-16 rounded-[1.5rem] bg-white dark:bg-slate-800 flex items-center justify-center text-slate-400 peer-checked:brand-gradient peer-checked:text-white transition-all duration-500 shadow-inner group-hover:scale-105">
                                    <i class="ph-bold ph-users-three text-2xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-black text-slate-900 dark:text-white text-xl mb-1">جميع العملاء</h4>
                                    <p class="text-xs text-slate-500 font-bold">إرسال لجميع المسجلين بقاعدة البيانات</p>
                                </div>
                            </div>
                            <div
                                class="absolute top-6 left-6 w-8 h-8 rounded-full border-2 border-slate-200 dark:border-white/10 flex items-center justify-center peer-checked:border-brand-500 peer-checked:bg-brand-500 text-transparent peer-checked:text-white transition-all">
                                <i class="ph-bold ph-check text-sm"></i>
                            </div>
                        </label>

                        <!-- Option: Specific -->
                        <label class="cursor-pointer relative group">
                            <input type="radio" name="target" value="specific" class="peer sr-only"
                                onchange="toggleUserSelect()">
                            <div
                                class="rounded-[2rem] border-2 border-transparent bg-slate-50 dark:bg-white/[0.02] p-8 peer-checked:border-brand-500 peer-checked:bg-brand-500/5 transition-all duration-300 flex items-center gap-6 shadow-sm hover:shadow-md">
                                <div
                                    class="w-16 h-16 rounded-[1.5rem] bg-white dark:bg-slate-800 flex items-center justify-center text-slate-400 peer-checked:brand-gradient peer-checked:text-white transition-all duration-500 shadow-inner group-hover:scale-105">
                                    <i class="ph-bold ph-user-focus text-2xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-black text-slate-900 dark:text-white text-xl mb-1">عميل محدد</h4>
                                    <p class="text-xs text-slate-500 font-bold">إرسال رسالة مخصصة لشخص واحد فقط</p>
                                </div>
                            </div>
                            <div
                                class="absolute top-6 left-6 w-8 h-8 rounded-full border-2 border-slate-200 dark:border-white/10 flex items-center justify-center peer-checked:border-brand-500 peer-checked:bg-brand-500 text-transparent peer-checked:text-white transition-all">
                                <i class="ph-bold ph-check text-sm"></i>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Specific User Select (Hidden initially) -->
                <div id="userSelectDiv"
                    class="hidden space-y-4 transform transition-all duration-500 opacity-0 -translate-y-4 bg-slate-50 dark:bg-white/[0.02] p-8 rounded-[2rem] border border-slate-100 dark:border-white/5">
                    <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.3em]">اختر العميل
                        المستهدف</label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors z-10">
                            <i class="ph-bold ph-magnifying-glass text-xl"></i>
                        </div>
                        <select name="user_id"
                            class="w-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/10 rounded-2xl pl-6 pr-14 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500/50 focus:border-brand-500 transition-all font-bold appearance-none relative z-0">
                            <option value="">-- اضغط لاختيار عميل --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} &nbsp; ({{ $user->email ?? 'لا يوجد بريد' }})
                                </option>
                            @endforeach
                        </select>
                        <div
                            class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none text-slate-400 z-10">
                            <i class="ph-bold ph-caret-down"></i>
                        </div>
                    </div>
                </div>

                <!-- Subject -->
                <div class="space-y-4">
                    <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.3em]">عنوان الرسالة
                        (Subject)</label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none text-slate-400 group-focus-within:text-brand-500 transition-colors">
                            <i class="ph-bold ph-text-t text-xl"></i>
                        </div>
                        <input type="text" name="subject" id="mailSubject" required
                            class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-200 dark:border-white/10 rounded-2xl pl-6 pr-14 py-5 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500/50 focus:border-brand-500 transition-all font-black text-lg placeholder:text-slate-300 dark:placeholder:text-slate-700"
                            placeholder="اكتب عنواناً جذاباً للرسالة...">
                    </div>
                </div>

                <!-- Body -->
                <div class="space-y-4">
                    <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.3em]">محتوى الرسالة
                        (Body)</label>
                    <div class="relative group">
                        <textarea name="body" id="mailBody" rows="10" required
                            class="w-full bg-slate-50 dark:bg-white/[0.02] border border-slate-200 dark:border-white/10 rounded-[2rem] p-8 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-brand-500/50 focus:border-brand-500 transition-all font-bold text-base leading-relaxed placeholder:text-slate-300 dark:placeholder:text-slate-700 resize-y"
                            placeholder="ابدأ بكتابة رسالتك هنا..."></textarea>
                    </div>

                    <div class="flex items-center gap-3 bg-brand-500/5 border border-brand-500/10 p-5 rounded-2xl">
                        <div class="w-10 h-10 rounded-xl bg-brand-500/10 flex items-center justify-center text-brand-500">
                            <i class="ph-fill ph-magic-wand text-lg"></i>
                        </div>
                        <p class="text-xs text-brand-600 dark:text-brand-400 font-bold leading-relaxed">
                            لا تقلق بشأن التصميم! سيتم تغليف رسالتك تلقائياً بقالب بريد احترافي يحمل شعار وألوان المتجر
                            لتجربة استثنائية.
                        </p>
                    </div>
                </div>

                <!-- Submit Button Area -->
                <div
                    class="pt-8 border-t border-slate-100 dark:border-white/5 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div
                        class="flex items-center gap-4 text-emerald-600 dark:text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-6 py-4 rounded-2xl w-full md:w-auto">
                        <i class="ph-fill ph-shield-check text-2xl"></i>
                        <div>
                            <p class="text-sm font-black">إرسال آمن</p>
                            <p class="text-[10px] font-bold opacity-80 uppercase tracking-widest mt-0.5">بروتوكول SMTP محمي
                            </p>
                        </div>
                    </div>

                    <button type="button" onclick="confirmSend()"
                        class="w-full md:w-auto brand-gradient px-12 py-5 rounded-2xl font-black text-xl shadow-2xl shadow-brand-500/40 hover:shadow-brand-500/60 transition-all duration-300 hover:scale-[1.03] active:scale-95 flex items-center justify-center gap-3 group border border-slate-900/10 dark:border-white/20">
                        <span class="text-slate-900 dark:text-white">إرسال البريد الآن</span>
                        <i
                            class="ph-bold ph-paper-plane-tilt text-2xl text-slate-900 dark:text-white group-hover:translate-x-[-8px] group-hover:-translate-y-1 transition-transform duration-300"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Raw templates data for JS -->
    <script>
        const emailTemplates = @json($templates);

        function loadTemplate(index) {
            if (emailTemplates[index]) {
                const subjectField = document.getElementById('mailSubject');
                const bodyField = document.getElementById('mailBody');

                // Add slight animation
                subjectField.style.transform = 'scale(0.98)';
                bodyField.style.transform = 'scale(0.98)';

                setTimeout(() => {
                    subjectField.value = emailTemplates[index].subject;
                    bodyField.value = emailTemplates[index].body;
                    subjectField.style.transform = 'scale(1)';
                    bodyField.style.transform = 'scale(1)';
                }, 150);

                Toast.fire({
                    icon: 'success',
                    title: 'تم إدراج قالب: ' + emailTemplates[index].name
                });
            }
        }

        function toggleUserSelect() {
            const target = document.querySelector('input[name="target"]:checked').value;
            const userSelectDiv = document.getElementById('userSelectDiv');
            const userSelect = document.querySelector('select[name="user_id"]');

            if (target === 'specific') {
                userSelectDiv.classList.remove('hidden');
                setTimeout(() => {
                    userSelectDiv.classList.remove('opacity-0', '-translate-y-4');
                }, 10);
                userSelect.setAttribute('required', 'required');
            } else {
                userSelectDiv.classList.add('opacity-0', '-translate-y-4');
                setTimeout(() => {
                    userSelectDiv.classList.add('hidden');
                }, 300);
                userSelect.removeAttribute('required');
            }
        }

        function confirmSend() {
            const form = document.getElementById('mailForm');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const target = document.querySelector('input[name="target"]:checked').value;
            const msg = target === 'all'
                ? 'سيتم إرسال هذا البريد إلى جميع العملاء المسجلين. يرجى الانتظار لحين اكتمال الإرسال.'
                : 'سيتم إرسال هذا البريد للعميل المحدد فقط.';

            Swal.fire({
                title: 'تأكيد الإرسال',
                text: msg,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#6366f1',
                cancelButtonColor: '#ef4444',
                confirmButtonText: '<i class="ph-bold ph-paper-plane-right ml-2"></i> نعم، أرسل الآن',
                cancelButtonText: 'إلغاء',
                background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#ffffff',
                color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#0f172a',
                customClass: {
                    popup: 'rounded-[2rem] border border-slate-100 dark:border-slate-800 shadow-2xl',
                    confirmButton: 'rounded-xl font-black px-6 py-3',
                    cancelButton: 'rounded-xl font-black px-6 py-3'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show ultra-premium loading state
                    Swal.fire({
                        title: 'جاري الانطلاق...',
                        text: 'يتم الآن توصيل رسائلك عبر سيرفراتنا...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        background: document.documentElement.classList.contains('dark') ? '#0f172a' : '#ffffff',
                        color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#0f172a',
                        customClass: {
                            popup: 'rounded-[2rem] border border-slate-100 dark:border-slate-800 shadow-2xl',
                        },
                        didOpen: () => {
                            Swal.showLoading();
                            document.querySelector('.swal2-loader').style.borderColor = '#6366f1 transparent #6366f1 transparent';
                        }
                    });
                    form.submit();
                }
            });
        }
    </script>
@endsection