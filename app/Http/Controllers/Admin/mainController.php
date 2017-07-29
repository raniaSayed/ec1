<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SiteSettingRequest;
use App\Http\Controllers\Controller;

use App\Models\Product\Product;

use DB;
use Storage;
use Session;
use Visitor;

class mainController extends Controller
{
    public function __construct(){
        $this->middleware('authenticated:super_admin', ['only' => ['getSiteSetting', 'postSiteSetting']]);
    }

    public function getIndex(){
    	$products_count = Product::count();
    	$live_products_count = Product::where("is_live", 1)->count();
    	$products_carousel_count = Product::users_roles()->products_carousel()->count();
        $visitor_count = Visitor::count();
        $visitor_count_lastWeek = Visitor::range(date("d-m-Y", time() - 7 * 24 * 60 * 60), date("d-m-Y", time()));
        $tags_count = DB::table('products_tags')->count();

        $trans_count = DB::table('translation')->count();
        $last_trans_id = DB::table('translation')->orderBy('id_num', 'desc')->first()->id_num;
        
        for ($i=1; $i <= 4; $i++) { 
            $products_categories[] = DB::table("products_categories_$i")->get();
        }

        return view("back.dashboard")->with(compact(
            'products_count', 'live_products_count', 'products_carousel_count',
            'products_categories', 'visitor_count', 'visitor_count_lastWeek', 'tags_count',
            'trans_count', 'last_trans_id'
        ));
    }

    public function getDocumentations(){
        return view('back.documentations');
    }

    public function getSiteSetting(){
        $site_setting = json_decode(Storage::get("setting.json"));

        $newStatusTimeOff = trans('admin_setting.timeOff');
        $currencies = DB::table('currencies')->lists('title_en', "id");

        return view('back.site-setting')->with(compact(
            'site_setting', 'currencies', 'newStatusTimeOff'
        ));
    }

    public function postSiteSetting(SiteSettingRequest $request){
        $inputs = (object) $request->all();

        $data1 = json_decode(Storage::get("setting.json"));

        $data1->site_name = $inputs->site_name;
        $data1->site_category = $inputs->site_category;
        $data1->customer_service_number = $inputs->customer_service_number;
        $data1->main_currency = (integer) $inputs->main_currency;
        $data1->newStatusTimeOff = $inputs->newStatusTimeOff;

        $data1->is_clear_cart_when_logout = (integer) $inputs->clear_cart_when_logout;
        $data1->is_auto_generage_product_serial_number = (integer) $inputs->auto_generage_serial_number;
        $data1->is_support_paypal_payment = (integer) $inputs->is_support_paypal_payment;

        $data1->currencies_auto_update->detector_timestamp = time();
        $data1->currencies_auto_update->duration = (integer) $inputs->currencies_auto_update_duration;

        $data2 = json_encode($data1);
        Storage::put("setting.json", $data2);

        Session::flash('flashMessage', [
            "type" => "success",
            "content" => trans2('A499', "Information was Updated successfully.")
        ]);

        return back();
    }
}
