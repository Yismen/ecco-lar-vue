<div class="form-group {{ $errors->has('photo') ? 'has-error' : null }}">
	{!! Form::label('photo', 'Your Photo:', ['class'=>'']) !!}
	<div class="input-group">
		<div class="input-group-addon"><i class="fa fa-user"></i></div>
		{!! Form::file('photo', ['class'=>'form-control', 'placeholder'=>'Your Photo']) !!}
	</div>
</div>