@extends("back.master")
@section('title', trans2("A222", "Admin c.p - cart items (pending requests)"))

@section("content")
	<div id="cart-view-page">
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans2("A223", "cart items") }} - {!! trans2("A224", "pending requests <small>(not cashed ::products yet)</small>", ["products"=>"products"]) !!}
			</div>
			<div class="panel-body">
				@if(count($cart_products) == 0)
					<h3 class="text-center">
						{{ trans2("A225", "no pending requests.") }}
						<a href="/admin/products">{{ trans2("A226", "::products page", ["products"=>"products"]) }}</a>
					</h3>
				@else
					<div class="container-fluid">
						<div id="response-table">
							<table class="table table-striped table-bordered ps-view">
								<thead>
									<tr>
										<th>{{ trans2("A227", "image") }}</th>
										<th width="20%">{{ trans2("A228", "name") }}</th>
										<th>{{ trans2("A229", "price") }}</th>
                                        <th>{{ trans2("A230", "requested quantity") }}</th>
										<th>{{ trans2("A231", "current amount") }}</th>
										<th>{{ trans2("A232", "payment method") }}</th>
										<th>{{ trans2("A233", "created at") }}</th>
										<th>{{ trans2("A234", "options") }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($cart_products as $product)
										<tr>
											<td data-title='{{ trans2("A227") }}'>
                                                @if(!is_null($product->product_image))
                                                    <img src='{{ asset("uploaded/products/images/icon_size/$product->product_image") }}' width="80px">
                                                @else
                                                    <img src='{{ asset("assets/images/no-image.png") }}' width="80px">
                                                @endif
											</td>
											<td data-title='{{ trans2("A228") }}' width="10%">{{ $product->product_name }}</td>
											<td data-title='{{ trans2("A229") }}'>{{ number_format($product->product_price * DB::table('currencies')->where('title_en', $main_currency)->first()->content_refresh_to_USD) }} {{ $product->product_currency }}</td>
											<td data-title='{{ trans2("A230") }}'>{{ $product->product_quantity }}</td>
											<td data-title='{{ trans2("A231") }}'>{{ $product->current_amount }}</td>
											<td data-title='{{ trans2("A232") }}'>{{ $product->payment_method }}</td>
                                            <td data-title='{{ trans2("A233") }}'>{{ $product->created_at }}</td>
											<td data-title='{{ trans2("A234") }}' width="12%">
												{!! Form::open(["url"=>"/admin/review-cart/pending-requests/accept"]) !!}
													{!! Form::hidden('item_id', $product->id) !!}
													{!! Form::hidden('product_id', $product->product_id) !!}
													{!! Form::hidden('needed_quantity', $product->product_quantity) !!}
													<button type="submit" class="btn btn-primary btn-xs">{{ trans2("A235", "Accept") }}</button>
												{!! Form::close() !!}
												{!! Form::open(["url"=>"/admin/review-cart/pending-requests/reject/$product->id"]) !!}
													<button type="submit" class="btn btn-danger btn-xs" aria-label="Left Align">
														<span class="glyphicon glyphicon-pause" aria-hidden="true"></span> {{ trans2("A236", "Rejected") }}
													</button>
												{!! Form::close() !!}
											</td>
										</tr>
									@endforeach				
								</tbody>
							</table>
						</div>
					</div>
				@endif
			</div>
			<div class="text-center">
				{!! $cart_products->render() !!}
			</div>
		</div>
	</div>		
@stop