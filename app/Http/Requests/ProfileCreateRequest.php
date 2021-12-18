<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileCreateRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'photo_profile' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'district' => 'required',
            'province' => 'required',
            'state' => 'required',
            'post_code' => 'required|numeric'
        ];
    }
}
