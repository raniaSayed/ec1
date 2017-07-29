@extends('back.master')
@section('title', trans2("A443", "::products", ["products"=>"products"]))

@section('content')
	<div id="products-view-page">
		@include('back.products.add-ons.filter-bar')

		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans2("A444", "description") }}
				<a href="{{ route('admin.products..create') }}/step/1" class="btn btn-default btn-sm pull-right" title='{{ trans2("A445", "create a new ::product", ["product"=>"product"]) }}'>
					<span class="glyphicon glyphicon-plus"></span>
				</a>
				<a href="/admin/products/carousel" class="btn btn-default btn-sm pull-right" title='{{ trans2("A446", "view carousel") }}'>
					<span class="glyphicon glyphicon-picture"></span>
				</a>
			</div>
			<div class="panel-body">
				<div class="container-fluid">
					@if(count($products) == 0)
						<div class="text-center empty-content">
							<h3>{{ trans2("A447", "no ::products yet", ["products"=>"products"]) }}</h3>
						</div>
					@else
						<div id="response-table">
							<table class="table table-striped table-hover sortable ps-view">
								<thead>
									<tr>
										<th>{{ trans2("A448", "image") }}</th>
										<th width="20%">{{ trans2("A449", "name") }}</th>
										<th>{{ trans2("A450", "price (After discount)") }}</th>
										<th>{{ trans2("A451", "amount") }}</th>
										<th class="bg-success">{{ trans2("A452", "sales") }}</th>
										<th>{{ trans2("A453", "live time") }} </th>
										<th width="15.1%">{{ trans2("A454", "options") }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($products as $product)
										<tr>
											<td data-title='{{ trans2("A448") }}' class="image">
												@include('includes.image-view')
											</td>
											<td data-title='{{ trans2("A449") }}'>{{ $product->name }}</td>
											<td data-title='{{ trans2("A450") }}'>
												{{ number_format($product->discountPrice * DB::table('currencies')->where('title_en', $main_currency)->first()->content_refresh_to_USD) }} {{ $main_currency }}
												@if($product->discount_percentage > 0)
													<label class="label label-default">{{ trans2("A455", "off ::number%", ['number' => $product->discount_percentage]) }}</label>
												@endif
											</td>
											<td data-title='{{ trans2("A451") }}'>{{ $product->amount }}</td>
											<td data-title='{{ trans2("A452") }}' class="bg-success">{{ $product->sales }}</td>
											<td data-title='{{ trans2("A453") }}' class="live-time">
												{{ trans2("A456", "from") }} <br>
												{{ $product->start_at }}
												<hr>
												{{ trans2("A457", "to") }} <br>
												{{ $product->expires_at }}
											</td>
											<td data-title='{{ trans2("A454") }}' class="options">
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
			@if(isset($searchParameters))
				<!-- For search sections -->
				{!! $products->appends($searchParameters)->render() !!}
			@else
				<!-- For normal view -->
				{!! $products->render() !!}
			@endif
		</div>
	</div>
@stop

@section('head-css')
	<link rel="stylesheet" type="text/css" href="./packages/bootstrap-sortable/Contents/bootstrap-sortable.css">
@stop

@section('footer-js')
	<script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>
	<script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/moment.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			search_status();
		});
	</script>
@stop
