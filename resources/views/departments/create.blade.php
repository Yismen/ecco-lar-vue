
@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Departments', 'page_description'=>'Create a new department.'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		<div class="box box-primary">
			<div class="box-header with-border"><h3>Create a New HH RR Department / Project</h3></div>
			{!! Form::open(['route'=>['admin.departments.store'], 'class'=>'form-horizontal', 'role'=>'form']) !!}	
				<div class="box-body">
					@include('departments._form')	
				</div>	
		
			{!! Form::close() !!}
			<div class="box-footer with-border">
				@include('departments._back-to-home')
			</div>
		</div>
	</div>
@endsection

