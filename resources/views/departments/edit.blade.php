@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Departments', 'page_description'=>'Edit department\'s details'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		<div class="box box-primary pad">
			<br>
			<div class="big-box">				
				{!! Form::model($departments, ['route'=>['admin.departments.update', $departments->id], 'class'=>'form-horizontal', 'method'=>'PUT', 'role'=>'form']) !!}		
					<div class="form-group">
						<legend>Edit HH RR Department [{{ $departments->department }}]</legend>
					</div>						
				
					@include('departments._form')				
				
				{!! Form::close() !!}
				<form action="{{ url('/admin/departments/'.$departments->id) }}" method="POST" class="" style="display: inline-block;">
				    {!! csrf_field() !!}
				    {!! method_field('DELETE') !!}
				
				    <button type="submit" id="delete-departments-{{ $departments->id }}" class="btn btn-danger " style="" name="deleteBtn">
				     	<i class="fa fa-btn fa-trash"></i> Delete
				    </button>
				</form>

				<hr>
				
				@include('departments._back-to-home')

			</div>
		</div>
	</div>
@stop

@section('scripts')
	
@stop