<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChildUpdateRequest extends FormRequest
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
            'child_name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email:rfc', 'max:100', 'unique:users,email,' . Auth::user()->email . ',email'],
            'tel' => ['required', 'digits_between:10,11'],
        ];
    }
}
