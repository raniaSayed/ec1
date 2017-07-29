<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Countries;

class EditSuperAdminInfoRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => "required|min:3|max:50|regex:~^[\p{L}\s(-_)]+$~iu",
            'email' => "required|email|max:255|regex:~^[\p{L}\s(-_.@)]+$~iu",
            'change_password' => "required|boolean",
            'old_password' => "required_if:change_password,1|numeric",
            'new_password' => "required_if:change_password,1|numeric|min:6|confirmed",
        ];
    }
}
