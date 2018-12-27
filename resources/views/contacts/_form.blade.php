
<div class="col-sm-6">
	<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
		{!! Form::label('name', 'Name:', ['class'=>'']) !!}
			{!! Form::input('text', 'name', null, ['class'=>'form-control input-sm']) !!}
			{!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group {{ $errors->has('phone') ? 'has-error' : null }}">
		{!! Form::label('phone', 'Main Phone:', ['class'=>'']) !!}
			{!! Form::input('phone', 'phone', null, ['class'=>'form-control input-sm']) !!}
			{!! $errors->first('phone', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<hr>
<small>
	<h5 class="help-text">Optional Fields</h5>
</small>

<div class="col-sm-6">
	<div class="form-group {{ $errors->has('works_at') ? 'has-error' : null }}">
		{!! Form::label('works_at', 'Workst At:', ['class'=>'']) !!}
			{!! Form::input('text', 'works_at', null, ['class'=>'form-control input-sm']) !!}
			{!! $errors->first('works_at', '<span class="text-danger">:message</span>') !!}
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group {{ $errors->has('position') ? 'has-error' : null }}">
		{!! Form::label('position', 'Position:', ['class'=>'']) !!}
			{!! Form::input('text', 'position', null, ['class'=>'form-control input-sm']) !!}
			{!! $errors->first('position', '<span class="text-danger">:message</span>') !!}
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group {{ $errors->has('secondary_phone') ? 'has-error' : null }}">
		{!! Form::label('secondary_phone', 'Secondary Phone:', ['class'=>'']) !!}
			{!! Form::input('phone', 'secondary_phone', null, ['class'=>'form-control input-sm']) !!}
			{!! $errors->first('secondary_phone', '<span class="text-danger">:message</span>') !!}
	</div>
</div>

<div class="col-sm-6">
	<div class="form-group {{ $errors->has('email') ? 'has-error' : null }}">
		{!! Form::label('email', 'Email Address:', ['class'=>'']) !!}
			{!! Form::input('email', 'email', null, ['class'=>'form-control input-sm']) !!}
			{!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
