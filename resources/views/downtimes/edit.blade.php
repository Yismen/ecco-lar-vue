@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		{{-- {{ dd($employee) }} --}}
		<div class="well row">
			{!! Form::model($downtime, ['route'=>['downtimes.update', $downtime->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}	
				<div class="form-group">
					<legend>Edit Login {{ $downtime->id }}</legend>
				</div>
			
				@include('downtimes._form')

				<div class="col-sm-6 col-sm-offset-2">
					<button type="submit" class="btn btn-primary">Update</button>	
					<a href="{{ route('downtimes.index') }}" class="btn btn-default">Cancel</a>				
				</div>
			
			{!! Form::close() !!}
				
			{!! delete_button('downtimes.destroy', $downtime->id, ['class'=>'btn btn-danger ','label'=>'Delete <i class="fa fa-trash"></i>']) !!} 
				
		</div>
	</div>

@stop

@section('scripts')
	
@stop