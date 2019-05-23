<!-- Name -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
	{!! Form::label('name', ' Name:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Name']) !!}
		{!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Name -->

<!-- Users -->
<div class="form-group {{ $errors->has('users') ? 'has-error' : null }}">
	{!! Form::label('users', 'Users:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('users[]', $role->usersList, null, ['class'=>'form-control', 'multiple'=>"multiple", 'id'=>'userss'])!!}
		<span class="help-block">!! Select the roles that will be served with this Role item:</span>
		{!! $errors->first('roles', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Users -->

<!-- Permissions -->
<div class="form-group {{ $errors->has('permissions') ? 'has-error' : null }}">
	{!! Form::label('permissions', 'Permissions:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('permissions[]', $role->permissionsList, null, ['class'=>'form-control', 'multiple', 'id'=>'permissions'])!!}
		<span class="help-block">!! Select the roles that will be served with this Role item:</span>
		{!! $errors->first('roles', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Permissions -->

<div class="form-group {{ $errors->has('menus') ? 'has-error' : null }}">
	{!! Form::label('menus', 'Menus:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('menus[]', $role->menusList, null, ['class'=>'form-control', 'multiple'=>"multiple", 'id'=>'menus'])!!}
		<span class="help-block">!! Select the roles that will be served with this Role item:</span>
		{!! $errors->first('menus', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Menus -->


