
<div class="col-sm-12">
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
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('first_name') ? 'has-error' : null }}">
			{!! Form::label('first_name', 'First Name:', ['class'=>'']) !!}
			{!! Form::input('text', 'first_name', null, ['class'=>'form-control input-sm', 'placeholder'=>'First Name']) !!}
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('last_name') ? 'has-error' : null }}">
			{!! Form::label('last_name', 'Last Name:', ['class'=>'']) !!}
			{!! Form::input('text', 'last_name', null, ['class'=>'form-control input-sm', 'placeholder'=>'', 'placeholder'=>'Last Name']) !!}
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('hire_date') ? 'has-error' : null }}">
			{!! Form::label('hire_date', 'Hired Date:', ['class'=>'']) !!}
			{!! Form::input('date', 'hire_date', $employee->hire_date, ['class'=>'form-control input-sm', 'placeholder'=>'Hired Date']) !!}
		</div>
	</div>

	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('personal_id') ? 'has-error' : null }}">
			{!! Form::label('personal_id', 'Personal ID:', ['class'=>'']) !!}
			{!! Form::input('text', 'personal_id', null, ['class'=>'form-control input-sm', 'placeholder'=>'Personal ID']) !!}
		</div>
	</div>

	<div class="col-sm-6">
		<div class="form-group date {{ $errors->has('date_of_birth') ? 'has-error' : null }}">
			{!! Form::label('date_of_birth', 'Date of Birth:', ['class'=>'']) !!}
			{!! Form::input('date', 'date_of_birth', $employee->date_of_birth, ['class'=>'form-control input-sm', 'placeholder'=>'Date of Birth']) !!}
		</div>
	</div>

	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('cellphone_number') ? 'has-error' : null }}">
			{!! Form::label('cellphone_number', 'Cell Phone Number:', ['class'=>'']) !!}
			{!! Form::input('phone', 'cellphone_number', null, ['class'=>'form-control input-sm', 'placeholder'=>'Cell Phone Number']) !!}
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('secondary_phone') ? 'has-error' : null }}">
			{!! Form::label('secondary_phone', 'Secondary Phone Number:', ['class'=>'']) !!}
			{!! Form::input('phone', 'secondary_phone', null, ['class'=>'form-control input-sm', 'placeholder'=>'Secondary Phone Number']) !!}
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('gender_id') ? 'has-error' : null }}">
			{!! Form::label('gender_id', 'Gender:', ['class'=>'']) !!}
			{!! Form::select('gender_id', $employee->gendersList, null, ['class'=>'form-control input-sm']) !!}
		</div>
		<!-- /. Gender -->
	</div>

	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('marital_id') ? 'has-error' : null }}">
			{!! Form::label('marital_id', 'Marital Status:', ['class'=>'']) !!}
			{!! Form::select('marital_id', $employee->maritalsList, null, ['class'=>'form-control input-sm']) !!}
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('has_kids') ? 'has-error' : null }}">
			{!! Form::label('has_kids', 'Has Kids:', ['class'=>'']) !!}
			{!! Form::select('has_kids', $employee->hasKidsList, null, ['class'=>'form-control input-sm']) !!}
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('position_id') ? 'has-error' : null }}">
			{!! Form::label('position_id', 'Position:', ['class'=>'']) !!}
			{!! Form::select('position_id', $employee->positionsIdList, null, ['class'=>'form-control input-sm']) !!}
		</div>
	</div>
	<!-- /. Position -->
</div>
