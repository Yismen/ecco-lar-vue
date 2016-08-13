
@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Departments', 'page_description'=>'Create a new department.'])

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad big-box">
					{!! Form::open(['route'=>['admin.departments.store'], 'class'=>'form-horizontal', 'role'=>'form']) !!}		
					<div class="form-group">
						<legend>Create A New HH RR Department</legend>
					</div>						
				
					@include('departments._form')		
				
				{!! Form::close() !!}
				@include('departments._back-to-home')
				</div>
			</div>
		</div>
	</div>
@endsection

