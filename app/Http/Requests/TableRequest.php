<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Config;

class TableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                // Rule::unique('admin_users')->ignore($this->route('user')),
                Rule::unique('admin_users'),
                'max:255',
            ],
            'password' => 'nullable|string|min:8',
            'sub_name' => 'required|string|max:255',
            'tel' => 'required|regex:/^[0-9]{3}[0-9]{4}[0-9]{4}$/',
            'post_code' => 'required|regex:/^[0-9]{3}[0-9]{4}$/',
            'prefecture' => 'required',
            'city' => 'required|string',
            'street' => 'required|string',
            'admin_level' => 'required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '名前は必須項目です。',
            'name.string' => '名前は文字列で入力してください。',
            'name.max' => '名前は255文字以内で入力してください。',
            'email.required' => 'メールアドレスは必須項目です。',
            'email.email' => 'メールアドレスの形式が正しくありません。',
            'email.unique' => '指定されたメールアドレスは既に使用されています。',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',
            'password.nullable' => 'パスワードは文字列で入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'sub_name.required' => 'サブ名は必須項目です。',
            'sub_name.string' => 'サブ名は文字列で入力してください。',
            'sub_name.max' => 'サブ名は255文字以内で入力してください。',
            'tel.required' => '電話番号は必須項目です。',
            'tel.regex' => '電話番号の形式が正しくありません。',
            'post_code.required' => '郵便番号は必須項目です。',
            'post_code.regex' => '郵便番号の形式が正しくありません。',
            'prefecture.required' => '都道府県は必須項目です。',
            'city.required' => '市区町村は必須項目です。',
            'city.string' => '市区町村は文字列で入力してください。',
            'street.required' => '番地以下は必須項目です。',
            'street.string' => '番地以下は文字列で入力してください。',
            'admin_level.required' => '管理者レベルは必須項目です。',
        ];
    }
}
