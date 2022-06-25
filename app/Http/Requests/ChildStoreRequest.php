<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChildStoreRequest extends FormRequest
{

    // 保護者登録、編集のバリデーションを行う
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
            'child_name' => ['required', 'string', 'max:20'],
            'code' => ['required','regex:/^[0-9]{4}$/','exists:schools,code'],
            'email' => ['required', 'string', 'email:rfc', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'gender' => ['required'],
            'tel' => ['required', 'digits_between:10,11'],
        ];
    }
}
