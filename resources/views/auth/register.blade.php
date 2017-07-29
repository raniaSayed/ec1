@extends("front.$frontendNumber.master")
@section('title', trans2("A26", "Create new account"))

@section('content')
	<div id="register-form" class="container">
		@include('includes.flash-message')
		@include('includes.back-error')

		{!! Form::open(["url"=>"/register"]) !!}
			<div class="form-group">
				{!! Form::label("userName", trans2("A27", "Your name")) !!}
                <span class="text-danger">*</span>
				{!! Form::text("name", "", ["class"=>"form-control", "id"=>"userName", "dir"=>"auto"]) !!}
				<p class="help-block opc-7">{{ trans2("A28", "Use English alphabet letters, underscore and full stop") }}</p>
			</div>
			<div class="form-group">
				{!! Form::label("emailAddress", trans2("A29", "Email address")) !!}
                <span class="text-danger">*</span>
				{!! Form::email("email", "", ["class"=>"form-control", "id"=>"emailAddress"]) !!}
			</div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label("userPassword", trans2("A30", "Password")) !!}
                        <span class="text-danger">*</span>
                        {!! Form::password("password", ["class"=>"form-control", "id"=>"userPassword"]) !!}
                        <p class="help-block opc-7">{{ trans2("A31", "At less 6 characters") }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label("confirmationPassword", trans2("A32", "Confirmation password")) !!}
                        <span class="text-danger">*</span>
                        {!! Form::password("password_confirmation", ["class"=>"form-control", "id"=>"confirmationPassword"]) !!}
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                {!! Form::label("userCountry", trans2("A33", "country")) !!}
                <select name="country_id" class="form-control">
                    <option value="0">{{ trans2("A34", "My country not founded") }}</option>
                    @foreach(config('sensorization.seeds.countries') as $id => $country)
                        <option value="{{ $id + 1 }}">{{ $country }}</option>
                    @endforeach
                </select>
                <p class="help-block opc-7">
                    {{ trans2("A35", "need for delivery method orders") }}<br>
                    <a href="#">{{ trans2("A36", "why my country not founded?") }}</a>
                </p>
            </div>
            <div class="form-group">
                {!! Form::label("userAddress", trans2("A37", "Full address")) !!}
                {!! Form::textarea("address", "", ["class"=>"form-control", "id"=>"userAddress", "dir"=>"auto", "rows"=>4]) !!}
                <p class="help-block opc-7">{{ trans2("A38", "need for delivery method orders") }}</p>
            </div>
			{!! Form::submit(trans2("A39", "Sign up"), ["class"=>"btn btn-primary"]) !!}

			<span class="message right-text">
				{{ trans2("A40", "Have an account?") }} <a href="/login">{{ trans2("A41", "Login now") }}</a>
			</span>
		{!! Form::close() !!}
	</div>
@stop