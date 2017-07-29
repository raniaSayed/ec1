<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\EditSuperAdminInfoRequest;
use App\Http\Controllers\Controller;

use App\User;

use Auth;
use Hash;
use Session;

class superAdminController extends Controller
{
    public function __construct(){
        $this->middleware('authenticated:super_admin');
    }

    public function getEdit(){
        $super_admin = User::find(Auth::user()->id);
        return view('back.super-admin.edit')->withSuper_admin($super_admin);
    }

    public function postEdit(EditSuperAdminInfoRequest $request){
        $input = (object) $request->all();

        $superAdmin = User::find(Auth::user()->id);
        $superAdmin->name = $input->name;
        $superAdmin->email = $input->email;

        if($input->change_password == 1){
            if(!Hash::check($input->old_password, $superAdmin->value('password'))){
                return back()->withErrors(["invalid old password."]); 
            } else {
                $superAdmin->password = bcrypt($input->new_password);
            }
        }

        $superAdmin->save();

        Session::flash('flashMessage', [
            "type" => "success",
            "content" => "Information was Updated successfully."
        ]);

        return back();
    }
}
