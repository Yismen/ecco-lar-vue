<!-- Employee -->
<div class="form-group {{ $errors->has('employee_id') ? 'has-error' : null }}">
	{!! Form::label('employee_id', 'Employee:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('employee_id', $schedule->employeesList->pluck('fullName', 'id'), request('employee'), ['class'=>'form-control']) !!}
    	{!! $errors->first('employee_id', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Employee -->

<!-- Hours -->
{{-- <div class="form-group {{ $errors->has('hours') ? 'has-error' : null }}">
	{!! Form::label('hours', 'Hours:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('number', 'hours', null, ['class'=>'form-control', 'placeholder'=>'Hours', 'step' => 0.25]) !!}
		{!! $errors->first('hours', '<span class="text-danger">:message</span>') !!}
	</div>
</div> --}}
<!-- /. Hours -->

<div class="row">
	<div class="col-md-6">
		<!-- From Date -->
		<div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
		    {!! Form::label('date', ' From Date:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
			    <date-picker
			        name="date" id="name"
			        value="{{ old('date') }}"
			        format="yyyy-MM-dd"
			        :disable-since-many-days-ago="30"
			    ></date-picker>
			    {!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		{{-- /. From Date --}}
	</div>
	<div class="col-md-6">
		<!-- # of Days -->
		<div class="form-group {{ $errors->has('days') ? 'has-error' : null }}">
			{!! Form::label('days', '# of Days:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
				{!! Form::input('number', 'days', null, ['class'=>'form-control', 'placeholder'=>'# of Days', 'min' => 0, 'max' => 30]) !!}
				<span class="help-block">The number of days to feed from the date submitted</span>
				{!! $errors->first('days', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		<!-- /. # of Days -->
	</div>
</div>
