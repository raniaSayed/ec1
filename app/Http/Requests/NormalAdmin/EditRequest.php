<?php

namespace App\Http\Requests\NormalAdmin;

use App\Http\Requests\Request;

class EditRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => "required|min:4|max:255|regex:~^[\p{L}\s(-_.)]+$~iu",
        ];
    }
}
