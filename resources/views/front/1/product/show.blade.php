<?php
	// to stop refer to show product page after login
	if(Auth::check()){
		Session::forget('referedToProduct');
	}
?>

@extends("front.$frontendNumber.master")
@section('title', $product->name)

@section('content')
<style type="text/css">
	@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

	fieldset, label { margin: 0; padding: 0; }
	body{ margin: 20px; }
	h1 { font-size: 1.5em; margin: 10px; }

	/****** Style Star Rating Widget *****/

	.rating { 
	  border: none;
	  float: left;
	}

	.rating > input { display: none; } 
	.rating > label:before { 
	  margin: 5px;
	  font-size: 1.25em;
	  font-family: FontAwesome;
	  display: inline-block;
	  content: "\f005";
	}

	.rating > .half:before { 
	  content: "\f089";
	  position: absolute;
	}

	.rating > label { 
	  color: #ddd; 
	 float: right; 
	}

	/***** CSS Magic to Highlight Stars on Hover *****/

	.rating > input:checked ~ label, /* show gold star when clicked */
	.rating:not(:checked) > label:hover, /* hover current star */
	.rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

	.rating > input:checked + label:hover, /* hover current star when changing rating */
	.rating > input:checked ~ label:hover,
	.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
	.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
</style>
	<div id="product-show" class="container-fluid">
		<div class="row">
			<div class="col-md-{{ count($product->images) > 0 ? '7' : '12'}}">
				<div id="product-panel" class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-12 vcenter">
								<p class="p-name">
									{{ $product->name }}
								</p>
                                <span class="p-price">
                                    <b class="text-success">{{ number_format($product->discountPrice * DB::table('currencies')->where('title_en', $main_currency)->first()->content_refresh_to_USD) }} {{ $main_currency }}</b>
                                    @if($product->discount_percentage > 0)
                                        <span class="text-danger">% {{ $product->discount_percentage }}</span>
                                    @endif
                                </span>
                                <div class="right-section" product-id="{{ $product->id }}" serial-number="{{ $product->serial_number }}">
                                    <button class="btn btn-default add-to-cart">{{ trans2("A94", "Add to cart") }}</button>
                                </div>
							</div>
						</div>
					</div>
					<div class="panel-body">
						@if(Auth::check())
							@if($personType == "super_admin" || $personType == "admin")
								<a href="{{ route('admin.products..show', $product->id) }}" class="btn btn-default">{{ trans2("A95", "Show the ::product page [in Admins view]", ["product"=>"product"]) }}</a>
								<hr>
							@endif
						@endif
						<table class="table table-striped table-bordered">
							<tr>
								<td>{{ trans2("A96", "category") }}</td>
								<td>{!! $product->categories_list !!}</td>
							</tr>
							<tr>
								<td>{{ trans2("A97", "stars") }}</td>
								<td>
									@for($i = 1; $i <= $product->stars; $i++)
										<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
									@endfor
								</td>
							</tr>
							<tr>
								<td>{{ trans2("A98", "views") }}</td>
								<td>{{ $product->view_counter }}</td>
							</tr>
							<tr>
								<td>{{ trans2("A99", "Payment by delivery") }}</td>
								<td>{{ $product->payment_on_delivery }}</td>
							</tr>
							<tr>
								<td>{{ trans2("A100", "Payment by paypal") }}</td>
								<td>{{ $product->payment_by_paypal }}</td>
							</tr>
							<tr>
								<td>{{ trans2("A101", "tags") }}</td>
								<td>
									@if(count($products_tags) > 0)
										@foreach($products_tags as $tag)
											<a href="/products/search/tag/{{ $tag }}" class="tag-btn">{{ $tag }}</a>
										@endforeach
									@else
										<span class="text-warning">{{ trans2("A102", "No tags yet") }}</span>
									@endif
								</td>
							</tr>
						</table>
						<div class="lead">{{ trans2("A103", "description") }}</div>
						{{ $product->description }}
						<br /><br />

						<div class="row">
							<div class="col-md-4">
								<h3> Reviews : </h3>
								<form method="get" action="/products/review">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="product_id" value="{{ $product->id  }}">
								<fieldset class="rating">
   									
									<input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    								
									<input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
    								
									<input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    								
									<input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
									
									<input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
									
									<input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
									
									<input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
									
									<input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
									
									<input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
									
									<input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
								</fieldset>
								<label>
									what's good about this ? :
								</label> <br />
								<textarea rows=4 class="form-control" style="resize: none;overflow: hidden;" name="like"></textarea><br />
								<label>
									what's bad about this ? :
								</label> <br />
								<textarea rows=4 class="form-control" style="resize: none;overflow: hidden;" name="dislike"></textarea><br />
								<input type="submit" value="rate" class="form-control btn btn-info" />

								</form>
							</div>
							<div class="col-md-8">
								<?php
									$count = DB::table('reviews')->where('product_id','=',$product->id)->count();
									$get_product = DB::table('reviews')->where('product_id','=',$product->id)->get();
									$sum = 0;
								foreach ($get_product as $item) {
										$sum = $sum + $item->review;
									}
									if($count!=0)
										$total = $sum/$count;
								?>
								@if($count==0)
									<div>
										<center>
											<h4>No reviews for this item yet !!</h4>
										</center>
									</div>
								@else
									<div>
									<?php
										$get_5 = DB::table('reviews')->where('product_id','=',$product->id)->where('review','=',5)->orwhere('review','=',4.5)->count();

										$get_4 = DB::table('reviews')->where('product_id','=',$product->id)->where('review','=',4)->orwhere('review','=',3.5)->count();

										$get_3 = DB::table('reviews')->where('product_id','=',$product->id)->where('review','=',3)->orwhere('review','=',2.5)->count();
										
										$get_2 = DB::table('reviews')->where('product_id','=',$product->id)->where('review','=',2)->orwhere('review','=',1.5)->count();
										
										$get_1 = DB::table('reviews')->where('product_id','=',$product->id)->where('review','=',1)->orwhere('review','=',0.5)->count();
										$star5 = ($get_5/$count)*100;
										$star4 = ($get_4/$count)*100;
										$star3 = ($get_3/$count)*100;
										$star2 = ($get_2/$count)*100;
										$star1 = ($get_1/$count)*100;
									?>
										5-Star 
										<div class="progress">
  											<div class="progress-bar" role="progressbar" aria-valuenow="{{$star5}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$star5}}%;">{{$star5}}%
  											</div>
										</div>
										4-Star 
										<div class="progress">
  											<div class="progress-bar" role="progressbar" aria-valuenow="{{$star4}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$star4}}%;">{{$star4}}%
  											</div>
										</div>
										3-Star 
										<div class="progress">
  											<div class="progress-bar" role="progressbar" aria-valuenow="{{$star3}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$star3}}%;">{{$star3}}%
  											</div>
										</div>
										2-Star 
										<div class="progress">
  											<div class="progress-bar" role="progressbar" aria-valuenow="{{$star2}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$star2}}%;">{{$star2}}%
  											</div>
										</div>
										1-Star 
										<div class="progress">
  											<div class="progress-bar" role="progressbar" aria-valuenow="{{$star1}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$star1}}%;">{{$star1}}%
  											</div>
										</div>
										@foreach($get_product as $item)
											<?php
												$get_user = DB::table('users')->where('id','=',$item->user_id)->get();
												foreach ($get_user as $user) 
													$name = $user->name;
											?>
											<h2>Review from <b> {{ $name }} </b> </h2>  {{ $item->created_at }} <br / >
											<div class="pull-right"> {{$item->review}} </div>
											<h4>Good about this product : </h4>
												{{ $item->like }} <br />
											<h4>Bad about this product : </h4>
												{{ $item->dislike }} <br />
											<hr />
										@endforeach
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
            @if(count($product->images) > 0)
    			<div class="col-md-5 p-images">
    				@include("front.$frontendNumber.product.add-ons.carousel")
    			</div>
            @endif
		</div>
	</div>
@stop

@section('footer-js')
    @include("front.$frontendNumber.scripts.add-to-cart-btn")
@stop
