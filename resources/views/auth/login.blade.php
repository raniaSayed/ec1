<?php
	// check for if coming from add-to-cart case
	if(isset($_GET['ref_to']) && !empty($_GET['ref_to'])){
		Session::set('referedToProduct', [
			'is' => 1,
			'value' => "/products/".$_GET['ref_to']
		]);
	}
?>

@extends("front.$frontendNumber.master")
@section('title', trans2("A8", "Login"))

@section('content')
	<div id="login-form" class="container">
		@include('includes.flash-message')
		@include('includes.back-error')

		{!! Form::open(["url"=>"/login"]) !!}
			<div class="form-group">
				<span>
					{!! Form::label("emailAddress", trans2("A1", "Email address")) !!}
				</span>
				{!! Form::email("email", "", ["class"=>"form-control input-lg", "id"=>"emailAddress", "required"=>"required"]) !!}
				<span class="help-block access-accounts opc-7">
					super-admin@sen.com<br>
					normal-admin@sen.com<br>
					user@sen.com
				</span>
			</div>
			<div class="form-group">
				<span>
					{!! Form::label("userPassword", trans2("A2", "Password")) !!}
				</span>
				<input type="password" name="password" value="123456" class="form-control input-lg" id="userPassword" required>
				<span class="help-block opc-7">{{ trans2("A3", "Password") }}: 123456</span>
			</div>
			@if(Session::has('referedToProduct'))
				{!! Form::hidden('isReferedToProduct', Session::get('referedToProduct')['is']) !!}
				{!! Form::hidden('refToProduct_value', Session::get('referedToProduct')['value']) !!}
			@endif
			{!! Form::submit(trans2("A4", "Login"), ["class"=>"btn btn-success"]) !!}
			<span class="message right-text">
				{{ trans2("A5", "Don't have an account?") }} <a href="/register">{{ trans2("A6", "create one") }}</a>
			</span>
		{!! Form::close() !!}

		<div class="login-by-section">
			<h2><span>{{ trans2("A7", "Or login by") }}</span></h2>
			<a href="{{ url('socialauth/github') }}" class="btn" style="background: #333;">
				<i class="fa fa-github fa-2x" aria-hidden="true"></i>
				&nbsp; <b>github</b>
			</a>
			<a href="{{ url('socialauth/facebook') }}" class="btn" style="background: #3b5998;">
				<i class="fa fa-facebook fa-2x" aria-hidden="true"></i>
				&nbsp; <b>facebook</b>
			</a>
			<a href="{{ url('socialauth/google') }}" class="btn" style="background: #dd4b39;">
				<i class="fa fa-google-plus fa-2x" aria-hidden="true"></i>
				&nbsp; <b>google plus</b>
			</a>
		</div>
			
	</div>
@stop

@section('head-css')
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@stop