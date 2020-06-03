@component('mail::message')
# {{ $title }}
@component('mail::table')
| Termination Date | Name | Personal ID or Passport | Site | Tenure | Termination Type |
| ---------- | ---------- | ---------- | ---------- | ---------- | ---------- |
@foreach ($employees as $termination)
| {{ $termination->termination_date->format('M-d-y') }} | {{ $termination->employee->fullName }} | {{ filled($termination->employee->personal_id) ? $termination->employee->personal_id : $termination->employee->passport }} | {{ optional($termination->employee->site)->name }} | {{ $termination->termination_date->diffForHumans($termination->employee->hire_date) }} | {{ optional($termination->terminationType)->name }} |
@endforeach
@endcomponent
@endcomponent
<style>
.inner-body {
    width: 95% !important;
}
</style>
