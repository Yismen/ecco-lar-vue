{{-- External Info --}}
<table class="table table-condensed table-bordered table-hover">
    <tbody>
        <tr>
            <th>Social #: </th>
            <td>
                {{ optional($employee->social_security)->number }}
            </td>
        </tr>

        <tr>
            <th>ARS: </th>
            <td>
                {{ optional($employee->ars)->name }}
            </td>
        </tr>

        <tr>
            <th>AFP: </th>
            <td>
                {{ optional($employee->afp)->name }}
            </td>
        </tr>

        <tr>
            <th>Bank Info: </th>
            <td>
                {{ 
                    optional($employee->bankAccount)->account_number 
                }}@if ($employee->bankAccount && $employee->bankAccount->has('bank')){{ 
                    ", at {$employee->bankAccount->bank->name}" 
                }}@endif
            </td>
        </tr>
    </tbody>
</table>
