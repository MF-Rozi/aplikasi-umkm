<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'phone' => 'required|numeric|min:6',
            'telegram_id' => 'nullable|numeric|unique:users,telegram_id,',
            'role' => 'required',
        ];
    }
}
