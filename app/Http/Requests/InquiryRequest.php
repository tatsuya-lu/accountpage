<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Config;

class InquiryRequest extends FormRequest
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
            'status' => ['required', Rule::in(array_keys(config('const.status')))],
            'comment' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'ステータスは必須項目です。',
            'status.in' => '無効なステータスが選択されました。',
            'comment.string' => 'コメントは文字列で指定してください。',
        ];
    }
}
