<?php

namespace App\Http\Controllers\Admin\Products;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Product\Product;
use DB;

class imageController extends Controller
{
    // same with carouselController -> setPrimary
    public function setPrimary(Request $request){
        $product_id = $request->input('product_id');
        $filename = $request->input('filename');

        $new_image_id = DB::table('products_images')->where('image_name', $filename)->first()->id;

        $product = Product::find($product_id);
        $product->primary_image_id = $new_image_id;
        $product->save();

        return 'true';
    }
}
