@extends('back.master')
@section('title', trans2("A237", "Admin c.p - add admins (by superadmin)"))

@section('content')
	<div id="admins-create-page">
		@include('includes.back-error')
		@include('includes.flash-message')

		<div class="panel panel-default">
			<div class="panel-heading">{{ trans2("A238", "create an admin & set his functions and methods") }}</div>
			<div class="panel-body">
				{!! Form::open(["url" => route('admin.clients.admins.accounts.store')]) !!}
					<div class="form-group">
						{!! Form::label("", trans2("A239", "Name")) !!}
						<span class="text-danger">*</span>
						{!! Form::text("name", "", ["class"=>"form-control"]) !!}
					</div>
					<div class="form-group">
						{!! Form::label("", trans2("A240", "Email address")) !!}
						<span class="text-danger">*</span>
						{!! Form::email("email", "", ["class"=>"form-control"]) !!}
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans2("A241", "Password")) !!}
								<span class="text-danger">*</span>
								<input type="password" name="password" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								{!! Form::label("", trans2("A242", "retype password")) !!}
								<span class="text-danger">*</span>
								<input type="password" name="password_confirmation" class="form-control">
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<span>{{ trans2("A243", "admin permissions") }}</span><br>
							<small>{{ trans2("A244", "admin able to access & create/edit/delete any thing except those:") }}</small>
						</div>
						<div class="panel-body">
							@include('back.add-ons.roles-form')
						</div>
					</div>
					<div class="checkbox">
						<label>
							{!! Form::hidden("isCreateNew", 0) !!}
							{!! Form::checkbox("isCreateNew", 1, null, ["class"=>"checkbox"]) !!}
							<b>{{ trans2("A245", "create another admin?") }}</b>
						</label>
					</div>
					{!! Form::submit(trans2("A246", "Create"), ["class"=>"btn btn-default"]) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop