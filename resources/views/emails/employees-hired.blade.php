@component('mail::message')
# List of Employees Hired Since {{ $months }} Months Ago
<table class="dainsys-table">
    <thead>
        <th>Hire Date</th>
        <th>Name</th>
        <th>Personal ID or Passport</th>
        <th>Site</th>
        <th>Project</th>
        <th>Position</th>
        <th>Supervisor</th>
        <th>Status</th>
    </thead>

    <tbody>
        @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->hire_date->format('M-d-y') }}</td>
                <td>{{ $employee->fullName }}</td>
                <td>{{ filled($employee->personal_id) ? $employee->personal_id : $employee->passport }}</td>
                <td>{{ optional($employee->site)->name }}</td>
                <td>{{ optional($employee->project)->name }}</td>
                <td>
                    {{ optional($employee->position)->name }},
                    {{ optional(optional($employee->position)->department)->name }}
                </td>
                <td>{{ optional($employee->supervisor)->name }}</td>
                <td>{{ $employee->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>



@endcomponent
<style>


.inner-body {
    width: 95% !important;
    -premailer-width: 95% !important;
}


.content-cell{
    display: flex;
    flex-direction: column;
    align-items: center;
}


.footer {
    width: 95% !important;
    -premailer-width: 95% !important;
}

.dainsys-table tbody tr td {
    border-top: solid 1px #ccc !important;
    border-right: solid 1px #ccc !important;
    margin: 0 !important;
}
</style>

