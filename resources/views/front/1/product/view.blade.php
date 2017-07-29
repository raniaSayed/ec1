@extends("front.$frontendNumber.master")
@section('title', trans2("A51", "All categories"))

@section('content')
	<div id="products-view">
		<div class="container-fluid content">
			@if(count($products) == 0)
				<h2 class="text-center opc-6">{{ trans2("A52", "no ::products yet", ["products"=>"products"]) }}</h2>
			@else
			<div class="row">
				<div class="col-md-3">
					@include("front.$frontendNumber.add-ons.sections.leftnav-filter")
				</div>
				<div class="col-md-9">
					<div id="products-container">
						@if(isset($title1))
							<div class="well">{!! $title1 !!}</div>
						@endif
						@include("front.$frontendNumber.add-ons.sections.products")
					</div>
					<div class="text-center">
						{!! $products->render() !!}
					</div>
				</div>
			</div>
			@endif
		</div>
	</div>
@stop

@section('footer-js')
    <script type="text/javascript">
        $(document).ready(function(){
            search_status();
        });
    </script>
@stop
