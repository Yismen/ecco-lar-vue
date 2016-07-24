@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="container">

		<div class="box box-primary pad">
			{!! Form::open(['route'=>['admin.productions.store'], 'method'=>'POST', 'class'=>'', 'role'=>'form', 'files' => true]) !!}		
				<div class="form-group">
					<legend>Import Production Data</legend>
				</div>
			
				@include('productions._form')

				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary">Import <i class="fa fa-upload"></i></button>
				</div>
			
			{!! Form::close() !!}
			
			{{--
			<hr>
			
			<div class="drag-files">
				<h3 class="page-header">Import Production Data</h3>
				<h5>Drag and Drop files here...</h5>
				{!! Form::open(['route'=>['admin.productions.store'], 'method'=>'POST', 'class'=>'dropzone', 'role'=>'form', 'autocomplete'=>"off", 'id'=>"my-awesome-dropzone"]) !!}		
					<!-- <div class="form-group">
						<legend>Drag and drop files heress.</legend>
					</div> -->
				
				{!! Form::close() !!}
			</div>
			 Hide the dropzonejs form. Ajax implementation is sligtly deffered for another moment. --}}
			<hr>	
			<a href="{{ route('admin.productions.index') }}"><< Cancel and return to Production List</a>
		</div>
		
	</div>
@stop

@section('scripts')
	
@stop