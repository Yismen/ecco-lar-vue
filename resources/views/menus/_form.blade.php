<!-- Menu Name -->
<div class="form-group ">
    {!! Form::label('name', 'Route:', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        <div class="row">
            <div class="col-xs-7 {{ $errors->has('name') ? 'has-error' : null }}">
                {!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Menu Name']) !!}
                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
            </div>
            <div class="col-xs-5">            
                <div class="checkbox">
                    <label>                        
                        {!! Form::checkbox('is_admin', 1, null, ['checked'=>true]) !!}                        
                        Is Admin
                    </label>
                </div>            
            </div>
        </div>
    </div>
</div>
<!-- /. Menu Name -->

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

<!-- Icon Class -->
<div class="form-group {{ $errors->has('icon') ? 'has-error' : null }}">
    {!! Form::label('icon', 'Icon Class:', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::input('text', 'icon', null, ['class'=>'form-control', 'placeholder'=>'Icon Class']) !!}
        {!! $errors->first('icon', '<span class="text-danger">:message</span>') !!}
    </div>
</div>
<!-- /. Icon Class -->

<!-- Roles -->
<div class="form-group {{ $errors->has('roles') ? 'has-error' : null }}">
	{!! Form::label('roles', 'Roles:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		<div class="row">
			@foreach ($menu->roles_list as $id => $role)								
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


