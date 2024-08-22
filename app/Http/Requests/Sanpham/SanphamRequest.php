<?php

namespace App\Http\Requests\Sanpham;

use Illuminate\Foundation\Http\FormRequest;

class SanphamRequest extends FormRequest
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
            'hinhanh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tensanpham' => 'required',
            'gia' => 'required',
            'mota' => 'required',
            'sale' => 'required',
            'soluong' => 'required',
            'file' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'tensanpham.required' => 'Bạn chưa nhập vào tên sản phẩm',
            'gia.required' => 'Bạn chưa nhập vào giá',
            'mota.required' => 'Bạn chưa nhập vào mô tả',
            'sale.required' => 'Bạn chưa nhập vào sale',
            'soluong.required' => 'Bạn chưa nhập vào số lượng',
            'file.required' => 'Bạn chưa nhập vào hình ảnh',
        ];
    }
}
