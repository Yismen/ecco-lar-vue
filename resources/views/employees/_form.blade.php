<div class="row">
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('first_name') ? 'has-error' : null }}">
			{!! Form::label('first_name', 'First Name:', ['class'=>'']) !!}
			{!! Form::input('text', 'first_name', null, ['class'=>'form-control input-sm', 'placeholder'=>'First Name']) !!}
			{!! $errors->first('first_name', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('second_first_name') ? 'has-error' : null }}">
			{!! Form::label('second_first_name', 'Second First Name:', ['class'=>'']) !!}
			{!! Form::input('text', 'second_first_name', null, ['class'=>'form-control input-sm', 'placeholder'=>'Second First Name']) !!}
			{!! $errors->first('second_first_name', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('last_name') ? 'has-error' : null }}">
			{!! Form::label('last_name', 'Last Name:', ['class'=>'']) !!}
			{!! Form::input('text', 'last_name', null, ['class'=>'form-control input-sm', 'placeholder'=>'', 'placeholder'=>'Last Name']) !!}
			{!! $errors->first('last_name', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('second_last_name') ? 'has-error' : null }}">
			{!! Form::label('second_last_name', 'Second Last Name:', ['class'=>'']) !!}
			{!! Form::input('text', 'second_last_name', null, ['class'=>'form-control input-sm', 'placeholder'=>'', 'placeholder'=>'Second Last Name']) !!}
			{!! $errors->first('second_last_name', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('personal_id') ? 'has-error' : null }}">
			{!! Form::label('personal_id', 'Personal ID:', ['class'=>'']) !!}
			{!! Form::input('text', 'personal_id', null, ['class'=>'form-control input-sm', 'placeholder'=>'Personal ID']) !!}
			{!! $errors->first('personal_id', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('passport') ? 'has-error' : null }}">
			{!! Form::label('passport', 'Or Passport:', ['class'=>'']) !!}
			{!! Form::input('text', 'passport', null, ['class'=>'form-control input-sm', 'placeholder'=>'Passport']) !!}
			{!! $errors->first('passport', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('hire_date') ? 'has-error' : null }}">
			{!! Form::label('hire_date', 'Hired Date:', ['class'=>'']) !!}
			{!! Form::input('date', 'hire_date', $employee->hire_date, ['class'=>'form-control input-sm', 'placeholder'=>'Hired Date']) !!}
			{!! $errors->first('hire_date', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group date {{ $errors->has('date_of_birth') ? 'has-error' : null }}">
			{!! Form::label('date_of_birth', 'Date of Birth:', ['class'=>'']) !!}
			{!! Form::input('date', 'date_of_birth', $employee->date_of_birth, ['class'=>'form-control input-sm', 'placeholder'=>'Date of Birth']) !!}
			{!! $errors->first('date_of_birth', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('cellphone_number') ? 'has-error' : null }}">
			{!! Form::label('cellphone_number', 'Cell Phone Number:', ['class'=>'']) !!}
			{!! Form::input('phone', 'cellphone_number', null, ['class'=>'form-control input-sm', 'placeholder'=>'Cell Phone Number']) !!}
			{!! $errors->first('cellphone_number', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
	{{--  /.Cell phone number  --}}
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('secondary_phone') ? 'has-error' : null }}">
			<label for="secondary_phone">Secondary Phone Number:</label>
			<input type="phone" name="secondary_phone" id="secondary_phone" placeholder="Secondary Phone Number" value="{{ old('secondary_phone') }}" class="form-control">
			{!! $errors->first('secondary_phone', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
	{{-- Secondary Phone Number --}}
</div>

<div class="row">
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('gender_id') ? 'has-error' : null }}">
			{!! Form::label('gender_id', 'Gender:', ['class'=>'']) !!}
			{!! Form::select('gender_id', $employee->gendersList, null, ['class'=>'form-control input-sm']) !!}
			{!! $errors->first('gender_id', '<span class="text-danger">:message</span>') !!}
		</div>
		<!-- /. Gender -->
	</div>
	
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('marital_id') ? 'has-error' : null }}">
			{!! Form::label('marital_id', 'Marital Status:', ['class'=>'']) !!}
			{!! Form::select('marital_id', $employee->maritalsList, null, ['class'=>'form-control input-sm']) !!}
			{!! $errors->first('marital_id', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('has_kids') ? 'has-error' : null }}">
			{!! Form::label('has_kids', 'Has Kids:', ['class'=>'']) !!}
			{!! Form::select('has_kids', $employee->hasKidsList, null, ['class'=>'form-control input-sm']) !!}
			{!! $errors->first('has_kids', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('position_id') ? 'has-error' : null }}">
			<label for="position_id" class="">Position:</label>
			<select name="position_id" id="position_id" class="form-control input-sm select2">
				@foreach ($employee->positionsList as $position)
				<option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>
					{{ $position->name_and_department }},
					${{ $position->salary }} - {{ $position->payment_type['name'] }} 
				</option>
				@endforeach
			</select>
			{!! $errors->first('position_id', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
</div>
