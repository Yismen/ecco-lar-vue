
<div class="col-sm-12">
	{!! Form::model($employee->punch, ['route'=>['admin.employees.updatePunch', $employee->id], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off", 'id' => 'punch_form']) !!}		
		<div class="form-group">
			<legend>Edit {{ $employee->first_name }} {{ $employee->last_name }} Punch ID</legend>
		</div>
		<div class="ajax-messages"></div>
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

		<!-- Punch ID -->
		<div class="form-group {{ $errors->has('punch') ? 'has-error' : null }}">
			{!! Form::label('punch', 'Punch ID:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
				{!! Form::input('text', 'punch', null, ['class'=>'form-control', 'placeholder'=>'Punch ID']) !!}
			</div>
		</div>
		<!-- /. Punch ID -->


		<!-- Save Card Form Submit -->
		<div class="form-group">
			{!! Form::button('Save Punch ID', ['type'=> 'submit', 'class'=>'btn btn-primary col-xs-4 pull-right', 'id'=>'save_punch']) !!}
		</div>

	{!! Form::close() !!}
</div>