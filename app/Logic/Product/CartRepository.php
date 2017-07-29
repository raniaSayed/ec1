<?php

namespace App\Logic\Product;

use App\Models\CartItem;

use Storage;
use Auth;
use DB;

class CartRepository
{
    public function global_setting(){
        return json_decode(Storage::get('setting.json'));
    }

    // repeated
    public function createItem($item, $payment_method, $is_payed){
        $cart_item = new CartItem;
        $cart_item->user_id = Auth::user()->id;
        $cart_item->product_id = $item->id;

        if($item->attributes->image_name != NULL)
            $cart_item->product_image = $item->attributes->image_name;

        $cart_item->product_name = $item->name;
        $cart_item->product_price = $item->price - (($item->price * $item->attributes->discount_percentage) / 100);
        $cart_item->product_currency = DB::table('currencies')->where('id', $this->global_setting()->main_currency)->first()->title_en;
        $cart_item->product_quantity = $item->quantity;
        $cart_item->payment_method = $payment_method;
        $cart_item->is_payed = $is_payed;

        if($payment_method == 'paypal') {
            $cart_item->status = 2;
            $cart_item->accepted_at_timestamps = time();
            $cart_item->payed_at_timestamps = time();
        }

        $cart_item->save();
    }
}