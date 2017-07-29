<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\CartItem;

use Auth;

class payRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->frontendNumber = config('sensorization.setting.frontendNumber');
    }

    public function index(){
        $user_id = Auth::user()->id;
        $requests = CartItem::where('id', $user_id)->paginate(10);

        return view("front.$this->frontendNumber.user.pay-requests.view")->with(compact(
            'requests'
        ));
    }

    public function cancel($id){
        CartItem::find($id)->update([
            'canceled_from_owner' => 1
        ]);

        return back();
    }

    public function destroy($id){
        CartItem::destroy($id);
        return back();
    }
}
