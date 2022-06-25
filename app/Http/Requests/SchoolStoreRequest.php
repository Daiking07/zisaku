<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolStoreRequest extends FormRequest
{
    // 施設登録、編集のバリデーションを行うクラス
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
            'school_name' => ['required', 'string', 'max:20'],
            'code' => ['required','regex:/^[0-9]{4}$/','unique:schools,code'],
            'principal' => ['required','string','max:20'],
            'email' => ['required', 'string', 'email:rfc', 'max:100', 'unique:users', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'password＿confirmation' => ['required', 'string', 'min:8', 'confirmed'],
            'postal_code' => ['required', 'regex:/^[0-9]{3}-[0-9]{4}$/'],
            'pref_id' => ['required'],
            'city' => ['required', 'max:50',],
            'town' => ['required', 'max:50'],
            'building' => ['max:50'],
            'tel' => ['required', 'digits_between:10,11'],
        ];
    }
}
