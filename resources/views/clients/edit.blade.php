@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		{{-- {{ dd($employee) }} --}}
		<div class="well row">
			{!! Form::model($client, ['route'=>['clients.update', $client->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}	
				<div class="form-group">
					<legend>Edit Information for Client {{ $client->name }}</legend>
				</div>
			
				@include('clients._form')

				<div class="col-sm-6 col-sm-offset-2">
					<button type="submit" class="btn btn-primary">Update</button>	
					<a href="{{ route('clients.index') }}" class="btn btn-default">Cancel</a>				
				</div>
			
			{!! Form::close() !!}
				
			{!! delete_button('clients.destroy', $client->id, ['class'=>'btn btn-danger ','label'=>'Delete <i class="fa fa-trash"></i>']) !!} 
				
		</div>
	</div>

@stop

@section('scripts')
	
@stop