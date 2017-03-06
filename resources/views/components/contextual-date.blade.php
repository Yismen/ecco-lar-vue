<?php
    $carbon = new Carbon();
    $data = [
        $carbon->today() => 'Today',
        $carbon->yesterday() => 'Yesterday',
        $carbon->today() => 'This Week',
        $carbon->today() => 'Last Week',
        $carbon->today() => 'This Month',
        $carbon->today() => 'Last Mont',
        $carbon->today() => 'This Year',
        $carbon->today() => 'Last Year',

    ]
?>
<div class="form-group {{ $errors->has($name) ? 'has-error' : null }}">
    {!! Form::label("$name", "$label":, ['class'=>'']) !!}
    {!! Form::select("$name", [], null, ['class'=>'form-control input-sm']) !!}
    {!! $errors->first($name, '<span class="text-danger">:message</span>') !!}
</div>
<!-- /. $label -->