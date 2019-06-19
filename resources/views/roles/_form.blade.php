<!-- Name -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
	{!! Form::label('name', ' Name:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Name']) !!}
		{!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
	</div>
</div>

<!-- /. Users -->
<div class="col-md-4">
	<div class="form-group {{ $errors->has('users') ? 'has-error' : null }}">
		{!! Form::label('users', 'Users:', []) !!}
		@foreach ($role->usersList as $user)
			<div class="checkbox">
				<label>
					{!! Form::checkbox('users[]', $user->id, null, []) !!}
					{{ $user->name }}
				</label>
			</div>
		@endforeach
	</div>
</div>
<!-- /. Users -->

<!-- /Permissions -->
<div class="col-md-4">
	<div class="form-group {{ $errors->has('permissions') ? 'has-error' : null }}">
		{!! Form::label('permissions', 'Permissions:', []) !!}
		@foreach ($role->permissionsList as $permission)
			<div class="checkbox">
				<label>
					{!! Form::checkbox('permissions[]', $permission->id, null, []) !!}
					{{ $permission->name }}
				</label>
			</div>
		@endforeach
	</div>
</div>
<!-- /. Permissions -->

<!-- /Menus -->
<div class="col-md-4">
	<div class="form-group {{ $errors->has('menus') ? 'has-error' : null }}">
		{!! Form::label('menus', 'Menus:', []) !!}
		@foreach ($role->menusList as $permission)
			<div class="checkbox">
				<label>
					{!! Form::checkbox('menus[]', $permission->id, null, []) !!}
					{{ $permission->name }}
				</label>
			</div>
		@endforeach
	</div>
</div>
<!-- /. Menus -->


