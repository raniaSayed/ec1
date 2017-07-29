<?php

namespace App\Http\Requests\NormalAdmin;

use App\Http\Requests\Request;

class AddRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => "required|min:4|max:255|regex:~^[\p{L}\s(-_.)]+$~iu",
            'email' => "required|email|max:255|unique:users",
            'password' => 'required|min:6|confirmed',
        ];
    }
}
