{!! Form::model($employee, ['route'=>['admin.employees.update', $employee->id], 'method'=>'PUT', 'class'=>'', 'role'=>'form']) !!}		
												
	<div class="form-group">
		<legend>Edit Employee {{ $employee->first_name }} {{ $employee->last_name }}</legend>
	</div>

	@include('employees._form')

	<div class="col-sm-10 col-sm-offset-2">
		<button type="submit" class="btn btn-primary">Update</button>
		<button class="btn btn-default" type="reset">Undo Changes</button>
	</div>

{!! Form::close() !!}