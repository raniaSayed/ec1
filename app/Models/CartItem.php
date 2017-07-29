<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CartItem extends Model
{
	protected $table = 'cart_items';

	public function getCreatedAtAttribute($date){
        return Carbon::createFromFormat($this->attributes['created_at'], $date)->format('d/m/Y');
    }

    public function getUpdatedAtAttribute($date){
        return Carbon::createFromFormat($this->attributes['updated_at'], $date)->format('d/m/Y');
    }

	public function scopeUpdates_withPaginate($query, $items_paginate){
		$cart_items = $query->paginate($items_paginate);

		foreach ($cart_items as $key => $value) {
    		$product = Product\Product::find($value->product_id);

            if(!is_null($product->amount)){
                $value->current_amount = $product->amount;
                $cart_items->$value = $value->current_amount;
            } else {
                $value->current_amount = 'unlimited';
                $cart_items->$value = $value->current_amount;
            }
        		
    	}

    	return $cart_items;
	}
}
