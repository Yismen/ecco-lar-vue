@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		<div class="well row ">
			{!! Form::open(['route'=>['clients.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
				<div class="form-group">
					<legend>New Client</legend>
				</div>
			
				@include('clients._form')

				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary form-control">Create</button>
					<hr>	
					<a href="{{ route('clients.index') }}"><< Cancel and return to Clients List</a>
				</div>
			
			{!! Form::close() !!}

			{{-- // errors --}}
		</div>
		
	</div>
@stop

@section('scripts')
	
@stop