@extends('back.master')
@section('title', trans2('A458', "Admin c.p - edit information (by superadmin)"))

@section('content')
	<div id="">
		@include('includes.back-error')
		@include('includes.flash-message')

		<div class="panel panel-default">
			<div class="panel-heading">{{ trans2("A459", "edit super admin information") }}</div>
			<div class="panel-body">
				{!! Form::open(["url"=>"/admin/super-admin/edit"]) !!}
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans2("A460", "name")) !!}
								{!! Form::text("name", $super_admin->name, ["class"=>"form-control"]) !!}
								<span class="help-block opc-7">
									{{ trans2("A461", "name between 3, 255 and don't use many speical charachters") }}
								</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans2("A462", "email address")) !!}
								{!! Form::email("email", $super_admin->email, ["class"=>"form-control"]) !!}
							</div>
						</div>
					</div>	
					<hr>
					<div class="form-group">
						<div class="checkbox">
							<label>
								{!! Form::hidden("change_password", 0) !!}
								{!! Form::checkbox("change_password", 1, null, ["class"=>"checkbox checkbox-button"]) !!}
								<b>{{ trans2("A463", "change password") }}</b>
							</label>
						</div>
					</div>
					<div class="form-group">
						{!! Form::label("", trans2("A464", "old password")) !!}
						{!! Form::password("old_password", ["class"=>"form-control"]) !!}
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans2("A465", "new password")) !!}
								{!! Form::password("new_password", ["class"=>"form-control"]) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans2("A466", "retype password")) !!}
								{!! Form::password("new_password_confirmation", ["class"=>"form-control"]) !!}
							</div>
						</div>
					</div>	
					{!! Form::submit(trans2("A467", "update"), ["class"=>"btn btn-success"]) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop

@section('footer-js')
	<script type="text/javascript">
		$(document).ready(function(){
			enable_disable_input($(".checkbox-button"), $("input[name='old_password']"), 0);
			enable_disable_input($(".checkbox-button"), $("input[name='new_password']"), 0);
			enable_disable_input($(".checkbox-button"), $("input[name='new_password_confirmation']"), 0);
		});
	</script>
@stop