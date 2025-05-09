<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', 'unique:posts'],
            'content' => ['required', 'string', 'min:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề không được để trống',
            'title.unique' => 'Tiêu đề này đã tồn tại',
            'content.required' => 'Nội dung không được để trống',
            'content.min' => 'Nội dung phải có ít nhất 50 ký tự',
        ];
    }
} 