
{{-- Display Errors --}}
@if( $errors->any() )
	<div class="col-sm-12">
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	</div>
@endif
{{-- /. Errors --}}

<!-- Login -->
<div class="form-group {{ $errors->has('login') ? 'has-error' : null }}">
	{!! Form::label('login', 'Login:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'login', null, ['class'=>'form-control', 'placeholder'=>'Login']) !!}
	</div>
</div>
<!-- /. Login -->

<!-- Employee -->
<div class="form-group {{ $errors->has('employee_id') ? 'has-error' : null }}">
	{!! Form::label('employee_id', 'Employee:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('employee_id', $login->employeesList, null, ['class'=>'form-control select2']) !!}
	</div>
</div>
<!-- /. Employee -->

<!-- System -->
<div class="form-group {{ $errors->has('system_id') ? 'has-error' : null }}">
	{!! Form::label('system_id', 'System:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('system_id', $login->systemsList, null, ['class'=>'form-control']) !!}
	</div>
	{{-- {!! $errors->first('system_id', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. System -->



