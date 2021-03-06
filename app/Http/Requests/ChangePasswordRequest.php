<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required|min:6',
            'password' => 'required|min:6|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => '旧密码不能为空',
            'old_password.min' => '旧密码不能少于6位'
        ];
    }
}
