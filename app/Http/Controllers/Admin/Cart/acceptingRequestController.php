<?php

namespace App\Http\Controllers\Admin\Cart;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Logic\Product\ProductRepository;

use App\Models\CartItem;
use App\Models\Product\Product;

use Session;

class acceptingRequestController extends Controller
{
    public function __construct(){
        $this->middleware('admin_function:carts_controls');
    }

    public function index(){
        $cart_items = CartItem::where('status', 2)->paginate(5);

        return view("back.cart.accepted-requests")->with(compact(
            'cart_items'
        ));
    }

    public function pay(Request $request){
        $input = (object) $request->all();

        $cart_item = CartItem::find($input->item_id);
        $cart_item->is_payed = 1;
        $cart_item->payed_at_timestamps = time();
        $cart_item->save();

        Session::flash('flashMessage', [
            "type" => "success",
            "content" => 'The process is payed done.'
        ]);

        return back();
    }

    public function destroy($id){
        CartItem::destroy($id);
        return back();
    }
}
