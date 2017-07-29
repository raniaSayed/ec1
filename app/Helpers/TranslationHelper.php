<?php

use Illuminate\Support\Facades\DB;

function trans2($caller, $origin = null, $attrs = null) {
    $locale = config('app.locale');
    $caller_check = DB::table('translation')->where('caller', $caller)->count();
    
    if(!$caller_check){
        DB::table('translation')->insert([
            'caller' => $caller,
            'en' => $origin
        ]);

        $result = $origin;
    } else {
        $old = DB::table('translation')->select($locale)->where('caller', $caller)->first()->$locale;

        if($origin == null) {
            $result = $old;
        } else {
            if($locale == 'en'){
                if($old != $origin){
                    DB::table('translation')->where('caller', $caller)->update([
                        $locale => $origin
                    ]);
                }
                
                $result = $origin;
            } else {
                if($old == ""){
                    $result = DB::table('translation')->select('en')->where('caller', $caller)->first()->en;
                } else {
                    $result = $old;
                }
                
            }
        } 
    }

    if($attrs != null){
        foreach ($attrs as $key => $attr) {
            $result = str_replace("::$key", $attr, $result);
        }
    }

    return $result;
}