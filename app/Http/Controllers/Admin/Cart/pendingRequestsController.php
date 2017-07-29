<?php

namespace App\Http\Controllers\Admin\Cart;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Logic\Product\ProductRepository;

use App\Models\CartItem;
use App\Models\Product\Product;

use DB;

class pendingRequestsController extends Controller
{
    public function __construct(){
        $this->middleware('admin_function:carts_controls');
    }

    public function index(){
    	$cart_products = CartItem::where('status', 0)->updates_withPaginate(5);

    	return view("back.cart.pending-requests")->with(compact(
            'cart_products'
        ));
    }

    public function accept(Request $request){
        $input = (object) $request->all();

        $cart_item = CartItem::find($input->item_id);
        $cart_item->status = 2;
        $cart_item->accepted_at_timestamps = time();
        $cart_item->save();

        $target = Product::find($input->product_id);
        $needed_quantity = $input->needed_quantity;

        if($target->first()->amount != null){
            $target->decremental('amount', $needed_quantity);
        }

        $target->increment('sales', $needed_quantity);

        return back();
    }

    public function reject($id){
        CartItem::find($id)->update([
            'status' => 1
        ]);

        return back();
    }

    /*public function destroy($id){
    	CartItem::destroy($id);
    	return back();
    }*/
}
