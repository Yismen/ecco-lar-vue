
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

<div class="form-group {{ $errors->has('department') ? 'has-error' : null }}">
	{!! Form::label('department', 'Department Name:', ['class'=>'']) !!}
	<div class="input-group">
		{!! Form::input('text', 'department', null, ['class'=>'form-control', 'placeholder'=>'Department Name']) !!}
		<span class="input-group-btn">
			{!! Form::input('submit', 'Save', 'Save!', ['class'=>'btn btn-primary']) !!}
		</span>
	</div>
	
</div>
<!-- /. Department Name -->
