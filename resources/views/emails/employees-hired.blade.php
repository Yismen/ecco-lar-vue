@component('mail::message')
# List of Employees Hired Since Last {{ $months + 1 }} Months
<table class="dainsys-table">
    <thead>
        <th>Hire Date</th>
        <th>Name</th>
        <th>Personal ID or Passport</th>
        <th>Site</th>
        <th>Supervisor</th>
        <th>Project</th>
        <th>Position</th>
        <th>Status</th>
    </thead>

    <tbody>
        @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->hire_date->format('M-d-y') }}</td>
                <td>{{ $employee->fullName }}</td>
                <td>{{ filled($employee->personal_id) ? $employee->personal_id : $employee->passport }}</td>
                <td>{{ optional($employee->site)->name }}</td>
                <td>{{ optional($employee->supervisor)->name }}</td>
                <td>{{ optional($employee->project)->name }}</td>
                <td>
                    {{ optional($employee->position)->name }},
                    {{ optional(optional($employee->position)->department)->name }},
                    ${{ optional($employee->position)->salary }}, {{ optional(optional($employee->position)->payment_type)->name }}
                </td>
                <td>{{ $employee->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>



@endcomponent
<style>


.inner-body {
    width: 95%;
    -premailer-width: 95%;
}


.footer {
    width: 95%;
    -premailer-width: 95%;
}

.dainsys-table tbody tr td {
    border-top: solid 1px #ccc;
}
</style>

