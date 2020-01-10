@php    
    $required = $required ?? true;
@endphp
@if ($required)
    <span class="text-danger" title="Required field!">***</span>
@endif