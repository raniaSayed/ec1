@extends("front.$frontendNumber.user.master")
@section('title', trans2("A139", "Dashboard"))

@section('content')
	<div id="dashboard-page">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>{{ trans2("A140", "My profile") }}</b>
			</div>
			<div class="panel-body">
				<div class="container-fluid">
					<span>{{ trans2("A141", "Welcome: ::name", ['name'=>$user->name]) }}</span>
				</div>
			</div>
		</div>
	</div>
@stop