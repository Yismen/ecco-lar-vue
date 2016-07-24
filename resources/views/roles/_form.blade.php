
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

<!-- Role Name -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
	{!! Form::label('name', 'Role Name:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Role Name']) !!}
	</div>
	{{-- {!! $errors->first('name', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Role Name -->

<!-- Display Name -->
<div class="form-group {{ $errors->has('display_name') ? 'has-error' : null }}">
	{!! Form::label('display_name', 'Display Name:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'display_name', null, ['class'=>'form-control', 'placeholder'=>'Display Name']) !!}
	</div>
	{{-- {!! $errors->first('display_name', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Display Name -->

<!-- Description -->
<div class="form-group {{ $errors->has('description') ? 'has-error' : null }}">
	{!! Form::label('description', 'Description:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'description', null, ['class'=>'form-control', 'placeholder'=>'Description']) !!}
	</div>
	{{-- {!! $errors->first('description', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Description -->

<!-- Users -->
<div class="form-group {{ $errors->has('users') ? 'has-error' : null }}">
	{!! Form::label('users', 'Users:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{{-- {!! Form::select('users_lists[]', $role->usersList, null, ['class'=>'form-control', 'multiple'=>"multiple", 'id'=>'users_lists'])!!} --}}
		@foreach ($role->usersList as $key=>$value)			
			<div class="checkbox">
				<label>
					{!! Form::checkbox('users[]', $key, null, []) !!}
					{{ $value }}
				</label>
			</div>
		@endforeach
		<span class="help-block">!! Select the roles that will be served with this Role item:</span>
	</div>
	{{-- {!! $errors->first('roles', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Users -->

<!-- Permissions -->
<div class="form-group {{ $errors->has('roles') ? 'has-error' : null }}">
	{!! Form::label('perms', 'Permissions:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('perms[]', $role->permissionsList, null, ['class'=>'form-control', 'multiple'=>"multiple", 'id'=>'permissions_lists', 'style'=>'width: 100%'])!!}
		@foreach ($role->permissionsList as $key=>$value)			
			<div class="checkbox">
				<label>
					{!! Form::checkbox('perms[]', $key, null, []) !!}
					{{ $value }}
				</label>
			</div>
		@endforeach
		<span class="help-block">!! Select the roles that will be served with this Role item:</span>
	</div>
	{{-- {!! $errors->first('roles', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Permissions -->

<!-- Menus -->
{{-- <div class="form-group {{ $errors->has('menus') ? 'has-error' : null }}">
	{!! Form::label('menus', 'Menus:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('menus[]', $role->menusList, null, ['class'=>'form-control', 'multiple'=>"multiple", 'id'=>'menus'])!!}
		<span class="help-block">!! Select the roles that will be served with this Role item:</span>
	</div>
</div> --}}

<div class="form-group {{ $errors->has('menus') ? 'has-error' : null }}">	
	{!! Form::label('menus', 'Menus:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		@foreach ($role->menusList as $key=>$value)			
			<div class="checkbox">
				<label>
					{!! Form::checkbox('menus[]', $key, null, []) !!}
					{{ $value }}
				</label>
			</div>
		@endforeach
	</div>
</div>
<!-- /. Menus -->

@section('scripts')
	
@stop


