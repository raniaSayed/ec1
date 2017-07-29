<div class="row">
	@foreach($products as $product)
		<div class="item">
			<div class="panel" product-id="{{ $product->id }}" serial-number="{{ $product->serial_number }}">
				@if($product->is_new)
					<div class="edge-corner">
						<img src="front/helper_images/new-corner.png">
					</div>
				@endif
				<div class="panel-body">
					<a href='/products/{{ $product->serial_number }}/{{ $product_name = implode("-", explode(" ", $product->name)) }}'>
						@if(!is_null($product->image_name))
							<img src='{{ asset("uploaded/products/images/icon_size/$product->image_name") }}'>
						@else
							<img src='{{ asset("assets/images/no-image.png") }}'>
						@endif
					</a>
				</div>
				<div class="panel-footer">
					<p class="p-name">{{ $product->name }}</p>
					<p class="p-price">
						@if($product->discount_percentage > 0)
							<del>{{ number_format($product->price * DB::table('currencies')->where('title_en', $main_currency)->first()->content_refresh_to_USD) }} {{ $main_currency }}</del>
							&nbsp;
						@endif
						<b class="text-success">{{ number_format($product->discountPrice * DB::table('currencies')->where('title_en', $main_currency)->first()->content_refresh_to_USD) }} {{ $main_currency }}</b>
					</p>
					<p class="p-sales">{{ trans2("A44", "sales: ") }} {{ $product->sales }}</p>
					<p class="p-amount">{{ trans2("A45", "amount: ") }} {{ $product->amount }}</p>
					<div class="options">
						<div class="add-to-cart">
							<button class="btn btn-link" title="{{ trans2('A46', 'Add to cart') }}" aria-hidden="true" data-toggle="tooltip" data-placement="top">
								<span class="glyphicon glyphicon-shopping-cart"></span>
							</button>
						</div>
						<div class="product-details">
							<a class="btn btn-link" href='/products/{{ $product->serial_number }}/{{ $product_name }}'>
								{{ trans2("A47", "read more") }}
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach
</div>

@include("front.$frontendNumber.scripts.add-to-cart-btn")
