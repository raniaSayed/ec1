<?php

namespace App\Http\Requests\Product\Create;
use App\Http\Requests\Request;

class Step2Request extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "product_tags" => "regex:~^[\p{L}\s(-_.)]+$~iu",
            "is_carousel_live" => "required|boolean",
            "is_new" => "required|boolean",
            "is_live" => "required|boolean",
            "is_payment_on_delivery" => "required|boolean",
            "is_payment_by_paypal" => "required|boolean",
            'primary_image_id' => 'numeric|min:1',
            'primary_carousel_id' => 'numeric|min:1',
            "create_again" => "required|boolean"
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
