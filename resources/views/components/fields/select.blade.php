
@php
    $slot = $slot == "" ? "Select Label:" : $slot;
    $label_class = $label_class ?? "";
    $input_class = $input_class ?? "";
    $select_class = $select_class ?? "form-control";
    $required = $required ?? true;
@endphp
<div class="form-group {{ $errors->has($field_name) ? 'has-error' : null }}">
    <label for="{{ $field_name }}" class="{{ $label_class }}"> 
        {{ $slot }}
        @include('components.fields._required_label')
    </label>
    <div class="{{ $input_class }}">
		{!! Form::select($field_name, $list_array, null, [
            'class'=> $select_class,
            'placeholder' => '<-- Select One -->'
        ]) !!}
		{!! $errors->first($field_name, '<span class="text-danger">:message</span>') !!}
	</div>
</div>