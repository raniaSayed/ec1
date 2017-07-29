<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Countries;
use Storage;
use DB;

class SiteSettingRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $global_setting = json_decode(Storage::get('setting.json'));
        $currencies = DB::table('currencies')->lists('title_en', "id");

        return [
            'site_name' => 'required|min:3|max:20',
            'site_category' => 'required|min:3|max:50',
            'main_currency' => "required|min:0|max:" . count($currencies),
            'customer_service_number' => "required:string|min:10",
        ];
    }
}
