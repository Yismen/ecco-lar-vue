@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		{{-- {{ dd($employee) }} --}}
		<div class="well row">
			{!! Form::model($user, ['route'=>['admin.users.update', $user->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
				<div class="form-group">
					<legend>Edit Menu {{ $user->name }}</legend>
				</div>
			
				@include('users._form')

				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary form-control">Save</button>
					<br><br>
					<a href="{{ route('admin.users.index') }}"><< Return to Users List</a>
				</div>
			
			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('scripts')
	
@stop