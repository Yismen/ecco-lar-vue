<table class="table table-condensed table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Employee</th>
            <th>Login</th>
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
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->full_name }}</td>
                    <td></td>
                </tr>
            @endif

        @endforeach
    </tbody>
</table>
