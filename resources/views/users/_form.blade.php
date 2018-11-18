
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

<!-- Name -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
	{!! Form::label('name', 'Name:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Name']) !!}
	</div>
	{{-- {!! $errors->first('name', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Name -->

<!-- Email -->
<div class="form-group {{ $errors->has('email') ? 'has-error' : null }}">
	{!! Form::label('email', 'Email:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('email', 'email', null, ['class'=>'form-control', 'placeholder'=>'Email']) !!}
	</div>
	{{-- {!! $errors->first('email', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Email -->

<!-- Username -->
<div class="form-group {{ $errors->has('username') ? 'has-error' : null }}">
	{!! Form::label('username', 'Username:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'username', null, ['class'=>'form-control', 'placeholder'=>'Username']) !!}
	</div>
	{{-- {!! $errors->first('username', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Username -->

<!-- Is Active -->
<div class="form-group {{ $errors->has('is_active') ? 'has-error' : null }}">
	{!! Form::label('is_active', 'Is Active:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('is_active', $user->activeList, null, ['class'=>'form-control', 'id'=>'is_active'])!!}
	</div>
	{{-- {!! $errors->first('roles', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Is Active -->

<!-- Is Admin -->
<div class="form-group {{ $errors->has('is_admin') ? 'has-error' : null }}">
	{!! Form::label('is_admin', 'Is Admin:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('is_admin', $user->adminList, null, ['class'=>'form-control', 'id'=>'is_admin'])!!}
		<span class="help-block text-danger">Very dangerous. If you make the user admin it will 
			have access to every module of the app.</span>
	</div>
	{{-- {!! $errors->first('roles', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Is Admin -->

<!-- Roles -->
{{-- {{ dd($rolesList) }} --}}
<div class="form-group {{ $errors->has('roles') ? 'has-error' : null }}">	
	{!! Form::label('roles', 'Roles:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		@foreach ($user->rolesList as $role)			
			<div class="checkbox">
				<label>
					{!! Form::checkbox('roles[]', $role->id, null, []) !!}
					{{ $role->name }}
				</label>
			</div>
		@endforeach
	</div>
</div>
<!-- /. Roles -->

