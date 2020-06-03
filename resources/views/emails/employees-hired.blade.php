
@component('mail::message')
# {{ $title }}
@component('mail::table')
| Hire Date | Name | Personal ID or Passport | Site | Project | Position | Supervisor |
| ---------- | ---------- | ---------- | ---------- | ---------- | ---------- | ---------- |
@foreach ($employees as $employee)
| {{ $employee->hire_date->format('M-d-y') }} | {{ $employee->fullName }} | {{ filled($employee->personal_id) ? $employee->personal_id : $employee->passport }} | {{ optional($employee->site)->name }} | {{ optional($employee->project)->name }} | {{ optional($employee->position)->name }}, {{ optional(optional($employee->position)->department)->name }} | {{ optional($employee->supervisor)->name }} |
@endforeach
@endcomponent
@endcomponent
<style>
    .inner-body {
        width: 90% !important;
    }
</style>