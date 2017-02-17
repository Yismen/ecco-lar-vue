@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Punches', 'page_description'=>'Edit existing punches.'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		{{-- {{ dd($employee) }} --}}
		<div class="well row">
			{!! Form::model($punch, ['route'=>['admin.punches.update', $punch->punch], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}	
				<div class="form-group">
					<legend>Edit Login {{ $punch->punch }}</legend>
				</div>
			
				@include('punches._form')

				<div class="col-sm-6 col-sm-offset-2">
					<button type="submit" class="btn btn-primary">Update</button>	
					<a href="{{ route('admin.punches.index') }}" class="btn btn-default">Cancel</a>				
				</div>
			
			{!! Form::close() !!}
				
			{{-- {!! delete_button('punches.destroy', $punch->punch, ['class'=>'btn btn-danger ','label'=>'Delete <i class="fa fa-trash"></i>']) !!} --}}

				
		</div>
	</div>

@stop

@section('scripts')
	
@stop