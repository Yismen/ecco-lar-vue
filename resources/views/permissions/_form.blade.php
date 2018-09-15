<!-- Resource -->
<div class="form-group {{ $errors->has('resource') ? 'has-error' : null }}">
	{!! Form::label('resource', 'Resource:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'resource', null, ['class'=>'form-control', 'placeholder'=>'Resource']) !!}
		{!! $errors->first('resource', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Resource -->

<!-- Permissions -->
<div class="form-group {{ $errors->has('permission') ? 'has-error' : null }}">
	{!! Form::label('permission', 'Permissions To:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		
		<div class="btn-group" >
			<label>				
				{!! Form::checkbox('permission[]', 'all', null, []) !!}
				All
			</label>
			<label>				
				{!! Form::checkbox('permission[]', 'view', null, []) !!}
				View
			</label>
			<label>
				{!! Form::checkbox('permission[]', 'create', null, []) !!}
				Create
			</label>
			<label>
				{!! Form::checkbox('permission[]', 'edit', null, []) !!}
				Edit
			</label>
			<label>
				{!! Form::checkbox('permission[]', 'destroy', null, []) !!}
				Destroy
			</label>
		</div>
		{!! $errors->first('permission', '<span class="text-danger">:message</span>') !!}
	</div>
		
</div>
<!-- /. Permissions -->

<!-- Roles -->
<div class="form-group {{ $errors->has('roles_list') ? 'has-error' : null }}">
	{!! Form::label('roles_list', 'Roles:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('roles_list[]', $roles, null, ['class'=>'form-control', 'multiple'=>"multiple", 'id'=>'roles_list']) !!}
		<span class="help-block">!! Select the roles that will be served with this Permission item:</span>
		{!! $errors->first('roles_list', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Roles -->

<!-- Permission Name -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
	{!! Form::label('name', 'Permission Name:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Permission Name']) !!}
		{!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Permission Name -->

<!-- Display Name -->
<div class="form-group {{ $errors->has('display_name') ? 'has-error' : null }}">
	{!! Form::label('display_name', 'Display Name:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'display_name', null, ['class'=>'form-control', 'placeholder'=>'Display Name']) !!}
		{!! $errors->first('display_name', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Display Name -->

<!-- Description -->
<div class="form-group {{ $errors->has('description') ? 'has-error' : null }}">
	{!! Form::label('description', 'Description:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'description', null, ['class'=>'form-control', 'placeholder'=>'Description']) !!}
		{!! $errors->first('description', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Description -->

<!-- Roles -->
<div class="form-group {{ $errors->has('roles_list') ? 'has-error' : null }}">
	{!! Form::label('roles_list', 'Roles:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('roles_list[]', $roles, null, ['class'=>'form-control', 'multiple'=>"multiple", 'id'=>'roles_list']) !!}
		<span class="help-block">!! Select the roles that will be served with this Permission item:</span>
		{!! $errors->first('roles_list', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Roles -->

{{--
<!-- Permission Name -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
	{!! Form::label('name', 'Permission Name:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Permission Name']) !!} {!! $errors->first('name',
		'<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Permission Name -->

<!-- Display Name -->
<div class="form-group {{ $errors->has('display_name') ? 'has-error' : null }}">
	{!! Form::label('display_name', 'Display Name:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'display_name', null, ['class'=>'form-control', 'placeholder'=>'Display Name']) !!} {!! $errors->first('display_name',
		'<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Display Name -->

<!-- Description -->
<div class="form-group {{ $errors->has('description') ? 'has-error' : null }}">
	{!! Form::label('description', 'Description:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'description', null, ['class'=>'form-control', 'placeholder'=>'Description']) !!} {!! $errors->first('description',
		'<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Description -->

<!-- Roles -->
<div class="form-group {{ $errors->has('roles_list') ? 'has-error' : null }}">
	{!! Form::label('roles_list', 'Roles:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('roles_list[]', $roles, null, ['class'=>'form-control', 'multiple'=>"multiple", 'id'=>'roles_list']) !!}
		<span class="help-block">!! Select the roles that will be served with this Permission item:</span> {!! $errors->first('roles_list',
		'<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Roles -->--}}