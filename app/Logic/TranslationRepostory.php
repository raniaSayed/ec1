<?php

namespace App\Logic;

use DB;
use Storage;

class TranslationRepostory
{
    public function storeData(){
        $supported_translations = (array) json_decode(Storage::get('supported_translations.json'));
        
        $translation = DB::table('translation')
            ->select(array_merge(['caller'], array_keys($supported_translations)))
            ->get();

        if(count($translation) >= 1){
            Storage::put('translation.json', json_encode((object) $translation));
        }
        
        return true;
    }
}