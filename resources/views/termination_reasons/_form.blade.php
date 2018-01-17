<div class="form-group {{ $errors->has('reason') ? 'has-error' : null }}">
{!! Form::label('reason', 'Termination Reason:', ['class'=>'']) !!}
{!! Form::input('text', 'reason', null, ['class'=>'form-control', 'placeholder'=>'Termination Reason']) !!}
{!! $errors->first('reason', '<span class="text-danger">:message</span>') !!}
</div>
<!-- /. Termination Reason -->

<div class="form-group {{ $errors->has('description') ? 'has-error' : null }}">
    {!! Form::label('description', 'Description:', ['class'=>'']) !!}
    {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Describe the reason that can cause the use of this option']) }}
    {!! $errors->first('description', '<span class="text-danger">:message</span>') !!}
</div>
<!-- /. Description -->