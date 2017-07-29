@extends("front.$frontendNumber.master")
@section("title", trans2("A80", "Success payment"))

@section("content")
	<div class="container">
		<h3 class="text-center">
			{!! $message !!}
		</h3>
	</div>
@stop