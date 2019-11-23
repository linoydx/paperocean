<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = 
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|filled|alpha_num|max:30',
            'password' => 'required|filled|between:6,20|',
            'telephone' => 'string|max:11',
            'jobnumber' => 'string|max:6',
        ];
    }
}
