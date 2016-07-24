
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

<div class="form-group">
    {!! Form::label('file', 'Import Production', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
	    {!! Form::file('file[]', ['class' => 'required', 'multiple']) !!}
	    <p class="help-block">Help block text</p>
    </div>
</div>



