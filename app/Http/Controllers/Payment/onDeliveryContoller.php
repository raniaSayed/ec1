<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Logic\Product\CartRepository;

use App\User;

use Session;
use Cart;
use Auth;

class onDeliveryContoller extends Controller
{
    public function postIndex(Request $request){

    	$user = User::find(Auth::user()->id);

    	if(empty($user->country_id) || empty($user->address)){

    		Session::put('payment_address', 1);
            return view("front.$this->frontendNumber.payments.delivery.pending");

    	} else {
    		$cart_items = json_decode(Cart::getContent()->toJson());
            $inputs = (object) $request->all();
            $selected_ids = explode(',', $inputs->selected_ids);

	    	foreach ($cart_items as $key => $item) {
                // must in first this item approved from user
                if(in_array($item->id, $selected_ids)){

                    $cartRepository = new CartRepository;
                    $cartRepository->createItem($item, 'delivery', 0);

                    // remove added product only
                    Cart::remove($item->id);
                }
	    	}

            return view("front.$this->frontendNumber.payments.delivery.done");
    	}
    }
}
