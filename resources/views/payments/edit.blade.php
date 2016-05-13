@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		{{-- {{ dd($employee) }} --}}
		<div class="well row">
			{!! Form::model($position, ['route'=>['positions.update', $position->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}
				<div class="form-group">
					<legend>Edit Position {{ $position->name }}</legend>
				</div>
				
				@include('positions._form')

				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary">Save</button>
					{!! delete_button('positions.destroy', $position->id, ['label'=>'Delete', 'class'=>'btn btn-danger']) !!}
					<hr>
					<a href="{{ route('positions.index') }}"><< Return to Positions List</a>
				</div>

			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('scripts')

@stop
