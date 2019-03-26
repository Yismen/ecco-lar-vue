<table class="table table-condensed table-bordered">
    <thead>
        <tr>
            <th>employee_id</th>
            <th>name</th>
            <th>login_name</th>
            <th>supervisor_id</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $employee)
            @if ($employee->loginNames()->count())
                @foreach ($employee->loginNames as $login_name)
                    <tr>
                        <td>{{ $login_name->employee->id }}</td>
                        <td>{{ $login_name->employee->full_name }}</td>
                        <td>{{ $login_name->login }}</td>
                        <td>{{ optional($login_name->employee->supervisor)->id }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->full_name }}</td>
                    <td></td>
                    <td>{{ optional($employee->supervisor)->id }}</td>
                </tr>
            @endif

        @endforeach
    </tbody>
</table>
