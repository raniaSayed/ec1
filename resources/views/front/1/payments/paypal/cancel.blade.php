@extends("front.$frontendNumber.master")
@section("title", trans2("A81", "Payment canceled"))

@section("content")
	<div class="container">
		<h3 class="text-center">
			<span>{{ trans2("A82", "Payment was canceled from paypal.")}}</span> 
			<a href="/my-cart">{{ trans2("A83", "back to the cart")}}</a>
		</h3>
	</div>
@stop