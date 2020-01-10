
@php
    $slot = $slot == "" ? "Date:" : $slot;
    $field_name = $field_name ?? "date"; 
    $value = $value ?? old($field_name);
    $format = $format ?? "yyyy-MM-dd";
    $since = $since ?? 20; // many days
    $allow_future_dates = $allow_future_dates ?? "false"; // must be string: true or false
    $label_class = $label_class ?? "";
    $input_class = $input_class ?? "";
@endphp
<!-- Date -->
<div class="form-group {{ $errors->has($field_name) ? 'has-error' : null }}">
    <label for="{{ $field_name }}" class="{{ $label_class }}"> 
        {{ $slot }}
        @include('components.fields._required_label')
    </label>
    <date-picker class="{{ $input_class }}"
        name="{{ $field_name }}"
        value="{{ $value }}"
        format="{{ $format }}"
        :disable-since-many-days-ago="{{ $since }}"
        :allow-future-dates="{{ (string)$allow_future_dates }}"
    ></date-picker>
    {!! $errors->first($field_name, '<span class="text-danger">:message</span>') !!}
</div>
{{-- /. Date --}}