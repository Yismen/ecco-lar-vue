
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
<!-- Sector -->
<div class="form-group {{ $errors->has('sector') ? 'has-error' : null }} sector-group">
	{!! Form::label('sector', 'Sector:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'sector', null, ['class'=>'form-control', 'placeholder'=>'Sector']) !!}
	</div>
	{{-- {!! $errors->first('sector', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Sector -->
<!-- Street Address -->
<div class="form-group {{ $errors->has('street_address') ? 'has-error' : null }} street_address-group">
	{!! Form::label('street_address', 'Street Address:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'street_address', null, ['class'=>'form-control', 'placeholder'=>'Street Address']) !!}
	</div>
	{{-- {!! $errors->first('street_address', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Street Address -->
<!-- City -->
<div class="form-group {{ $errors->has('city') ? 'has-error' : null }} city-group">
	{!! Form::label('city', 'City:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'city', null, ['class'=>'form-control', 'placeholder'=>'City']) !!}
	</div>
	{{-- {!! $errors->first('city', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. City -->