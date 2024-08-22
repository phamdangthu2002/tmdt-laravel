<?php

namespace App\Http\Requests\Danhmuc;

use Illuminate\Foundation\Http\FormRequest;

class DanhmucFormRequest extends FormRequest
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
            'categoryName' => 'required',
            'categoryDescription' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'categoryName.required' => 'Bạn chưa nhập vào tên danh mục',
            'categoryDescription.required' => 'Bạn chưa nhập mô tả',
        ];
    }
}
