
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

	<!-- Card -->
	<div class="form-group {{ $errors->has('card') ? 'has-error' : null }}">
		{!! Form::label('card', 'Card:', ['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-10">
			{!! Form::input('text', 'card', null, ['class'=>'form-control', 'placeholder'=>'Card']) !!}
		</div>
	</div>
	<!-- /. Card -->

	<!-- Employee -->
	<div class="form-group {{ $errors->has('employee_list') ? 'has-error' : null }}">
		{!! Form::label('employee_list', 'Employee:', ['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-10">
			{!! Form::select('employee_list', $card->employeesList, null, ['class'=>'form-control']) !!}
		</div>
	</div>
	<!-- /. Employee -->



