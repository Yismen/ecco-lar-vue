@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		<div class="well row ">
			{!! Form::open(['route'=>['logins.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
				<div class="form-group">
					<legend>New Login</legend>
				</div>
			
				@include('logins._form')

				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary form-control">Create</button>
					<hr>	
					<a href="{{ route('logins.index') }}"><< Return to Logins List</a>
				</div>
			
			{!! Form::close() !!}

			{{-- // errors --}}
		</div>
		
	</div>
@stop

@section('scripts')
	
@stop