@extends("back.master")
@section('title', trans2("A207", "Admin c.p - cart items (accepted requests)"))

@section("content")
	<div id="cart-view-page">
        @include('includes.flash-message')
        @include('includes.back-error')
        
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans2("A208", "cart items") }} - {!! trans2("A209", "accepted requests <small>(cashed ::products)</small>", ["products"=>"products"]) !!}
			</div>
			<div class="panel-body">
				@if(count($cart_items) == 0)
					<h3 class="text-center">
						{{ trans2("A210", "no accepted requests.") }}
						<a href="/admin/products">{{ trans2("A211", "::products page", ["products"=>"products"]) }}</a>
					</h3>
				@else
					<div class="container-fluid">
						<div id="response-table">
							<table class="table table-striped table-bordered ps-view">
								<thead>
									<tr>
										<th>{{ trans2("A212", "image") }}</th>
										<th>{{ trans2("A213", "name") }}</th>
										<th>{{ trans2("A214", "price") }}</th>
										<th>{{ trans2("A215", "quantity") }}</th>
										<th>{{ trans2("A216", "payment method") }}</th>
										<th>{{ trans2("A217", "created at") }}</th>
                                        <th>{{ trans2("A218", "accepted at") }}</th>
										<th>{{ trans2("A219", "options") }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($cart_items as $item)
										<tr>
											<td data-title='{{ trans2("A212") }}'>
												@if(!is_null($item->product_image))
                                                    <img src='{{ asset("uploaded/products/images/icon_size/$item->product_image") }}' height="80px">
                                                @else
                                                    <img src='{{ asset("assets/images/no-image.png") }}' width="80px">
                                                @endif
											</td>
											<td data-title='{{ trans2("A213") }}'>{{ $item->product_name }}</td>
											<td data-title='{{ trans2("A214") }}'>{{ $item->product_price }} {{ $item->product_currency }}</td>
											<td data-title='{{ trans2("A215") }}'>{{ $item->product_quantity }}</td>
											<td data-title='{{ trans2("A216") }}'>{{ $item->payment_method }}</td>
											<td data-title='{{ trans2("A217") }}'>{{ $item->created_at }}</td>
											<td data-title='{{ trans2("A218") }}'>{{ date("d/m/Y", $item->accepted_at_timestamps) }}</td>
										    <td data-title='{{ trans2("A219") }}'>
                                                {!! Form::open(["url"=>"/admin/review-cart/accepting-requests/pay"]) !!}
                                                    {!! Form::hidden('item_id', $item->id) !!}
                                                    <button type="submit" class="btn btn-{{ $item->is_payed ? 'success disabled' : 'default' }} btn-sm">{{ trans2("A220", "payed") }}</button>
                                                {!! Form::close() !!}
                                                @if(!$item->is_payed)
                                                    {!! Form::open(["url"=>"/admin/review-cart/accepting-requests/$item->id", "method"=>"DELETE"]) !!}
                                                        <button type="submit" class="btn btn-danger btn-sm" aria-label="Left Align">{{ trans2("A221", "cancel request") }}</button>
                                                    {!! Form::close() !!}
                                                @endif
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
				{!! $cart_items->render() !!}
			</div>
		</div>
	</div>
@stop