@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		<div class="well row ">
			{!! Form::open(['route'=>['roles.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
				<div class="form-group">
					<legend>New Role</legend>
				</div>
			
				@include('roles._form')

				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary form-control">Create</button>
					<br><br>
					<a href="{{ route('roles.index') }}"><< Return to Roles List</a>
				</div>
			
			{!! Form::close() !!}

			{{-- // errors --}}
		</div>
		
	</div>
@stop

@section('scripts')
	
@stop