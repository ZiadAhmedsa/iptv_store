@extends('layouts.admin')

@section('title', 'البريد الرسمي')
@section('subtitle', 'إرسال الرسائل والعروض للعملاء')

@section('content')
<div class="space-y-8">

    <!-- Header Stats / Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bento-card relative overflow-hidden group">
            <div class="absolute -right-12 -top-12 w-32 h-32 bg-brand-500/10 rounded-full blur-2xl group-hover:bg-brand-500/20 transition-all duration-500"></div>
            <div class="flex items-center gap-5 relative z-10">
                <div class="w-16 h-16 rounded-2xl brand-gradient flex items-center justify-center text-white shadow-lg shadow-brand-500/30">
                    <i class="ph-fill ph-users-three text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-slate-500 dark:text-slate-400 font-bold text-sm uppercase tracking-widest">إجمالي العملاء</h3>
                    <p class="text-3xl font-black text-slate-900 dark:text-white">{{ $users->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bento-card relative overflow-hidden group">
            <div class="absolute -right-12 -top-12 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl group-hover:bg-emerald-500/20 transition-all duration-500"></div>
            <div class="flex items-center gap-5 relative z-10">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white shadow-lg shadow-emerald-500/30">
                    <i class="ph-fill ph-paper-plane-tilt text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-slate-500 dark:text-slate-400 font-bold text-sm uppercase tracking-widest">نظام الإرسال</h3>
                    <p class="text-xl font-black text-slate-900 dark:text-white mt-1">جاهز للإرسال (SMTP)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Mail Composer -->
    <div class="bento-card p-0 overflow-hidden">
        <div class="p-8 border-b border-slate-100 dark:border-white/5 flex items-center justify-between">
            <h2 class="text-2xl font-black text-slate-900 dark:text-white flex items-center gap-3">
                <i class="ph-duotone ph-envelope-open text-brand-500 text-3xl"></i>
                صياغة رسالة جديدة
            </h2>
            
            <!-- Templates Dropdown -->
            <div class="relative group">
                <button type="button" class="inline-flex items-center gap-2 bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 px-5 py-3 rounded-xl font-bold text-sm text-slate-700 dark:text-slate-300 hover:border-brand-500 transition-colors">
                    <i class="ph-bold ph-magic-wand text-brand-500"></i>
                    قوالب جاهزة
                    <i class="ph-bold ph-caret-down text-slate-400 ml-1"></i>
                </button>
                <div class="absolute left-0 mt-2 w-64 bg-white dark:bg-base-cardDark border border-slate-200 dark:border-white/10 rounded-2xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 overflow-hidden">
                    @foreach($templates as $index => $template)
                        <button type="button" onclick="loadTemplate({{ $index }})" class="w-full text-right px-5 py-4 hover:bg-slate-50 dark:hover:bg-white/5 border-b border-slate-100 dark:border-white/5 last:border-0 transition-colors flex items-center justify-between group/item">
                            <span class="font-bold text-slate-700 dark:text-slate-300">{{ $template['name'] }}</span>
                            <i class="ph-bold ph-arrow-left text-brand-500 opacity-0 group-hover/item:opacity-100 transform translate-x-2 group-hover/item:translate-x-0 transition-all"></i>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <form action="{{ route('admin.mail.send') }}" method="POST" class="p-8 space-y-8" id="mailForm">
            @csrf
            
            <!-- Target Selection -->
            <div class="space-y-4">
                <label class="block text-sm font-black text-slate-700 dark:text-slate-300 uppercase tracking-widest mb-4">المستلمون (To:)</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="cursor-pointer relative group">
                        <input type="radio" name="target" value="all" class="peer sr-only" checked onchange="toggleUserSelect()">
                        <div class="rounded-2xl border-2 border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-white/5 p-5 hover:bg-slate-100 dark:hover:bg-white/10 peer-checked:border-brand-500 peer-checked:bg-brand-500/5 transition-all flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-slate-200 dark:bg-white/10 flex items-center justify-center text-slate-500 dark:text-slate-400 peer-checked:brand-gradient peer-checked:text-white transition-all">
                                <i class="ph-bold ph-users-three text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-black text-slate-900 dark:text-white text-lg">جميع العملاء</h4>
                                <p class="text-sm text-slate-500 font-bold mt-1">إرسال لجميع المسجلين (نشرة/عرض)</p>
                            </div>
                        </div>
                        <div class="absolute top-4 left-4 opacity-0 peer-checked:opacity-100 text-brand-500 transition-all">
                            <i class="ph-fill ph-check-circle text-2xl"></i>
                        </div>
                    </label>

                    <label class="cursor-pointer relative group">
                        <input type="radio" name="target" value="specific" class="peer sr-only" onchange="toggleUserSelect()">
                        <div class="rounded-2xl border-2 border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-white/5 p-5 hover:bg-slate-100 dark:hover:bg-white/10 peer-checked:border-brand-500 peer-checked:bg-brand-500/5 transition-all flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-slate-200 dark:bg-white/10 flex items-center justify-center text-slate-500 dark:text-slate-400 peer-checked:brand-gradient peer-checked:text-white transition-all">
                                <i class="ph-bold ph-user text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-black text-slate-900 dark:text-white text-lg">عميل محدد</h4>
                                <p class="text-sm text-slate-500 font-bold mt-1">إرسال رسالة مخصصة لشخص واحد</p>
                            </div>
                        </div>
                        <div class="absolute top-4 left-4 opacity-0 peer-checked:opacity-100 text-brand-500 transition-all">
                            <i class="ph-fill ph-check-circle text-2xl"></i>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Specific User Select (Hidden initially) -->
            <div id="userSelectDiv" class="hidden space-y-2 transform transition-all duration-500 opacity-0 -translate-y-4">
                <label class="block text-sm font-black text-slate-700 dark:text-slate-300">اختر العميل</label>
                <select name="user_id" class="bento-input w-full">
                    <option value="">-- اختر عميلاً من القائمة --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email ?? 'لا يوجد بريد' }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Subject -->
            <div class="space-y-2">
                <label class="block text-sm font-black text-slate-700 dark:text-slate-300">عنوان الرسالة (Subject)</label>
                <input type="text" name="subject" id="mailSubject" required class="bento-input" placeholder="مثال: عرض خاص جداً بمناسبة الصيف...">
            </div>

            <!-- Body -->
            <div class="space-y-2">
                <label class="block text-sm font-black text-slate-700 dark:text-slate-300">محتوى الرسالة (Body)</label>
                <textarea name="body" id="mailBody" rows="8" required class="bento-input min-h-[250px] py-5 resize-y" placeholder="اكتب نص الرسالة هنا..."></textarea>
                <p class="text-xs text-slate-500 font-bold mt-2">
                    <i class="ph-bold ph-info"></i> التصميم الخارجي للبريد (الألوان، الشعار، التذييل) سيتم إضافته تلقائياً، أنت فقط اكتب النص.
                </p>
            </div>

            <!-- Submit Button -->
            <div class="pt-6 border-t border-slate-100 dark:border-white/5 flex items-center justify-between">
                <div class="flex items-center gap-3 text-amber-500 text-sm font-bold bg-amber-500/10 px-4 py-2 rounded-lg">
                    <i class="ph-fill ph-warning-circle text-lg"></i>
                    تأكد من تجهيز إعدادات الـ SMTP في ملف .env لضمان الإرسال.
                </div>
                
                <button type="button" onclick="confirmSend()" class="bento-button shadow-[0_10px_40px_rgba(99,102,241,0.4)]">
                    <i class="ph-bold ph-paper-plane-right text-xl"></i>
                    إرسال البريد الآن
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Raw templates data for JS -->
<script>
    const emailTemplates = @json($templates);

    function loadTemplate(index) {
        if(emailTemplates[index]) {
            document.getElementById('mailSubject').value = emailTemplates[index].subject;
            document.getElementById('mailBody').value = emailTemplates[index].body;
            
            Toast.fire({
                icon: 'success',
                title: 'تم تحميل قالب: ' + emailTemplates[index].name
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
            ? 'سيتم إرسال هذا البريد إلى جميع العملاء المسجلين. قد تستغرق العملية بعض الوقت، يرجى عدم إغلاق الصفحة.'
            : 'سيتم إرسال هذا البريد للعميل المحدد فقط.';

        Swal.fire({
            title: 'تأكيد الإرسال',
            text: msg,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6366f1',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'نعم، أرسل الآن',
            cancelButtonText: 'إلغاء',
            background: document.documentElement.classList.contains('dark') ? '#121217' : '#ffffff',
            color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#000000',
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading state
                Swal.fire({
                    title: 'جاري الإرسال...',
                    text: 'يرجى الانتظار وعدم إغلاق الصفحة.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    background: document.documentElement.classList.contains('dark') ? '#121217' : '#ffffff',
                    color: document.documentElement.classList.contains('dark') ? '#ffffff' : '#000000',
                });
                form.submit();
            }
        });
    }
</script>
@endsection
