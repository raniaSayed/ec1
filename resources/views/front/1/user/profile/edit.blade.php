@extends("front.$frontendNumber.user.master")
@section('title', trans2("A142", "Edit my information"))

@section('content')
	<div id="edit-information">
		@include('includes.flash-message')
		@include('includes.back-error')
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<b>{{ trans2("A143", "Edit my information") }}</b>
			</div>
			<div class="panel-body">
				<div class="container-fluid">
					{!! Form::open(["url"=>"/profile/update-information"]) !!}
						<div class="form-group">
							{!! Form::label("userName", trans2("A144", "Your name")) !!}
							<span class="text-danger">*</span>
							{!! Form::text("name", $user->name, ["class"=>"form-control", "id"=>"userName", "required"]) !!}
						</div>
						<div class="form-group">
							{!! Form::label("emailAddress", trans2("A145", "Email address")) !!} 
							<span class="text-danger">*</span>
							{!! Form::email("email", $user->email, ["class"=>"form-control", "id"=>"emailAddress", "readonly", "required"]) !!}
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									{!! Form::label("country", trans2("A146", "Available Country for delivery payment")) !!}
                                    <?php $countries = array_merge([0 => 'my country not founded'], (array) $countries->toArray()) ?>
									{!! Form::select("country_id", $countries, $user->country_id > 0 ? $user->country_id : 0, ["class"=>"form-control", "id"=>"country"]) !!}
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									{!! Form::label("address", trans2("A147", "Address")) !!}
									{!! Form::text("address", $user->address, ["class"=>"form-control", "id"=>"address"]) !!}
									<p class="help-block">{{ trans2("A148", "You need to enter your 'country' and 'address' because delivery payment") }}</p>
								</div>
							</div>
						</div>

						@if(isset($_GET['payment']))
							{!! Form::hidden('payment', 'true') !!}
						@endif

						{!! Form::submit(trans2("A149", "Update my information"), ["class"=>"btn btn-default"]) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>		
	</div>
@stop