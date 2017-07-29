<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Product\Product;
use App\Models\Admin\Admin;
use App\Models\Currency;

use Schema;
use Visitor;
use Storage;
use Cart;
use DB;

class AppServiceProvider extends ServiceProvider
{
    public function boot() {

        $global_setting = json_decode(Storage::get('setting.json'));

        if (Schema::hasTable('visitor_registry')) {
            Visitor::log();
        }

        $this->optimizeCurrencyCollection($global_setting);
        
        view()->composer('*', function ($view) use ($global_setting) {
            for ($i = 1; $i <= 4; $i++) { 
                $p_cats[] = DB::table("products_categories_$i")->get();
            }
            
            $currencies = DB::table('currencies')->lists('title_en', "id");

            $view->with([
                'global_setting' => $global_setting,
            	'main_currency' => $currencies[$global_setting->main_currency],
        		'frontendNumber' => config('sensorization.setting.frontendNumber'),
            	'personType' => Admin::type(),
                'cart_count' => Cart::getContent()->count(),
            	'publicProdcutsCats' => $p_cats,
                'main_lang' => config('app.locale'),
                'supported_trans' => json_decode(Storage::get('supported_translations.json')),
            ]);
        });
    }

    public function register() {
    }

    protected function updateCurrenciesTable(){
        if (Schema::hasTable('currencies')) {
            $get = file_get_contents('https://spreadsheets.google.com/feeds/list/0Av2v4lMxiJ1AdE9laEZJdzhmMzdmcW90VWNfUTYtM2c/2/public/basic');
            $xml = simplexml_load_string($get);
          
            foreach($xml->entry as $element){
                Currency::where('title_en', $element->title)->update([
                    'content_refresh_to_USD' => substr($element->content, 7)
                ]);
            }
        }
    }

    protected function optimizeCurrencyCollection($global_setting){
        $currency_collection = $global_setting->currencies_auto_update;
        $duration = $currency_collection->duration; // by minutes
        $detector_timestamp = $currency_collection->detector_timestamp;

        if($detector_timestamp < time()){
            $this->updateCurrenciesTable();

            // new_detector_timestamp
            $currency_collection->detector_timestamp = time() + ($duration * 60);

            Storage::put("setting.json", json_encode($global_setting));
        }
    }
}
