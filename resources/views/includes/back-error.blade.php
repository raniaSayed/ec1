@if(count($errors) > 0)
	<div class="alert alert-danger" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		@foreach(array_unique($errors->all()) as $error)
			<p>
				<span class="glyphicon glyphicon-remove-circle"></span>
				<span>{{$error}}</span>
			</p>
		@endforeach
	</div>
@endif