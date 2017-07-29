@if(!is_null($product->image_name))
	<img src='{{ asset("uploaded/products/images/icon_size/$product->image_name") }}' height="150px">
@else
	<img src='{{ asset("assets/images/no-image.png") }}' width="120px">
@endif