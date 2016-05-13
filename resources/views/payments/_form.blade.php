
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

<!-- Position Name -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
	{!! Form::label('name', 'Position Name:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Position Name']) !!}
	</div>
	{{-- {!! $errors->first('name', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Position Name -->

<!-- Department -->
<div class="form-group {{ $errors->has('department_id') ? 'has-error' : null }}">
	{!! Form::label('department_id', 'Department:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('department_id', $position->departmenstList, null, ['class'=>'form-control', 'id'=>'department_id']) !!}
	</div>
	{{-- {!! $errors->first('department_id', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Department -->

<!-- Payment -->
<div class="form-group {{ $errors->has('payment_id') ? 'has-error' : null }}">
	{!! Form::label('payment_id', 'Payment:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('payment_id', $position->paymentsList, null, ['class'=>'form-control', 'id'=>'payment_id']) !!}
	</div>
	{{-- {!! $errors->first('department_id', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Payment -->

<!-- Salary -->
<div class="form-group {{ $errors->has('salary') ? 'has-error' : null }}">
	{!! Form::label('salary', 'Salary:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('number', 'salary', null, ['class'=>'form-control', 'placeholder'=>'Salary', 'step'=>0.01]) !!}
	</div>
	{{-- {!! $errors->first('salary', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Salary -->


{{-- <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
<script>
	jQuery(document).ready(function($) {
		$('#roles_lists').select2();
	});
</script>
 --}}

