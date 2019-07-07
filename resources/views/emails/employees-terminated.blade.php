@php
    \Carbon\Carbon::setLocale('en');
@endphp
@component('mail::message')
# List of Employees Hired Terminated Since Last Month

@component('mail::table')
<table>
    <thead>
        <th>Termination Date</th>
        <th>Name</th>
        <th>Personal ID or Passport</th>
        <th>Site</th>
        <th>Tenure</th>
        <th>Termination Type</th>
        <th>Termination Reason</th>
    </thead>

    <tbody>
        @foreach ($employees as $employee)
            <tr>
                <td>{{ optional($employee->termination)->termination_date->format('M-d-y') }}</td>
                <td>{{ $employee->fullName }}</td>
                <td>{{ filled($employee->personal_id) ? $employee->personal_id : $employee->passport }}</td>
                <td>{{ optional($employee->site)->name }}</td>
                <td>{{ optional($employee->termination)->termination_date->diffForHumans($employee->hire_date) }}</td>
                <td>{{ optional(optional($employee->termination)->terminationType)->name }}</td>
                <td>{{ optional(optional($employee->termination)->terminationReason)->reason }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endcomponent

@endcomponent
