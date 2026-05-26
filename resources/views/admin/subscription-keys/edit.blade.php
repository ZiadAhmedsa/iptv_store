@extends('layouts.admin')

@section('title', 'تعديل الاشتراك المجاني')
@section('subtitle', 'تعديل بيانات الاشتراك المجاني المرتبط بالمستخدم')

@section('content')
<div class="max-w-4xl mx-auto bento-card overflow-hidden">
    <div class="p-8 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-extrabold text-slate-900 dark:text-white">تعديل الاشتراك</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">قم بتحديث بيانات الخطة المجانية التي تظهر للمستخدم.</p>
        </div>
        <a href="{{ route('admin.subscription-keys.index') }}" class="text-brand-600 dark:text-brand-400 font-bold">العودة إلى القائمة</a>
    </div>

    <div class="p-8">
        @if($errors->any())
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-500/30 text-red-700 dark:text-red-400 p-4 rounded-xl mb-6 text-sm">
                <ul class="list-disc pr-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.subscription-keys.update', $plan) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-slate-700 dark:text-slate-200 mb-2 font-bold">العنوان</label>
                <input name="title" type="text" value="{{ old('title', $plan->title) }}" required class="bento-input">
            </div>
            <div>
                <label class="block text-slate-700 dark:text-slate-200 mb-2 font-bold">Host</label>
                <input name="host" type="text" value="{{ old('host', $plan->host) }}" required class="bento-input">
            </div>
            <div>
                <label class="block text-slate-700 dark:text-slate-200 mb-2 font-bold">Username</label>
                <input name="username" type="text" value="{{ old('username', $plan->username) }}" required class="bento-input">
            </div>
            <div>
                <label class="block text-slate-700 dark:text-slate-200 mb-2 font-bold">Password</label>
                <input name="password" type="text" value="{{ old('password', $plan->password) }}" required class="bento-input">
            </div>
            <div>
                <label class="block text-slate-700 dark:text-slate-200 mb-2 font-bold">مدة الاشتراك (بالأيام)</label>
                <input name="duration_days" type="number" value="{{ old('duration_days', $plan->duration_days) }}" required class="bento-input">
            </div>
            <div>
                <label class="block text-slate-700 dark:text-slate-200 mb-2 font-bold">ملاحظات (تظهر للعميل)</label>
                <textarea name="description" rows="3" class="bento-input">{{ old('description', $plan->description) }}</textarea>
            </div>
            <div>
                <label class="block text-slate-700 dark:text-slate-200 mb-2 font-bold">بريد المستخدم المرتبط</label>
                <input name="assigned_email" type="email" value="{{ old('assigned_email', $plan->assigned_email) }}" required list="userEmails" class="bento-input" placeholder="user@example.com">
                <datalist id="userEmails">
                    @foreach($userEmails as $userEmail)
                        <option value="{{ $userEmail }}">
                    @endforeach
                </datalist>
            </div>
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="is_active" value="1" class="h-4 w-4 text-brand-600 rounded border-slate-300 focus:ring-brand-500" {{ old('is_active', $plan->is_active) ? 'checked' : '' }}>
                <label for="is_active" class="text-slate-500 dark:text-slate-300 font-bold">نشط</label>
            </div>
            <div class="pt-4">
                <button type="submit" class="bento-button w-full">حفظ التعديلات</button>
            </div>
        </form>
    </div>
</div>
@endsection
