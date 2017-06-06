@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Departments', 'page_description'=>'Edit department\'s details'])

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					<div class="box-header wihh-border">Edit HH RR Department [{{ $departments->department }}]</div>
					<div class="box-body">				
						{!! Form::model($departments, ['route'=>['admin.departments.update', $departments->id], 'class'=>'form-horizontal', 'method'=>'PUT', 'role'=>'form']) !!}		
							
							@include('departments._form')				
						
						{!! Form::close() !!}
						<form action="{{ url('/admin/departments/'.$departments->id) }}" method="POST" class="" style="display: inline-block;">
						    {!! csrf_field() !!}
						    {!! method_field('DELETE') !!}
						
						    <button type="submit" id="delete-departments-{{ $departments->id }}" class="btn btn-danger " style="" name="deleteBtn">
						     	<i class="fa fa-btn fa-trash"></i> Delete
						    </button>
						</form>
						
						@include('departments._back-to-home')

					</div>	
				</div>
			</div>
		</div>
	</div>
@stop