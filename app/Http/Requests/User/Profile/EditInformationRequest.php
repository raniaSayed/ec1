<?php

namespace App\Http\Requests\User\Profile;

use App\Http\Requests\Request;
use App\Models\Countries;

class EditInformationRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $countries_count = Countries::count();

        // like AuthController -> validator
        return [
            "name" => "required|min:3|max:255|regex:~^[\p{L}\s(-_.)]+$~iu",
            "country_id" => "numeric|max:$countries_count",
            "address" => "string|min:6|max:255|regex:~^[\p{L}\s(-_.)]+$~iu",
        ];
    }
}
