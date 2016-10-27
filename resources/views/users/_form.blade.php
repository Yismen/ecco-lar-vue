
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

<!-- User Name -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
	{!! Form::label('name', 'User Name:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'User Name']) !!}
	</div>
	{{-- {!! $errors->first('name', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. User Name -->

<!-- User email -->
<div class="form-group {{ $errors->has('email') ? 'has-error' : null }}">
	{!! Form::label('email', 'User email:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('email', 'email', null, ['class'=>'form-control', 'placeholder'=>'User email']) !!}
	</div>
	{{-- {!! $errors->first('email', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. User email -->

<!-- User Username -->
<div class="form-group {{ $errors->has('username') ? 'has-error' : null }}">
	{!! Form::label('username', 'User Username:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'username', null, ['class'=>'form-control', 'placeholder'=>'User Username']) !!}
	</div>
	{{-- {!! $errors->first('username', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. User Username -->

<!-- User Is Active -->
<div class="form-group {{ $errors->has('is_active') ? 'has-error' : null }}">
	{!! Form::label('is_active', 'User Is Active:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('is_active', $user->activeList, null, ['class'=>'form-control', 'id'=>'is_active'])!!}
	</div>
	{{-- {!! $errors->first('roles', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. User Is Active -->

<!-- User Is Admin -->
<div class="form-group {{ $errors->has('is_admin') ? 'has-error' : null }}">
	{!! Form::label('is_admin', 'User Is Admin:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('is_admin', $user->adminList, null, ['class'=>'form-control', 'id'=>'is_admin'])!!}
		<span class="help-block text-danger">Very dangerous. If you make the user admin it will 
			have access to every module of the app.</span>
	</div>
	{{-- {!! $errors->first('roles', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. User Is Admin -->

<!-- Roles -->
{{-- <div class="form-group {{ $errors->has('roles') ? 'has-error' : null }}">
	{!! Form::label('roles', 'Roles:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('roles[]', $rolesList, null, ['class'=>'form-control', 'multiple'=>"multiple", 'id'=>'roles_lists'])!!}
		<span class="help-block">!! Select the roles that will be served with this menu item:</span>
	</div>
</div>--}}
<!-- /. Roles -->

<!-- Roles -->
{{-- {{ dd($rolesList) }} --}}
<div class="form-group {{ $errors->has('roles') ? 'has-error' : null }}">	
	{!! Form::label('roles', 'Roles:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		@foreach ($rolesList as $role)			
			<div class="checkbox">
				<label>
					{!! Form::checkbox('roles[]', $role->id, null, []) !!}
					{{ $role->display_name }}
				</label>
			</div>
		@endforeach
	</div>
</div>
<!-- /. Roles -->


{{-- 
<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
<script>
	jQuery(document).ready(function($) {
		$('#roles').select2();
	});
</script>
 --}}


