<table class="table table-condensed table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Employee</th>
            <th>Login</th>
            <th class="col-xs-2">
                <a href="{{ route('admin.logins.create') }}">
                    <i class="fa fa-plus"></i> Add
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $employee)
            @foreach ($employee->logins as $login)  
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>
                        <a href="{{ route('admin.employees.show', $employee->id) }}">
                            {{ $employee->full_name }} 
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.logins.show', $login->id) }}">{{ $login->login }}</a>
                    </td>
                    <td>
                        <a href="{{ route('admin.logins.edit', $login->id) }}" class="text-warning">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                    </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
