@php
    $slot = $slot == "" ? "Select Label:" : $slot;
    $type = $type ?? "text";
    $label_class = $label_class ?? "";
    $input_class = $input_class ?? "";
    $select_class = $select_class ?? "form-control";
    $value = $value ?? null;
    $value = old($field_name) ?? $value;
@endphp
<div class="form-group {{ $errors->has($field_name) ? 'has-error' : null }}">
    <label for="{{ $field_name }}" class="{{ $label_class }}"> 
        {{ $slot }}
        @include('components.fields._required_label')
    </label>
    <div class="{{ $input_class }}">
		{!! Form::input($type, $field_name, $value, [
            'class'=> $select_class,
            'placeholder' => $slot
        ]) !!}
		{!! $errors->first($field_name, '<span class="text-danger">:message</span>') !!}
	</div>
</div>