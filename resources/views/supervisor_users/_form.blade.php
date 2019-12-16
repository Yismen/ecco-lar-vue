
<div class="col-sm-6">
    <!-- User -->
    <div class="form-group {{ $errors->has('user_id') ? 'has-error' : null }}">
        {!! Form::label('user_id', 'User:', ['class'=>'']) !!}
        {!! Form::select('user_id', $free_users->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => '<-- Select One -->']) !!}
        {!! $errors->first('user_id', '<span class="text-danger">:message</span>') !!}
    </div>
    <!-- /. User -->
</div>

<div class="col-sm-6">
    <!-- Supervisor -->
    <div class="form-group {{ $errors->has('supervisor_id') ? 'has-error' : null }}">
        {!! Form::label('supervisor_id', 'Supervisor:', ['class'=>'']) !!}
        {!! Form::select('supervisor_id', $free_supervisors->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => '<-- Select One -->']) !!}
        {!! $errors->first('supervisor_id', '<span class="text-danger">:message</span>') !!}
    </div>
    <!-- /. Supervisor -->
</div>
