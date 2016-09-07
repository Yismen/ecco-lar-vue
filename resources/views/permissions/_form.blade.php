
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

<!-- Permission Name -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
	{!! Form::label('name', 'Permission Name:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Permission Name']) !!}
	</div>
	{{-- {!! $errors->first('name', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Permission Name -->

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

<!-- Roles -->
<div class="form-group {{ $errors->has('roles') ? 'has-error' : null }}">
	{!! Form::label('roles_list', 'Roles:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::select('roles_list[]', $roles, null, ['class'=>'form-control', 'multiple'=>"multiple", 'id'=>'roles']) !!}
		<span class="help-block">!! Select the roles that will be served with this Permission item:</span>
	</div>
	{{-- {!! $errors->first('roles', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Roles -->