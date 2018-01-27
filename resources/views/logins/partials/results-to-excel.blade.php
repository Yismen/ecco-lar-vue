<table class="table table-condensed table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Employee</th>
            <th>Login</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($logins as $login)
        <tr>
            <td>{{ $login->employee->id }}</td>
            <td>{{ $login->employee->full_name }}</td>
            <td>{{ $login->login }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
