<!-- Resource -->
<div class="form-group {{ $errors->has('resource') ? 'has-error' : null }}">
	{!! Form::label('resource', 'Resource:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'resource', null, ['class'=>'form-control', 'placeholder'=>'Resource']) !!}
		{!! $errors->first('resource', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Resource -->

<!-- Actions -->
<div class="form-group {{ $errors->has('actions') ? 'has-error' : null }}">
	{!! Form::label('actions', 'Actions:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		
		<div class="btn-group" >
			<label class="text-primary" style="padding: 0 2.5em 0 0;">				
				{!! Form::checkbox('actions[]', 'all', null, []) !!}
				All
			</label class="text-info">
			<span style="border: gray solid 1px; padding: .25em; border-radius: .25em;">
				<label>				
					{!! Form::checkbox('actions[]', 'view', null, []) !!}
					View
				</label>
				<label class="text-default">
					{!! Form::checkbox('actions[]', 'create', null, []) !!}
					Create
				</label>
				<label class="text-warning">
					{!! Form::checkbox('actions[]', 'edit', null, []) !!}
					Edit
				</label>
				<label class="text-danger">
					{!! Form::checkbox('actions[]', 'destroy', null, []) !!}
					Destroy
				</label>
			</span>
		</div>
		{!! $errors->first('actions', '<span class="text-danger">:message</span>') !!}
	</div>
		
</div>
<!-- /. Actions -->

<!-- Roles -->
<div class="form-group {{ $errors->has('roles') ? 'has-error' : null }}">
	{!! Form::label('roles', 'Roles:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		<div class="row">
			@foreach ($permission->roles_list as $id => $role)								
				<div class="col-sm-4">
					<div class="checkbox">
						<label>
							{!! Form::checkbox('roles[]', $id, null, []) !!} 
							{{ $role }}
						</label>
					</div>
				</div>	
			@endforeach
		</div>									
	</div>
</div>
<!-- /. Roles -->