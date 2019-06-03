<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
{!! Form::label('name', 'Termination Type:', ['class'=>'']) !!}
{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Termination Type']) !!}
{!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
</div>
<!-- /. Termination Type -->

<div class="form-group {{ $errors->has('description') ? 'has-error' : null }}">
    {!! Form::label('description', 'Description:', ['class'=>'']) !!}
    {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Describe the type that can cause the use of this option']) }}
    {!! $errors->first('description', '<span class="text-danger">:message</span>') !!}
</div>
<!-- /. Description -->
