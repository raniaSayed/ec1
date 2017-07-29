@extends('back.master')
@section('title', trans2("A264", 'Admin c.p - users'))

@section('content')
	<div id="users-view-page">
		<div class="panel panel-default">
			<div class="panel-heading">{{ trans2("A265", "users accounts") }}</div>
			<div class="panel-body">
				@if(count($users) <= 0)
                    <div class="empty-status">
                        <h3 class="text-center">{{ trans2("A266", "there is no users yet") }}</h3>
                    </div>
				@else
					<div class="container-fluid">
                        <div id="response-table">
                            <table class="table table-condensed sortable table-bordered ps-view">
                                <thead>
                                    <tr>
                                        <th>{{ trans2("A267", "name") }}</th>
                                        <th>{{ trans2("A268", "email") }}</th>
                                        <th>{{ trans2("A269", "crated at") }}</th>
                                        <th>{{ trans2("A270", "options") }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td data-title='{{ trans2("A267") }}'>{{ $user->name }}</td>
                                            <td data-title='{{ trans2("A268") }}'>{{ $user->email }}</td>
                                            <td data-title='{{ trans2("A269") }}'>{{ $user->created_at }}</td>
                                            <td data-title='{{ trans2("A270") }}'>
                                                {!! Form::open(["url"=>"/admin/clients/users/accounts/$user->id", "method"=>"DELETE"]) !!}
                                                    {!! Form::submit(trans2("A271", "delete"), ['class' => 'btn btn-danger btn-xs']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach             
                                </tbody>
                            </table>
                        </div>
                    </div>
				@endif	
			</div>
			<div class="text-center">
				{!! $users->render() !!}
			</div>	
		</div>
		<?php /*
		<div class="text-right">
			<a href="/admin/users-accounts" class="btn btn-default">Users accounts</a>
			<a href="/admin/admins-accounts" class="btn btn-default">Admins accounts</a>
		</div>
		*/?>	
	</div>
@stop

@section('head-css')
	<link rel="stylesheet" type="text/css" href="./packages/bootstrap-sortable/Contents/bootstrap-sortable.css">
@stop

@section('footer-js')
	<script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/bootstrap-sortable.js"></script>
	<script type="text/javascript" src="./packages/bootstrap-sortable/Scripts/moment.min.js"></script>
@stop