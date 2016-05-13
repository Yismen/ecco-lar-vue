@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		<div class="well row ">

			{!! Form::open(['route'=>['productions.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'files' => true]) !!}		
				<div class="form-group">
					<legend>Import Production Data</legend>
				</div>
			
				@include('productions._form')

				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary form-control">Import <i class="fa fa-upload"></i></button>
				</div>
			
			{!! Form::close() !!}
			<br>
			<hr>
			<div class="drag-files">
				<h3>Drag and Drop files here</h3>
			</div>
		
			<hr>	
			<a href="{{ route('productions.index') }}"><< Cancel and return to Production List</a>
		</div>
		
	</div>
@stop

@section('scripts')
	
@stop