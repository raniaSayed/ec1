<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TranslationSeeder extends Seeder
{
    public function run()
    {
        if(Storage::has("translation.json")){
            $translation = json_decode(Storage::get("translation.json"));

            foreach($translation as $values){
                DB::table('translation')->insert((array) $values);
            }
        } 
    }
}

