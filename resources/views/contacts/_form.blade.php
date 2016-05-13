
<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
		{!! Form::label('name', 'Name:', ['class'=>'col-sm-3 control-label']) !!}
	<div class="col-sm-9">
		{!! Form::input('text', 'name', null, ['class'=>'form-control input-sm']) !!}
		{!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('main_phone') ? 'has-error' : null }}">
		{!! Form::label('main_phone', 'Main Phone:', ['class'=>'col-sm-3 control-label']) !!}
	<div class="col-sm-9">
		{!! Form::input('phone', 'main_phone', null, ['class'=>'form-control input-sm']) !!}
		{!! $errors->first('main_phone', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<hr>
<small>
	<h4>Optional Fields</h4>
</small>

<div class="form-group {{ $errors->has('works_at') ? 'has-error' : null }}">
		{!! Form::label('works_at', 'Workst At:', ['class'=>'col-sm-3 control-label']) !!}
	<div class="col-sm-9">
		{!! Form::input('text', 'works_at', null, ['class'=>'form-control input-sm']) !!}
		{!! $errors->first('works_at', '<span class="text-danger">:message</span>') !!}
	</div>
</div>	

<div class="form-group {{ $errors->has('position') ? 'has-error' : null }}">
		{!! Form::label('position', 'Position:', ['class'=>'col-sm-3 control-label']) !!}
	<div class="col-sm-9">
		{!! Form::input('text', 'position', null, ['class'=>'form-control input-sm']) !!}
		{!! $errors->first('position', '<span class="text-danger">:message</span>') !!}
	</div>
</div>	

<div class="form-group {{ $errors->has('secondary_phone') ? 'has-error' : null }}">
		{!! Form::label('secondary_phone', 'Secondary Phone:', ['class'=>'col-sm-3 control-label']) !!}
	<div class="col-sm-9">
		{!! Form::input('phone', 'secondary_phone', null, ['class'=>'form-control input-sm']) !!}
		{!! $errors->first('secondary_phone', '<span class="text-danger">:message</span>') !!}
	</div>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : null }}">
		{!! Form::label('email', 'Email Address:', ['class'=>'col-sm-3 control-label']) !!}
	<div class="col-sm-9">
		{!! Form::input('email', 'email', null, ['class'=>'form-control input-sm']) !!}
		{!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
	</div>
</div>	

<div class="form-group {{ $errors->has('public') ? 'has-error' : null }}">
		{!! Form::label('public', 'Visibility:', ['class'=>'col-sm-3 control-label']) !!}
	<div class="col-sm-9">
		{!! Form::select('public', [0=>'Private', 1=>'Public'], null, ['class'=>'form-control input-sm']) !!}
		{!! $errors->first('public', '<span class="text-danger">:message</span>') !!}
	</div>
</div>


<div class="form-group">
	<div class="col-xs-offset-1">
		{!! Form::button('Save', ['type'=>'submit', 'class'=>'btn btn-primary']) !!}
		{!! HTML::linkRoute("contacts.index", "Return to Contacts") !!}
	</div>

</div>
