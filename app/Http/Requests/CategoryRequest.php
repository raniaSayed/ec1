<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Countries;

class CategoryRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // allow unicode letters + spaces + (-_)
        $regex = "~^[\p{L}\s(-_)]{1,255}$~iu";

        return [
            'name' => "required|max:255|regex:$regex",
            'table_number' => "required|numeric|min:1",
            'related_id' => 'required_if:cat_table_num,2,3,4|numeric|min:0',
        ];
    }
}
