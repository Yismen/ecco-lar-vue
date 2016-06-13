@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="container">
		<div class="box box-primary pad">
			{!! Form::model($position, ['route'=>['admin.payments.update', $position->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}
				<div class="form-group">
					<legend>Edit Position {{ $position->name }}</legend>
				</div>
				
				@include('payments._form')

				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary">Save</button>
					{!! delete_button('admin.positions.destroy', $position->id, ['label'=>'Delete', 'class'=>'btn btn-danger']) !!}
					<hr>
					<a href="{{ route('admin.payments.index') }}"><< Return to Positions List</a>
				</div>

			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('scripts')

@stop
