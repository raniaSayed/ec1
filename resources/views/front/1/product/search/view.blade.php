@extends("front.$frontendNumber.master")
@section("title", trans2("A90", "Search on products"))

@section('content')

	<div id="products-view">
		@if(count($products) > 0)
			<div class="container-fluid content">
				<h4>{{ trans2("A91", "Result: ::result_count product", ["result_count"=>count($products)]) }}</h4>
				<div class="row">
					<div class="col-md-3">
						@include("front.$frontendNumber.add-ons.sections.leftnav-filter")
					</div>
					<div class="col-md-9">
						<div id="products-container">
							@include("front.$frontendNumber.add-ons.sections.products")
						</div>
					</div>
				</div>
			</div>

			<div class="container text-center">
				{!! $products->appends($searchParameters)->render() !!}
			</div>
		@else
			<div class="text-center opc-7">
				<h2>{{ trans2("A92", "There is no identical results") }}</h2>
				<h3>{{ trans2("A93", "Try again :)") }}</h3>
			</div>
		@endif

	</div>
@stop

@section('footer-js')
    <script type="text/javascript">
        $(document).ready(function(){
            search_status();
        });
    </script>
@stop