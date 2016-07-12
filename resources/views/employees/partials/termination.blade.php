<div class="col-sm-12">
	{!! Form::model($employee, ['route'=>['admin.employees.termination', $employee->id], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}		
		<div class="form-group">
			<legend>Edit Termination for {{ $employee->full_name }}, Current status is 				
				<span class="alert alert-primary">{{ $employee->status }} </span>
			</legend>
		</div>
	
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

		<div class="form-group {{ $errors->has('termination_date') ? 'has-error' : null }}">
			{!! Form::label('termination_date', 'Termination Date:', ['class'=>'col-sm-5 control-label']) !!}
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				{!! Form::input('date', 'termination_date', null, ['class'=>'form-control', 'placeholder'=>'Termination Date']) !!}
			</div>
		</div>
		<!-- /. Termination Date -->
		
		<!-- Termination Type -->
		<div class="form-group {{ $errors->has('termination_type_id') ? 'has-error' : null }}">
			{!! Form::label('termination_type_id', 'Termination Type:', ['class'=>'col-sm-5 control-label']) !!}
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-list"></i></div>
				{!! Form::select('termination_type_id', $employee->terminationTypeList, null, ['class'=>'form-control input-sm']) !!}
			</div>
		</div>
		<!-- /. Termination Type -->
		
		<!-- Termination Reason -->
		<div class="form-group {{ $errors->has('termination_reason_id') ? 'has-error' : null }}">
			{!! Form::label('termination_reason_id', 'Termination Reason:', ['class'=>'col-sm-5 control-label']) !!}
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-list"></i></div>
				{!! Form::select('termination_reason_id', $employee->terminationReasonList, null, ['class'=>'form-control input-sm']) !!}
			</div>
		</div>
		<!-- /. Termination Reason -->

		<!-- Can Be Re-Hired? -->
		<div class="form-group {{ $errors->has('can_be_rehired') ? 'has-error' : null }}">
			{!! Form::label('can_be_rehired', 'Can Be Re-Hired?:', ['class'=>'col-sm-5 control-label']) !!}
			<div class="col-sm-7">
				<div class="radio">
					<label>
						{{ Form::radio('can_be_rehired', 1, null, ['id'=>'can_be_rehired_1']) }}
						Yes
					</label>
					<label>
						{{ Form::radio('can_be_rehired', 0, null, ['id'=>'can_be_rehired_2']) }}
						No
					</label>
				</div>

			</div>
		</div>
		<!-- /. Can Be Re-Hired? -->
		

		@if ($employee->termination)
			<button class="btn btn-warning" type="submit">Update</button>
		@else
			<button class="btn btn-danger" type="submit">Inactivate</button>
		@endif

	
	{!! Form::close() !!}

	@if ($employee->termination)
		<hr>
		{!! Form::model($employee, ['method' => 'POST', 'route' => ['admin.employees.reactivate', $employee], 'class' => 'form-horizontal']) !!}
		
		
			<div class="form-group {{ $errors->has('hire_date') ? 'has-error' : null }}">
				{!! Form::label('hire_date', 'Hire Date:', ['class'=>'col-sm-5 control-label']) !!}
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
					{!! Form::input('date', 'hire_date', null, ['class'=>'form-control', 'placeholder'=>'Hire Date']) !!}
				</div>
				<span class="help-block pull-right">If you are re-activating, please dont forget to update the hire date.</span>
			</div>
			<!-- /. Hire Date -->
		
		
		    <div class="btn-group pull-right">
		        {!! Form::submit("Re-Activate", ['class' => 'btn btn-success']) !!}
		    </div>
		
		{!! Form::close() !!}
	@endif
</div>