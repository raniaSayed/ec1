<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Storage;
use Session;

class ajaxRequestController extends Controller
{
    public function postBackendLeftnavStatus(Request $request){
    	// set boolean validation
    	$resize_status = $request->input('status');
        Session::set('leftnav_resize_status', $resize_status);

    	return $resize_status;
    }
}
