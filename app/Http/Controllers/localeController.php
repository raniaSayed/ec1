<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Stichoza\GoogleTranslate\TranslateClient;

use DB;
use Session;
use Storage;
use Response;

class localeController extends Controller
{
    public function __construct(){
        $this->middleware('authenticated:super_admin', ['only' => ['postRemoveLocale']]);
    }

    public function getSetLocale($locale){
        Session::put('locale', $locale);
        return back();
    }

    public function postCreateLocale(Request $request){
        $inputs = (object) $request->all();
        $trans_key = $inputs->trans_key;

        $supported_trans = json_decode(Storage::get('supported_translations.json'));
        $supported_trans->$trans_key = [
            'content' => $inputs->trans_title,
            'display' => "0"
        ];

        $supported_trans2 = json_encode($supported_trans);
        Storage::put("supported_translations.json", $supported_trans2);

        Session::flash('flashMessage', [
            "type" => "success",
            "content" => "success add new translation"
        ]);

        return back();
    }

    public function postRemoveLocale($key){
        $supported_trans = (array) json_decode(Storage::get('supported_translations.json'));

        unset($supported_trans[$key]);

        $supported_trans2 = json_encode((object) $supported_trans);
        Storage::put("supported_translations.json", $supported_trans2);

        Session::flash('flashMessage', [
            "type" => "success",
            "content" => "success remove translation"
        ]);

        return back();
    }

    public function postAutoTrans(Request $request){
        $inputs = (object) $request->all();

        $key = $inputs->key;
        $new_content = TranslateClient::translate($inputs->trans_from, $inputs->trans_to, $inputs->content);

        $auto_trans_db_saving = json_decode(Storage::get("setting.json"))->auto_trans_db_saving;

        if($auto_trans_db_saving == "true"){
            DB::table('translation')->where('id_num', $inputs->id)->update([
                $key => $new_content
            ]);
        }

        return Response::json([
            'error' => false,
            'new_content' => $new_content,
            'code' => 200
        ], 200);
    }

    // by ajax request
    public function postAutoTransDbSaving($value){
        $data = json_decode(Storage::get("setting.json"));
        $data->auto_trans_db_saving = $value;

        Storage::put("setting.json", json_encode($data));
    }

    // by ajax request
    public function postTransDisplaying($key, $value){
        $data = json_decode(Storage::get("supported_translations.json"));
        $data->$key->display = $value;

        Storage::put("supported_translations.json", json_encode($data));
    }
}
