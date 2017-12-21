

<div class="row">
	<div class="col-sm-12">
		<!-- Position Name -->
		<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
			{!! Form::label('name', 'Position Name:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
				{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Position Name']) !!}
				{!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		<!-- /. Position Name -->
	</div>
</div>

<div class="row">
	<div class="col-sm-6">
		<!-- Department -->
		<div class="form-group {{ $errors->has('department_id') ? 'has-error' : null }}">
			{!! Form::label('department_id', 'Department:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
				{!! Form::select('department_id', $position->departmenstList, null, ['class'=>'form-control', 'id'=>'department_id']) !!}
				{!! $errors->first('department_id', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		<!-- /. Department -->

		<!-- Payment Type -->
		<div class="form-group {{ $errors->has('payment_type_id') ? 'has-error' : null }}">
			{!! Form::label('payment_type_id', 'Payment Type:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
				{!! Form::select('payment_type_id', $position->paymentTypesList, null, ['class'=>'form-control', 'id'=>'payment_type_id']) !!}
				{!! $errors->first('payment_type_id', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		<!-- /. Payment Type -->
	</div> 
	{{-- /. col-sm-6 --}}
	<div class="col-sm-6">
		<!-- Payment Frequency -->
		<div class="form-group {{ $errors->has('payment_frequency_id') ? 'has-error' : null }}">
			{!! Form::label('payment_frequency_id', 'Payment Frequency:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
				{!! Form::select('payment_frequency_id', $position->paymentFrequenciesList, null, ['class'=>'form-control', 'id'=>'payment_frequency_id']) !!}
				{!! $errors->first('payment_frequency_id', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		<!-- /. Payment Frequency -->

		<!-- Salary -->
		<div class="form-group {{ $errors->has('salary') ? 'has-error' : null }}">
			{!! Form::label('salary', 'Salary:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
				{!! Form::input('number', 'salary', null, ['class'=>'form-control', 'placeholder'=>'Salary', 'step'=>0.01]) !!}
				{!! $errors->first('salary', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		<!-- /. Salary -->
	</div>
</div>

