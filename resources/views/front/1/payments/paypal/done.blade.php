@extends("front.$frontendNumber.master")
@section("title", trans2("A84", "Payment success"))

@section("content")
	<div class="container">
		<h3 class="text-center">
			<p>{{ trans2("A85", "success payment, wait to review it to send your collectibles")}}</p>
			<p><a href="/">{{ trans2("A86", "back to home") }}</a></p>
			<p><a href="/my-cart">{{ trans2("A87", "back to the cart") }}</a></p>
		</h3>
	</div>
@stop