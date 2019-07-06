
<!-- Employee -->
<div class="form-group {{ $errors->has('employee_id') ? 'has-error' : null }}">
	{!! Form::label('employee_id', 'Employee:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('employee_id', $schedule->employeesList->pluck('fullName', 'id'), null, ['class'=>'form-control']) !!}
    	{!! $errors->first('employee_id', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Employee -->

<!-- Hours -->
<div class="form-group {{ $errors->has('hours') ? 'has-error' : null }}">
	{!! Form::label('hours', 'Hours:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('number', 'hours', null, ['class'=>'form-control', 'placeholder'=>'Hours', 'step' => 0.25]) !!}
		{!! $errors->first('hours', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Hours -->

<!-- Employee -->
<div class="form-group {{ $errors->has('days') ? 'has-error' : null }}">
	{!! Form::label('days', 'Employee:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		<div class="checkbox">
			<label>
				{!! Form::checkbox('days[]', 'monday', null, []) !!}
				Monday
			</label>
		</div>

		<div class="checkbox">
			<label>
				{!! Form::checkbox('days[]', 'tuesday', null, []) !!}
				Tuesday
			</label>
		</div>

		<div class="checkbox">
			<label>
				{!! Form::checkbox('days[]', 'wednesday', null, []) !!}
				Wednesday
			</label>
		</div>

		<div class="checkbox">
			<label>
				{!! Form::checkbox('days[]', 'thursday', null, []) !!}
				Thursday
			</label>
		</div>

		<div class="checkbox">
			<label>
				{!! Form::checkbox('days[]', 'friday', null, []) !!}
				Friday
			</label>
		</div>

		<div class="checkbox">
			<label>
				{!! Form::checkbox('days[]', 'saturday', null, []) !!}
				Saturday
			</label>
		</div>

		<div class="checkbox">
			<label>
				{!! Form::checkbox('days[]', 'sunday', null, []) !!}
				Sunday
			</label>
		</div>

    {!! $errors->first('days', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Employee -->


{{-- <div class="row2">
	<!-- Monday -->
	<div class="col-sm-6 col-md-4 col-lg-3">
		<div class="form-group {{ $errors->has('monday') ? 'has-error' : null }}" style="margin: 1px;">
			{!! Form::label('monday', 'Monday:', []) !!}
			{!! Form::input('number', 'monday', null, ['class'=>'form-control', 'placeholder'=>'Monday', 'step' => '0.25']) !!}
		    {!! $errors->first('monday', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
	<!-- /. Monday -->

	<!-- Tuesday -->
	<div class="col-sm-6 col-md-4 col-lg-3">
		<div class="form-group {{ $errors->has('tuesday') ? 'has-error' : null }}" style="margin: 1px;">
			{!! Form::label('tuesday', 'Tuesday:', []) !!}
			{!! Form::input('number', 'tuesday', null, ['class'=>'form-control', 'placeholder'=>'Tuesday', 'step' => '0.25']) !!}
		    {!! $errors->first('tuesday', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
	<!-- /. Tuesday -->

	<!-- Wednesday -->
	<div class="col-sm-6 col-md-4 col-lg-3">
		<div class="form-group {{ $errors->has('wednesday') ? 'has-error' : null }}" style="margin: 1px;">
			{!! Form::label('wednesday', 'Wednesday:', []) !!}
			{!! Form::input('number', 'wednesday', null, ['class'=>'form-control', 'placeholder'=>'Wednesday', 'step' => '0.25']) !!}
		    {!! $errors->first('wednesday', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
	<!-- /. Wednesday -->

	<!-- Thrusday -->
	<div class="col-sm-6 col-md-4 col-lg-3">
		<div class="form-group {{ $errors->has('thursday') ? 'has-error' : null }}" style="margin: 1px;">
			{!! Form::label('thursday', 'Thrusday:', []) !!}
			{!! Form::input('number', 'thursday', null, ['class'=>'form-control', 'placeholder'=>'Thrusday', 'step' => '0.25']) !!}
		    {!! $errors->first('thursday', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
	<!-- /. Thrusday -->

	<!-- Friday -->
	<div class="col-sm-6 col-md-4 col-lg-3">
		<div class="form-group {{ $errors->has('friday') ? 'has-error' : null }}" style="margin: 1px;">
			{!! Form::label('friday', 'Friday:', []) !!}
			{!! Form::input('number', 'friday', null, ['class'=>'form-control', 'placeholder'=>'Friday', 'step' => '0.25']) !!}
		    {!! $errors->first('friday', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
	<!-- /. Friday -->

	<!-- Saturday -->
	<div class="col-sm-6 col-md-4 col-lg-3">
		<div class="form-group {{ $errors->has('saturday') ? 'has-error' : null }}" style="margin: 1px;">
			{!! Form::label('saturday', 'Saturday:', []) !!}
			{!! Form::input('number', 'saturday', null, ['class'=>'form-control', 'placeholder'=>'Saturday', 'step' => '0.25']) !!}
		    {!! $errors->first('saturday', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
	<!-- /. Saturday -->

	<!-- Sunday -->
	<div class="col-sm-6 col-md-4 col-lg-3">
		<div class="form-group {{ $errors->has('sunday') ? 'has-error' : null }}" style="margin: 1px;">
			{!! Form::label('sunday', 'Sunday:', []) !!}
			{!! Form::input('number', 'sunday', null, ['class'=>'form-control', 'placeholder'=>'Sunday', 'step' => '0.25']) !!}
		    {!! $errors->first('sunday', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
	<!-- /. Sunday -->
</div> --}}



