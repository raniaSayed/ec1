<?php

namespace App\Http\Controllers\Admin\Products;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Logic\Product\ProductRepository;

use App\Models\Product\Product;
use App\Models\Product\LiveCarousel;

use DB;

class carouselController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_function:carousel_controllers', ['only' => 'store']);
    }

    public function index(){
        $products = Product::orderBy('id', 'DESC')->products_carousel()->paginate(10);

        $productRepository = new ProductRepository;
        $products = $productRepository->optimizeCarouselController($products);     

        return view('back.products.carousel.view')->withProducts($products);
    }

    public function liveStatus(Request $request){
        $input = (object) $request->all();
        $product_live_status = Product::find($input->product_id)->is_live;

        if($input->status == 1){
            LiveCarousel::where("product_id", $input->product_id)->delete();
            $result = 0;
        } elseif($input->status == 0) {
            $productCarousel = new LiveCarousel;
            $productCarousel->product_id = $input->product_id;
            $productCarousel->save();
            $result = 1;
        }

        return json_encode($result);
    }

    public function setPrimary(Request $request){
        $product_id = $request->input('product_id');
        $filename = $request->input('filename');

        $new_carousel_id = DB::table('products_carousel')->where('carousel_name', $filename)->first()->id;

        $product = Product::find($product_id);
        $product->primary_carousel_id = $new_carousel_id;
        $product->save();

        return 'true';
    }
}
