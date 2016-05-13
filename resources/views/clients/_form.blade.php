
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

<!-- Client Name -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
	{!! Form::label('name', 'Client Name:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Client Name']) !!}
	</div>
</div>
<!-- /. Client Name -->

<!-- Production \'s Goal -->
<div class="form-group {{ $errors->has('goal') ? 'has-error' : null }}">
	{!! Form::label('goal', 'Production \'s Goal:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('number', 'goal', null, ['class'=>'form-control', 'placeholder'=>'Production \'s Goal', 'step'=>'0.5']) !!}
	</div>
</div>
<!-- /. Production \'s Goal -->



