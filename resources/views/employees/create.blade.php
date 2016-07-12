

@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Employees', 'page_description'=>'Insert a new employee.'])

@section('content')
	<div class="container">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary pad row">
				{!! Form::model($employee, ['route'=>['admin.employees.store'], 'method'=>'POST', 'class'=>'', 'role'=>'form']) !!}		
					<div class="form-group">
						<legend>
							Create New Employee
							<a href="{{ route('admin.employees.index') }}" class="pull-right" title="Return to the employees' list."><i class="fa fa-list"></i></a>
						</legend>
					</div>
				
					@include('employees._form')

					<div class="col-sm-10 col-sm-offset-2">
						<button type="submit" class="btn btn-primary">Create</button>
						<button class="btn btn-default" type="reset">Undo Changes</button>
						<a href="{{ route('admin.employees.index') }}">Cancel and Return <i class="fa fa-angle-double-left"></i></a>
					</div>
				
				{!! Form::close() !!}
				<hr>
				
			</div><!-- /. Primary box -->
		</div><!-- /. Main box -->
	</div><!-- /. Container -->
@endsection