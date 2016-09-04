
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

<!-- Payment Name -->
<div class="form-group {{ $errors->has('payment_type') ? 'has-error' : null }}">
	{!! Form::label('payment_type', 'Payment Name:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'payment_type', null, ['class'=>'form-control', 'placeholder'=>'Payment Name']) !!}
	</div>
	{{-- {!! $errors->first('payment_type', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Payment Name -->

