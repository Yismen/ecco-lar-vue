{{-- External Info --}}
<table class="table table-condensed table-bordered table-hover {{ $employee->termination->can_be_rehired ? 'bg-success' : 'bg-warning' }}">
    <tbody>
        <tr>
            <th>Termination Date: </th>
            <td>
                {{ $employee->termination->termination_date->format('M/d/Y') }},
                {{ $employee->termination->termination_date->diffForHumans() }}. <br>
                Worked for {{ $employee->termination->termination_date->diff($employee->hire_date)->format('%y years, %m months and %d days') }}
            </td>
        </tr>

        <tr>
            <th>Termination Type:</th>
            <td>
                {{ $employee->termination->terminationType->name }},
                Most likely {{ $employee->termination->terminationType->description }}
            </td>
        </tr>

        <tr>
            <th>Termination Reason: </th>
            <td>
                {{ $employee->termination->terminationReason->reason }}
                @if (filled($employee->termination->comments))
                    : {{ $employee->termination->comments }}
                @endif
            </td>
        </tr>

        <tr>
            <th>Can Re-hire?: </th>
            <td>
                @if ($employee->termination->can_be_rehired)
                    Yes, at any time.
                @else
                    No, do not rehire this person.
                @endif
            </td>
        </tr>
    </tbody>
</table>
