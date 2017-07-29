@if(session('flashMessage'))
	<div class="alert alert-dismissible alert-{{ session('flashMessage')['type'] }}" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<b>{{ session('flashMessage')['content'] }}</b>
	</div>
@endif