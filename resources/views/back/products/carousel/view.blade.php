@extends('back.master')
@section('title', trans2("A283", "Admin c.p - carousel"))

@section('content')
	<div id="carousel-view-page">
		<div class="panel panel-default">
			<div class="panel-heading">{{ trans2("A284", "carousel ::products controlling", ["products"=>"products"]) }}</div>
			<div class="panel-body">
				<div class="container-fluid">
					@if(count($products) <= 0)
						<div class="text-center empty-content">
                            <h3>
                                {!! trans2("A285", "there's no ::products in carousel", ["products"=>"products"]) !!}
                                <small><a href='/admin/products'>{{ trans2("A286", "add carousel") }}</a></small>
                            </h3>
						</div>
					@else
						<div id="response-table">
							<table class="table table-striped sortable ps-view">
								<thead>
									<tr>
										<th>{{ trans2("A287", "image") }}</th>
										<th>{{ trans2("A288", "carousel image") }}</th>
										<th>{{ trans2("A289", "name") }}</th>
										<th>{{ trans2("A290", "sales") }}</th>
										<th>{{ trans2("A291", "price without discount") }}</th>
										<th width="15.1%">{{ trans2("A292", "options") }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($products as $product)
										<tr>
											<td data-title='{{ trans2("A287") }}' class="image">
												@include('includes.image-view')
											</td>
											<td data-title='{{ trans2("A288") }}' class="carousel">
												@include('includes.carousel-view')
											</td>
											<td data-title='{{ trans2("A289") }}'>{{ $product->name }}</td>
											<td data-title='{{ trans2("A290") }}'>{{ $product->sales }}</td>
											<td data-title='{{ trans2("A291") }}'>{{ number_format($product->price * DB::table('currencies')->where('title_en', $main_currency)->first()->content_refresh_to_USD) }} {{ $main_currency }}</td>
											<td data-title='{{ trans2("A292") }}' class="options">
												@include('standers.products.basic-options')
											</td>
										</tr>
									@endforeach				
								</tbody>
							</table>
						</div>
					@endif
				</div>
			</div>
		</div>
		<div class="text-center">
			{!! $products->render() !!}
		</div>
	</div>
@stop

@section('head-css')
	<link rel="stylesheet" type="text/css" href="./packages/bootstrap-sortable/Contents/bootstrap-sortable.css">
@stop

@section('footer-js')
	<script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>
	<script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/moment.min.js"></script>
@stop