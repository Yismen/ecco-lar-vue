@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="container">
		<div class="box box-primary pad">
			<br>
			<div class="jumbotron">				
				{!! Form::model($departments, ['route'=>['admin.departments.update', $departments->id], 'class'=>'form-horizontal', 'method'=>'PUT', 'role'=>'form']) !!}		
					<div class="form-group">
						<legend>Edit HH RR Department [{{ $departments->department }}]</legend>
					</div>						
				
					@include('departments._form')				
				
				{!! Form::close() !!}

				<hr>
				{!! link_to_route('admin.departments.create', 'Cancel and Return') !!}

			</div>
		</div>
	</div>
@stop

@section('scripts')
	
@stop