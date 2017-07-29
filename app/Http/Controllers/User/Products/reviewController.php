<?php

namespace App\Http\Controllers\User\Products;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use DB;
use Auth;
class reviewController extends Controller
{
    public function review(){
    	if(Auth::guest()){
    		return Redirect::to('login');
    	}else{
    		$id = Auth::user()->id;
    		$inputs = Input::all();
	    	$rate = $inputs['rating'];
	    	$pid = $inputs['product_id'];
	    	$good = $inputs['like'];
	    	$bad = $inputs['dislike'];
	    	$date = new \DateTime;

	    	DB::table('reviews')->insert([
	    		'product_id' => $pid,
	    		'user_id' => $id,
	    		'review' => $rate,
	    		'like' => $good,
	    		'dislike' => $bad,
	    		'created_at' => $date,
				'updated_at' => $date
	    		]);
	    	$get_reviews = DB::table('reviews')->where('product_id','=',$pid)->get();
	    	$count = DB::table('reviews')->where('product_id','=',$pid)->count();
	    	$sum = 0;
	    	foreach($get_reviews as $review)
	    		$sum = $sum + $review->review;
	    	if($count!=0)
	    		$total = $sum/$count;
	    	
	    	if($total<0.25)
	    		$star = 0;
	    	elseif($total>=0.25&&$total<0.75)
	    		$star = 0.5;
	    	elseif($total>=0.75&&$total<1.25)
	    		$star = 1;
	    	elseif($total>=1.25&&$total<1.75)
	    		$star = 1.5;
	    	elseif($total>=1.75&&$total<2.25)
	    		$star = 2;
	    	elseif($total>=2.25&&$total<2.75)
	    		$star = 2.5;
	    	elseif($total>=2.75&&$total<3.25)
	    		$star = 3;
	    	elseif($total>=3.25&&$total<3.75)
	    		$star = 3.5;
	    	elseif($total>=3.75&&$total<4.25)
	    		$star = 4;
	    	elseif($total>=4.25&&$total<4.75)
	    		$star = 4.5;
	    	elseif($total>=4.75&&$total<5.25)
	    		$star = 5;
	    	else
	    		$star = 0;
	    	DB::table('products')->where('id','=',$pid)->update(['stars' => $star]);
	    	return Redirect::back();	
    	}
    	
    }
}
