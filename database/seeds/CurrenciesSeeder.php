<?php

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $get = file_get_contents('https://spreadsheets.google.com/feeds/list/0Av2v4lMxiJ1AdE9laEZJdzhmMzdmcW90VWNfUTYtM2c/2/public/basic');
        $xml = simplexml_load_string($get);
      
        foreach($xml->entry as $element){
            $currency = new Currency;
            $currency->title_en = $element->title;
            $currency->content_refresh_to_USD = substr($element->content, 7);
            $currency->save();
        }
    }
}
