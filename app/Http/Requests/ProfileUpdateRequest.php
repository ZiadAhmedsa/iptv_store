<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = Auth::user();
        
        return [
            'name' => ['required', 'string', 'max:255', 'min:2', 'regex:/^[\p{Arabic}\p{L}\s\-\.\']+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['required', 'string', 'min:7', 'max:20', 'unique:users,phone,' . $user->id],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'يرجى إدخال الاسم الكامل.',
            'name.regex' => 'الاسم يجب أن يحتوي على أحرف فقط.',
            'email.unique' => 'هذا البريد الإلكتروني مستخدم بالفعل.',
            'phone.unique' => 'هذا الرقم مستخدم بالفعل.',
        ];
    }
}
