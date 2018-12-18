
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
            <th>Celular</th>
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
                <td>{{ $employee->personal_id ?? $employee->passport }}</td>
                <td>{{ $employee->cellphone_number }}</td>
                <td>{{ $employee->bankAccount->account_number ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
