<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'phone' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập tên',
            'email.required' => 'Bạn chưa nhập vào email',
            'email.email' => 'Email chưa đúng định dạng. Ví dụ: abc@gmail.com...',
            'email.unique' => 'Email đã được dùng. Hãy đổi email khác',
            'password.required' => 'Bạn chưa nhập vào password',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.'
        ];
    }
}
