@extends('back.master')
@section('title', trans2("A425", "Admin c.p - ::name", ['name' => $product->name]))

@section('content')
	<div id="product-show-page">
		@include('includes.flash-message')

		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="product-name">{{ $product->name }}</span>
				<a href="{{ route('admin.products..edit', $product->id) }}" class="btn btn-default btn-sm pull-right">
					{{ trans2("A426", "edit") }} &nbsp;
					<span class="glyphicon glyphicon-pencil"></span>
				</a>
				@include('standers.add-ons.live-status-btn')
				@include('standers.add-ons.carousel-status-btn')
				@include('standers.add-ons.new-product-status-btn')
			</div>
			<div class="panel-body">
				<div class="images">
					<h3>{{ trans2("A427", "images") }}</h3>
					<div id="zoomwall1" class="zoomwall images">
						@if(count($product->images) > 0)
							@foreach($product->images as $image)
								<img class="image-context" src='{{ asset("uploaded/products/images/full_size/$image") }}' data-name="{{ $image }}">
							@endforeach
						@else
							<img src='{{ asset("assets/images/no-image.png") }}'>
						@endif
					</div>
				</div>
                <div class="carousel">
                    <h3>{{ trans2("A428", "carousel") }}</h3>
                    <div id="zoomwall2" class="zoomwall carousels">
                        @if(count($product->carousels) > 0)
                            @foreach($product->carousels as $carousel)
                                <img class="carousel-context" src='{{ asset("uploaded/products/carousel_gallery/small/$carousel") }}' data-name="{{ $carousel }}">
                            @endforeach
                        @else
                            <img src='{{ asset("assets/images/no-image.png") }}'>
                        @endif
                    </div>
                </div>
				<hr>
				<div class="info">
					<h3>{{ trans2("A429", "::product information", ["product"=>"product"]) }}</h3>
					<p><b>{{ trans2("A430", "::product name", ["product"=>"product"]) }}</b>: {{ $product->name }}</p>
					<p><b>{{ trans2("A431", "description") }}</b>: {{ $product->description }}</p>
					<p><b>{{ trans2("A432", "price (discounted)") }}</b>: {{ number_format($product->discountPrice * DB::table('currencies')->where('title_en', $main_currency)->first()->content_refresh_to_USD) }} {{ $main_currency }}</p>
					<p><b>{{ trans2("A433", "amount") }}</b>: {{ $product->amount }}</p>
					<p><b>{{ trans2("A434", "sales") }}</b>: {{ $product->sales }}</p>
					<p><b>{{ trans2("A435", "categories") }}</b>: <br>{!! $product->categories_list !!}</p>
					<p><b>{{ trans2("A436", "created at") }}</b>: {{ $product->created_at }} <span class="rent-time">({{ $product->created_at->diffForHumans() }})</span></p>
					<p><b>{{ trans2("A437", "updated at") }}</b>: {{ $product->updated_at }} <span class="rent-time">({{ $product->updated_at->diffForHumans() }})</span></p>
					<p><b>{{ trans2("A438", "pay by delivery") }}</b>: {{ $product->payment_on_delivery }}</p>
					<p><b>{{ trans2("A439", "pay by paypal") }}</b>: {{ $product->payment_by_paypal }}</p>
					<p><b>{{ trans2("A440", "views") }}</b>: {{ $product->view_counter }}</p>
					<p class="tags">
						<b>{{ trans2("A441", "tags") }}</b>:
						@if(count($products_tags) > 0) 
							@foreach($products_tags as $tag)
								<a href="/admin/products/tags/{{ $tag }}">{{ $tag }}</a>
							@endforeach
						@else
							{{ trans2("A442", "no tags with this ::product", ["product"=>"product"]) }}
						@endif
					</p>
				</div>
			</div>
		</div>
	</div>
@stop


@section('head-css')
	<link rel="stylesheet" type="text/css" href="./packages/zoomwall.js/zoomwall.css">
@stop

@section('head-js')
	<script type="text/javascript" src="./packages/zoomwall.js/zoomwall.js"></script>
	<script>
		window.onload = function() {
			zoomwall.create(document.getElementById('zoomwall1'), true);
			zoomwall.create(document.getElementById('zoomwall2'), true);
		};
	</script>
@stop