@extends("front.$frontendNumber.user.master")
@section('title', trans2("A109", "My cart"))

@section('content')
	<div id="cart-view-page">
        @include('includes.flash-message')
        @include('includes.back-error')

		<div class="panel panel-default">
			<div class="panel-heading">
				<b>{{ trans2("A110", "cart items") }}</b>
			</div>
			<div class="panel-body">
				@if(Cart::isEmpty())
    				<div class="container-fluid empty-cart">
    					<div class="text-center">
    						<img src="./front/helper_images/empty-cart.png">
    						<h3 class="text-center">
    							<a href="/products">{{ trans2("A111", "Shopping now") }}</a>
    						</h3>
    					</div>
    				</div>
				@else
					<div class="container-fluid">
						{!! Form::open(["url"=>"/paypal-payment"]) !!}
						<?php $i = 1; ?>
						<div id="response-table">
							<table class="table table-hover table-bordered table-striped">
								<thead>
									<tr>
                                        <th></th>
										<th>{{ trans2("A112", "image") }}</th>
										<th width="20%">{{ trans2("A113", "name") }}</th>
										<th>{{ trans2("A114", "discount") }}</th>
										<th>{{ trans2("A115", "quantity (piece)") }}</th>
										<th>{{ trans2("A116", "price (1 piece)") }}</th>
										<th>{{ trans2("A117", "price (all pieces)") }}</th>
                                        <th>{{ trans2("A118", "delivery status") }}</th>
										<th width="8%">{{ trans2("A119", "options") }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($cart_total_items as $item)
										<tr data-item-id="{{ $item->id }}">
                                            <td>
                                                {!! Form::checkbox("checked_item_$i", 1, null, ["class"=>"select-item"]) !!}
                                            </td>
											<td data-title='{{ trans2("A112") }}'>
												@if(!is_null($item->attributes->image_name))
													<img src='{{ asset("uploaded/products/images/icon_size/".$item->attributes->image_name) }}' style="width: 80px;">
												@else
													<img src='{{ asset("assets/images/no-image.png") }}' width="80px">
												@endif
											</td>
											<td data-title='{{ trans2("A113") }}'>{{ $item->name }} {{ Form::hidden("item_name_$i", $item->name) }}</td>
											<td data-title='{{ trans2("A114") }}'>{{ $item->attributes->discount_percentage }}%</td>
											<td data-title='{{ trans2("A115") }}'>
												{{ $item->quantity }}
												{{ Form::hidden("item_quantity_$i", $item->quantity) }}
											</span>
											</td>
											<td data-title='{{ trans2("A116") }}'>
                                                @if($item->attributes->discount_percentage > 0)
												    <del>
                                                        {{ number_format($item->price * DB::table('currencies')->where('title_en', $main_currency)->first()->content_refresh_to_USD) }} 
                                                        {{ $main_currency }}
                                                    </del><br>
                                                @endif
												<span>
													{{ number_format($item->attributes->discountPrice * DB::table('currencies')->where('title_en', $main_currency)->first()->content_refresh_to_USD) }} 
                                                    &nbsp; {{ $item->attributes->discountPrice }}
                                                    {{ $main_currency }}
                                                    {{ Form::hidden("item_price_$i", (integer) $item->attributes->discountPrice) }}
												</span>
											</td>
											<td data-title='{{ trans2("A117") }}' class="price-all-pieces" data-price="{{ $item->attributes->discountPrice * $item->quantity }}">
                                                @if($item->attributes->discount_percentage > 0)
												    <del>
                                                        {{ number_format($item->price * $item->quantity * DB::table('currencies')->where('title_en', $main_currency)->first()->content_refresh_to_USD) }} 
                                                        {{ $main_currency }}
                                                    </del><br>
                                                @endif
												<span>{{ number_format($item->attributes->discountPrice * $item->quantity * DB::table('currencies')->where('title_en', $main_currency)->first()->content_refresh_to_USD) }} {{ $main_currency }}</span>
											</td>
                                            <td data-title='{{ trans2("A118") }}' class="delivery-status" data-status="{{ $item->attributes->is_payment_on_delivery ? 'true' : 'false' }}">
                                                @if($item->attributes->is_payment_on_delivery)
                                                    yes
                                                @else
                                                    no
                                                @endif
                                            </td>
											<td class="options" data-title='{{ trans2("A119") }}'>
												<?php $product_name = implode("-", explode(" ", $item->name)); ?>
												<a href="/products/{{ $item->attributes->product_serial_number }}/{{ $product_name }}">
													<span class="btn btn-default btn-xs" aria-label="Left Align" item-id="{{ $item->id }}">
														<span class="glyphicon glyphicon-eye-open text-primary" aria-hidden="true"></span>
													</span>
												</a>
                                                <span class="remove-item btn btn-default btn-xs" aria-label="Left Align" item-id="{{ $item->id }}">
                                                    <span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>
                                                </span>
											</td>

                                            <?php $i++ ?>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="extra">
                            <div class="total-prices" style="display: none;">
                                <label><b>{{ trans2("A120", "total price:") }}</b></label>
                                <p></p>
                                <hr>
                            </div>
                            <div class="buttons">
                                {!! Form::hidden("selected_ids", "") !!}
                                {!! Form::hidden("items_number", $itemsCount) !!}
                                {!! Form::hidden("main_currency", $main_currency) !!}
                                <button type="submit" class="btn btn-default by-paypal-payment disabled">
                                    <i class="fa fa-paypal fa-2x" aria-hidden="true"></i>
                                    &nbsp; {{ trans2("A121", "pay by paypal") }}
                                </button>
                                {!! Form::close() !!}

                                {!! Form::open(["url"=>"/on-delivery-payment", 'class'=>"on-delivery"]) !!}
                                    {!! Form::hidden("selected_ids", "") !!}
                                    <button type="submit" class="btn btn-default on-delivery-payment disabled">
                                        <i class="fa fa-truck fa-2x" aria-hidden="true"></i>
                                        &nbsp; {{ trans2("A122", "pay on delivery") }}
                                    </button>
                                {!! Form::close() !!}

                                <a href="/my-cart/clear-cart" class="btn btn-default clear-cart" style="color: #D32F2F">
                                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                    &nbsp; {{ trans2("A123", "Clear cart") }}
                                </a>
                            </div>
    						<br>
							<a href="/products">{{ trans2("A124", "Back to products") }}</a>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
@stop

@section('head-css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@stop

@section('footer-js')
    <script type="text/javascript" data-des="clear cart">
        $(document).ready(function(){
            cartRemoveItem();

            $('.clear-cart').click(function(e){
                e.preventDefault();
                if(confirm('Are you sure to delete cart?')){
                    window.location.href = $(this).attr('href');
                }
            });
        });
    </script>

    <script type="text/javascript" data-des="payment checkbox">
        $(document).ready(function(){
            function getPaymentStatus1(_this){
                var delivery_status;

                delivery_status = _this.parents('tr').find('.delivery-status').attr('data-status');
                delivery_status = $.parseJSON(delivery_status);

                if(delivery_status) {
                    $('.on-delivery-payment').removeClass('disabled').addClass('color');
                }
                
                $('.by-paypal-payment').removeClass('disabled').addClass('color');
            }

            function getPaymentStatus2(_this){
                var delivery_status;
                delivery_status = _this.parents('tr').find('.delivery-status').attr('data-status');
                delivery_status = $.parseJSON(delivery_status);

                if(delivery_status != true) {
                    $('.on-delivery-payment').addClass('disabled').removeClass('color');
                }
            }

            $('input.select-item').change(function(){
                var _this = $(this);

                // parseJSON to change string to boolean value
                var item_checked_status = $.parseJSON(_this.is(':checked'));

                // check if is true and get values of current selector
                if(item_checked_status) {
                    getPaymentStatus1(_this);
                } else {
                    $('.on-delivery-payment, .by-paypal-payment').addClass('disabled').removeClass('color');

                    // loop on all checkboxes at else state to check for checked box and applay same function
                    $('input.select-item').each(function(){
                        var _this = $(this);

                        if(_this.is(':checked')){
                            getPaymentStatus1(_this);
                        }
                    });
                }


                var selectItem = [];

                $('input.select-item').each(function(index){
                    var _this = $(this);
                    
                    if(_this.is(':checked')){
                        getPaymentStatus2(_this);
                        selectItem[index] = 1;
                    }else {
                        selectItem[index] = 0;
                    }
                });

                //console.log(selectIds);


                if(jQuery.inArray(1, selectItem) !== -1){
                    $('.total-prices').slideDown(200);
                   
                    var itemsPricesAndCurrency = [];

                    $('input.select-item').each(function(index){
                        var _this = $(this);
                        
                        if(_this.is(':checked')){
                            var all_pieces_price = _this.parents('tr').find('.price-all-pieces').attr('data-price').toString();
                            var currency = $.trim("{{ $main_currency }}");

                            itemsPricesAndCurrency[index] = {
                                "currency": currency,
                                "price": Math.round(all_pieces_price)
                            };
                        }
                    });

                    // to sum all price of it currency separately
                    var default_a = {};
                    var itemsPricesAndCurrency2 = itemsPricesAndCurrency.reduce(function(r, e) {
                        var key = e.currency;
                        if (!default_a[key]) {
                            default_a[key] = e;
                            r.push(default_a[key]);
                        } else {
                            default_a[key].price = parseFloat(default_a[key].price);
                            default_a[key].price += parseFloat(e.price);
                        }
                        return r;
                    }, []);

                    var total_prices_content = "";

                    $.each(itemsPricesAndCurrency2, function(key, value){
                        total_prices_content += addCommas(value.price) + " " + value.currency + "<br>";
                    });

                    $('.total-prices p').html(total_prices_content.slice(0, -4));

                } else {
                    $('.total-prices').slideUp(200);
                }

            })
        });
    </script>

    <script type="text/javascript" data-des="toggle hidden input values">
        $(document).ready(function(){
            var selectIds = [];

            $('input.select-item').change(function(){
                var _this = $(this);
                var selected_ids = _this.parents('[data-item-id]').attr('data-item-id');
                
                if($.parseJSON(_this.is(':checked'))) {
                    // add id to selectIds
                    selectIds.push(selected_ids);
                } else {
                    // remove id from selectIds
                    selectIds = jQuery.grep(selectIds, function(value) {
                      return value != selected_ids;
                    });
                }

                var selectedIds_string = selectIds.join(',');
                $('input:hidden[name="selected_ids"]').val(selectedIds_string);
            });
        })
    </script>
@stop
