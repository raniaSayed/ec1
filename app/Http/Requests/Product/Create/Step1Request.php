<?php

namespace App\Http\Requests\Product\Create;
use App\Http\Requests\Request;

class Step1Request extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "product_name" => "required|min:5|max:255|regex:~^[\p{L}\s(-_&',.)\x{060C}]+$~iu",
            "product_description" => "required|min:5|regex:~^[\p{L}\s(-_&',.)\x{060C}]+$~iu",
            "serial_number" => "between:0,14|regex:/^[A-Z0-9]+$/",

            "category_table_number" => "required|numeric|min:1",
            "category_id" => "required|numeric|min:1",

            "product_price" => "required|numeric|between:0.01,99999999.99",
            "discount_percentage" => "numeric|min:0|max:100",
            "product_amount" => "required_if:is_amount_unlimited,0|numeric|min:1",

            "is_start_view_now" => "boolean",
            "is_amount_unlimited" => "boolean",
            "expires_condition" => "string",

            "start_at" => "required_without:is_start_view_now|date|date_format:Y-m-d",
            "expires_at" => "required_without:expires_condition|date|date_format:Y-m-d",
            "expires_days" => "required_if:expires_condition,by_days|numeric|min:1|max:365"
        ];
    }

    public function messages()
    {
        return [
            "category_table_number.min" => "Must choose 1 category at least.",
            "category_id.min" => "Must choose 1 category at least.",
            "product_price.between" => "The price must be between 0.01 to 100M.",
        ];
    }
}
