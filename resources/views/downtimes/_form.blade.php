
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

<!-- Employee -->
<div class="form-group {{ $errors->has('employee_id') ? 'has-error' : null }}">
	{!! Form::label('employee_id', 'Employee:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('employee_id', $downtime->employeesList, null, ['class'=>'form-control input-sm']) !!}
	</div>
</div>
<!-- /. Employee -->

<!-- Insert Date -->
<div class="form-group {{ $errors->has('insert_date') ? 'has-error' : null }}">
	{!! Form::label('insert_date', 'Insert Date:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('date', 'insert_date', null, ['class'=>'form-control', 'placeholder'=>'Insert Date']) !!}
	</div>
</div>
<!-- /. Insert Date -->

<!-- From Time -->
<div class="form-group {{ $errors->has('from_time') ? 'has-error' : null }}">
	{!! Form::label('from_time', 'From Time:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('time', 'from_time', null, ['class'=>'form-control', 'placeholder'=>'From Time']) !!}
	</div>
</div>
<!-- /. From Time -->

<!-- To Time -->
<div class="form-group {{ $errors->has('to_time') ? 'has-error' : null }}">
	{!! Form::label('to_time', 'To Time:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('time', 'to_time', null, ['class'=>'form-control', 'placeholder'=>'To Time']) !!}
	</div>
</div>
<!-- /. To Time -->

<!-- Break Time -->
<div class="form-group {{ $errors->has('break_time') ? 'has-error' : null }}">
	{!! Form::label('break_time', 'Break Time:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('number', 'break_time', null, ['class'=>'form-control', 'placeholder'=>'Break Time', 'step'=>1, 'default'=>60]) !!}
		<span class="help-block">Break time in minutes. This will be reduced from the reported downtime</span>
	</div>
</div>
<!-- /. Break Time -->

<!-- Downtime Reason -->
<div class="form-group {{ $errors->has('reason_id') ? 'has-error' : null }}">
	{!! Form::label('reason_id', 'Downtime Reason:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('reason_id', $downtime->reasonsList, null, ['class'=>'form-control input-sm']) !!}
	</div>
</div>
<!-- /. Downtime Reason -->


