<h2>Employees List</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Employee ID</th>
            <th>Nombre</th>
            <th>Segundo Nombre</th>
            <th>Apellido</th>
            <th>Segundo Apellido</th>
            <th>Fecha de Entrada</th>
            <th>Cedula o Pasaporte</th>
            <th>Celucar</th>
            <th>Cuenta de Banco</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->second_first_name }}</td>
                <td>{{ $employee->last_name }}</td>
                <td>{{ $employee->second_last_name }}</td>
                <td>{{ $employee->hire_date->format('m/d/Y') }}</td>                
                @if ($employee->personal_id)
                    <td>{{ $employee->personal_id }}</td>
                @else
                    <td>{{ $employee->passport }}</td>
                @endif
                <td>{{ $employee->cellphone_number }}</td>
                <td>{{ $employee->bankAccount->account_number or '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>