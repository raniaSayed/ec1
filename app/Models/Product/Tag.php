<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;
    protected $table = "products_tags";

    public static function rules(){
    	return [
    		'tag_name' => "required|unique:products_tags|min:2|max:50|regex:~^[0-9\p{L}_]+$~iu",
    	];
    }

    public function products(){
    	return $this->belongsToMany('App\Models\Product\Product', 'products_tags_relationship', 'tag_id', 'product_id');
    }
}
