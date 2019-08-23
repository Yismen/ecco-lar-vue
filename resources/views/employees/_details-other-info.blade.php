
{{-- Internal Info --}}
<table class="table table-condensed table-bordered table-hover">
    <tbody>
        <tr>
            <th>Hired On: </th>
            <td>
                {{ $employee->hire_date->format('M-d-Y') }},
                {{ $employee->hire_date->diffForHumans() }}
            </td>
        </tr>

        <tr>
            <th>Site: </th>
            <td>
                {{ optional($employee->site)->name }}
            </td>
        </tr>

        <tr>
            <th>Department: </th>
            <td>
                {{ $employee->position && $employee->position->department ? $employee->position->department->name : '' }}
            </td>
        </tr>

        <tr>
            <th>Project: </th>
            <td>
                {{ optional($employee->project)->name }}
            </td>
        </tr>

        <tr>
            <th>Position: </th>
            <td>
                {{ optional($employee->position)->name }}
            </td>
        </tr>

        <tr>
            <th>Salary: </th>
            <td>
                @if ($employee->position)
                    {{ $employee->position->payment_type ? $employee->position->payment_type->name : ''  }},
                    ${{ $employee->position->salary }}


                @endif
            </td>
        </tr>

        <tr>
            <th>Supervisor: </th>
            <td>
                {{ optional($employee->supervisor)->name }}
            </td>
        </tr>

        <tr>
            <th>Sec. Card #: </th>
            <td>
                {{ optional($employee->card)->card }}
            </td>
        </tr>

        <tr>
            <th>Punch Id: </th>
            <td>
                {{ optional($employee->punch)->punch }}
            </td>
        </tr>

        <tr>
            <th>Login Names: </th>
            <td>
                @if ($employee->loginNames->count() > 0)
                    <ul>
                        @foreach ($employee->loginNames as $login)
                            <li>{{ $login->login }}</li>
                        @endforeach
                    </ul>
                @endif
            </td>
        </tr>
    </tbody>
</table>
