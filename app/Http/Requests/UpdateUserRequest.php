<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'firstName' => 'required',
            'lastName' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'district' => 'required',
            'province' => 'required',
            'state' => 'required',
            'status' => 'required',
            'telegramID' => 'nullable',
            'email' => 'required'
        ];
    }
}
