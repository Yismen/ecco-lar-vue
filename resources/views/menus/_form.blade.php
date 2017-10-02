<!-- Menu Name -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
    {!! Form::label('name', 'Route: \'admin/\'', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Menu Name']) !!}
        {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
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
<div class="form-group {{ $errors->has('roles_list') ? 'has-error' : null }}">
    {!! Form::label('roles_list', 'Roles:', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('roles_list[]', $rolesList, null, ['class'=>'form-control', 'multiple'=>"multiple", 'id'=>'roles_list'])!!}
        {!! $errors->first('roles_list', '<span class="text-danger">:message</span>') !!}
        <span class ="help-block">!! Select the roles that will be served with this menu item:</span>
    </div>
</div>
<!-- /. Roles -->


