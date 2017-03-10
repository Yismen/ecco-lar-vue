
<div class="form-group {{ $errors->has($name) ? 'has-error' : null }}">
    {!! Form::label("$name", "$label", ['class'=>'']) !!}
    {!! Form::select("$name", $carbon, null, ['class'=>'form-control input-sm']) !!}
    {!! $errors->first($name, '<span class="text-danger">:message</span>') !!}
</div>
<!-- /. $label -->