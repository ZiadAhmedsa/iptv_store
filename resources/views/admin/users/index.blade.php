@extends('layouts.admin')

@php
    $themeColor = \App\Models\Setting::get('theme_color', '#6366f1');
@endphp


@section('title', 'العملاء')
@section('subtitle', 'إدارة قاعدة بيانات المستخدمين والصلاحيات')

@section('actions')
    <button onclick="openAddUserModal()" class="bento-button !h-11 !text-xs">
        <i class="ph ph-plus-circle text-lg"></i> إضافة عميل جديد
    </button>
@endsection

@section('content')
    <div class="space-y-8">
        <!-- Stats Summary -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bento-card p-6 flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center text-xl">
                    <i class="ph ph-users-three"></i>
                </div>
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">الإجمالي</p>
                    <p class="text-xl font-black text-slate-900 dark:text-white leading-none">{{ $users->total() }}</p>
                </div>
            </div>
            <div class="bento-card p-6 flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center text-xl">
                    <i class="ph ph-user-check"></i>
                </div>
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">نشط</p>
                    <p class="text-xl font-black text-slate-900 dark:text-white leading-none">{{ \App\Models\User::where('is_active', true)->count() }}</p>
                </div>
            </div>
            <div class="bento-card p-6 flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-red-500/10 text-red-500 flex items-center justify-center text-xl">
                    <i class="ph ph-user-minus"></i>
                </div>
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">محظور</p>
                    <p class="text-xl font-black text-slate-900 dark:text-white leading-none">{{ \App\Models\User::where('is_active', false)->count() }}</p>
                </div>
            </div>
            <div class="bento-card p-6 flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center text-xl">
                    <i class="ph ph-crown"></i>
                </div>
                <div>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">المشرفين</p>
                    <p class="text-xl font-black text-slate-900 dark:text-white leading-none">{{ \App\Models\User::where('role', 'admin')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bento-card overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 dark:border-white/5 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-slate-50/50 dark:bg-white/[0.01]">
                <div>
                    <h3 class="text-sm font-black text-slate-900 dark:text-white">سجل المستخدمين</h3>
                    <p class="text-xs text-slate-400 font-bold mt-1 uppercase tracking-widest">إدارة الصلاحيات وحالات الحسابات</p>
                </div>

                <form action="{{ route('admin.users.index') }}" method="GET" class="relative group w-full md:w-80">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="بحث بالاسم أو البريد..." class="bento-input !h-11 !text-xs !px-10">
                    <i class="ph ph-magnifying-glass absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg group-focus-within:text-brand-500 transition-colors"></i>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="text-xs font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 dark:border-white/5">
                            <th class="px-8 py-5">العميل</th>
                            <th class="px-8 py-5">بيانات التواصل</th>
                            <th class="px-8 py-5 text-center">الرتبة</th>
                            <th class="px-8 py-5 text-center">الحالة</th>
                            <th class="px-8 py-5 text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-white/5">
                        @forelse($users as $user)
                            <tr class="hover:bg-slate-50/30 dark:hover:bg-white/[0.01] transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-brand-500/10 text-brand-500 flex items-center justify-center font-black text-sm">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-brand-500 transition-colors">{{ $user->name }}</p>
                                            <p class="text-[9px] text-slate-400 font-bold mt-0.5">انضم: {{ $user->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="space-y-0.5">
                                        <p class="text-xs font-bold text-slate-600 dark:text-slate-300">{{ $user->email }}</p>
                                        <p class="text-xs text-slate-400 font-bold font-mono">{{ $user->phone ?? '---' }}</p>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-lg bg-slate-100 dark:bg-white/5 text-slate-500 dark:text-slate-400 text-xs font-black uppercase tracking-widest">
                                        {{ $user->role ?? 'user' }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @if($user->is_active)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 text-xs font-black">نشط</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-red-50 dark:bg-red-500/10 text-red-500 text-xs font-black">محظور</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <div class="flex justify-center gap-2">
                                        <!-- Edit -->
                                        <button type="button" 
                                            onclick="openEditUserModal({{ json_encode($user->only(['id', 'name', 'email', 'phone', 'role', 'is_active'])) }})"
                                            class="w-9 h-9 rounded-lg bg-slate-50 dark:bg-slate-800 text-slate-500 hover:bg-brand-500 hover:text-white transition-all flex items-center justify-center shadow-sm">
                                            <i class="ph ph-pencil-simple text-lg"></i>
                                        </button>
                                        
                                        <!-- Toggle Status -->
                                        <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-9 h-9 rounded-lg {{ $user->is_active ? 'bg-amber-50 dark:bg-amber-500/10 text-amber-500 hover:bg-amber-500' : 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-500 hover:bg-emerald-500' }} hover:text-white transition-all flex items-center justify-center shadow-sm" title="{{ $user->is_active ? 'حظر' : 'تفعيل' }}">
                                                <i class="ph {{ $user->is_active ? 'ph-user-minus' : 'ph-user-plus' }} text-lg"></i>
                                            </button>
                                        </form>

                                        <!-- Delete -->
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم نهائياً؟')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="w-9 h-9 rounded-lg bg-red-50 dark:bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all flex items-center justify-center shadow-sm">
                                                    <i class="ph ph-trash text-lg"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-24 text-center text-slate-400 text-sm font-bold italic">لا يوجد عملاء مطابقين للبحث</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="px-8 py-6 border-t border-slate-50 dark:border-white/5">
                    {{ $users->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Modals -->
    <!-- Add User Modal -->
    <div id="addUserModal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeAddUserModal()"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-lg p-6">
            <div class="bento-card p-10 bg-white dark:bg-slate-900 shadow-2xl">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-black text-slate-900 dark:text-white">إضافة عميل جديد</h3>
                    <button onclick="closeAddUserModal()" class="text-slate-400 hover:text-red-500 transition-colors">
                        <i class="ph ph-x text-2xl"></i>
                    </button>
                </div>
                
                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">الاسم الكامل</label>
                        <input type="text" name="name" class="bento-input" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">البريد الإلكتروني</label>
                            <input type="email" name="email" class="bento-input" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">رقم الهاتف</label>
                            <input type="text" name="phone" class="bento-input" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">كلمة المرور</label>
                            <input type="password" name="password" class="bento-input" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">الصلاحية</label>
                            <select name="role" class="bento-input !py-0 h-11">
                                <option value="user">عميل (User)</option>
                                <option value="editor">محرر (Editor)</option>
                                <option value="admin">مدير (Admin)</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="bento-button !w-full !h-14 !mt-4">
                        <i class="ph ph-check-circle text-xl"></i> تأكيد الإضافة
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editUserModal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeEditUserModal()"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-lg p-6">
            <div class="bento-card p-10 bg-white dark:bg-slate-900 shadow-2xl">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-black text-slate-900 dark:text-white">تعديل بيانات العميل</h3>
                    <button onclick="closeEditUserModal()" class="text-slate-400 hover:text-red-500 transition-colors">
                        <i class="ph ph-x text-2xl"></i>
                    </button>
                </div>
                
                <form id="editUserForm" method="POST" class="space-y-6">
                    @csrf @method('PUT')
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">الاسم الكامل</label>
                        <input type="text" name="name" id="edit_name" class="bento-input" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">البريد (للقراءة فقط)</label>
                            <input type="email" id="edit_email" class="bento-input !bg-slate-50 dark:!bg-white/5 opacity-60" readonly>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">الصلاحية</label>
                            <select name="role" id="edit_role" class="bento-input !py-0 h-11">
                                <option value="user">عميل (User)</option>
                                <option value="editor">محرر (Editor)</option>
                                <option value="admin">مدير (Admin)</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest px-1">تغيير كلمة المرور (اختياري)</label>
                        <input type="password" name="password" class="bento-input" placeholder="اتركها فارغة للحفاظ على الحالية">
                    </div>
                    <button type="submit" class="bento-button !w-full !h-14 !mt-4">
                        <i class="ph ph-floppy-disk text-xl"></i> حفظ التغييرات
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function openAddUserModal() {
            document.getElementById('addUserModal').classList.remove('hidden');
        }
        function closeAddUserModal() {
            document.getElementById('addUserModal').classList.add('hidden');
        }
        function openEditUserModal(user) {
            const form = document.getElementById('editUserForm');
            form.action = `/admin/users/${user.id}`;
            document.getElementById('edit_name').value = user.name;
            document.getElementById('edit_email').value = user.email;
            document.getElementById('edit_role').value = user.role;
            document.getElementById('editUserModal').classList.remove('hidden');
        }
        function closeEditUserModal() {
            document.getElementById('editUserModal').classList.add('hidden');
        }
    </script>
    @endpush
@endsection