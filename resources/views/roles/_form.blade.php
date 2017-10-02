<!-- Role Name -->
{{-- <div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
	{!! Form::label('name', 'Role Name:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Role Name']) !!}
		{!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
	</div>
</div> --}}
<!-- /. Role Name -->

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

<!-- Users -->
<div class="form-group {{ $errors->has('users_list') ? 'has-error' : null }}">
	{!! Form::label('users_list', 'Users:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('users_list[]', $usersList, null, ['class'=>'form-control', 'multiple'=>"multiple", 'id'=>'users_lists'])!!}
		<span class="help-block">!! Select the roles that will be served with this Role item:</span>
		{!! $errors->first('roles', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Users -->

<!-- Permissions -->
<div class="form-group {{ $errors->has('permissions_list') ? 'has-error' : null }}">
	{!! Form::label('permissions_list', 'Permissions:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('permissions_list[]', $permissionsList, null, ['class'=>'form-control', 'multiple', 'id'=>'permissions_list'])!!}
		<span class="help-block">!! Select the roles that will be served with this Role item:</span>
		{!! $errors->first('roles', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Permissions -->

<div class="form-group {{ $errors->has('menus_list') ? 'has-error' : null }}">	
	{!! Form::label('menus_list', 'Menus:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">	
		{!! Form::select('menus_list[]', $menusList, null, ['class'=>'form-control', 'multiple'=>"multiple", 'id'=>'menus'])!!}
		<span class="help-block">!! Select the roles that will be served with this Role item:</span>
		{!! $errors->first('menus_list', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Menus -->


