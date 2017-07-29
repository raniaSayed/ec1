@extends('back.master')
@section('title', trans2("A247", "Admin c.p - edit admins (by superadmin)"))

@section('content')
	<div id="admins-edit-page">
		@include('includes.back-error')
		@include('includes.flash-message')

		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans2("A248", "edit admin") }}
				<a class="btn btn-default pull-right" href="{{ route('admin.clients.admins.accounts.index') }}">{{ trans2("A249", "back to admins accounts") }}</a>
			</div>
			<div class="panel-body">
				{!! Form::open(["url"=> route('admin.clients.admins.accounts.update', $admin->id), "method"=>"PATCH"]) !!}
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans2("A250", "admin name")) !!}
								{!! Form::text("name", $admin->name, ["class"=>"form-control"]) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans2("A251", "Email address")) !!}
								{!! Form::email("email", $admin->email, ["class"=>"form-control", "disabled"=>"disabled"]) !!}
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							{{ trans2("A252", "admin permissions") }}
						</div>
						<div class="panel-body">
							@include('back.add-ons.roles-form')
						</div>
					</div>
					{!! Form::submit(trans2("A253", "Edit"), ["class"=>"btn btn-primary"]) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop