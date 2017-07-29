@extends('back.master')
@section('title', trans2("A254", "Admin c.p - admins (by superadmin)"))

@section('content')
	<div id="admins-view-page">
		@include('includes.back-error')
		@include('includes.flash-message')
		
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans2("A255", "admins accounts") }}
				<a href="{{ route('admin.clients.admins.accounts.create') }}" class="btn btn-default pull-right" {{ $personType == "super_admin" ? "" : "disabled" }}>{{ trans2("A56", "add new admin by [super-admin]") }}</a>
			</div>
			<div class="panel-body">
				<div class="container-fluid">
					@if(count($admins) <= 0)
                        <div class="empty-status text-center">
                            <h3>{{ trans2("A257", "there is no row yet") }}</h3>  
                        </div>
					@else
						<div id="response-table">
                            <table class="table table-condensed table-bordered ps-view">
                                <thead>
                                    <tr>
                                        <th>{{ trans2("A258", "name") }}</th>
                                        <th>{{ trans2("A259", "email") }}</th>
                                        <th>{{ trans2("A260", "created at") }}</th>
                                        <th>{{ trans2("A261", "options") }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($admins as $admin)
                                        <tr>
                                            <td data-title='{{ trans2("A258") }}'>{{ $admin->name }}</td>
                                            <td data-title='{{ trans2("A259") }}'>{{ $admin->email }}</td>
                                            <td data-title='{{ trans2("A260") }}'>{{ $admin->created_at }}</td>
                                            <td data-title='{{ trans2("A261") }}'>
                                                @if($personType == "super_admin")
                                                    <a href="{{ route('admin.clients.admins.accounts.edit', $admin->id) }}" class="btn btn-warning btn-xs">{{ trans2("A262", "edit") }}</a>
                                                    {!! Form::open(["url"=> route('admin.clients.admins.accounts.destroy', $admin->id), "method"=>"DELETE"]) !!}
                                                        {!! Form::submit(trans2("A263", "Delete"), ['class' => 'btn btn-danger btn-xs']) !!}
                                                    {!! Form::close() !!}
                                                @else 
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach             
                                </tbody>
                            </table>
                        </div>
					@endif	
				</div>
			</div>
			<div class="text-center">
				{!! $admins->render() !!}
			</div>
		</div>
	</div>
@stop