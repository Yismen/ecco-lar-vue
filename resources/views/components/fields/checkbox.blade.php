@php
    $slot = $slot == "" ? "Select Label:" : $slot;
    $label_class = $label_class ?? "";
    $input_class = $input_class ?? "";
    $select_class = $select_class ?? "form-control";
    $value = $value ?? 1;
    $value = old($field_name) ?? $value;
@endphp
<div class="form-group {{ $errors->has($field_name) ? 'has-error' : null }}">
    <div class="checkbox">
        <label class="{{ $label_class }}"> 
            {!! Form::checkbox($field_name, $value, null) !!}
            {{ $slot }} @include('components.fields._required_label')
            {!! $errors->first($field_name, '<span class="text-danger">:message</span>') !!}
        </label>
	</div>
</div>


