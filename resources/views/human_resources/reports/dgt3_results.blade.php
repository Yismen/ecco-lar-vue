<div class="row">
    <div class="col-sm-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <div class="col-xs-8">
                    <h4>DGT-3 Report for Year {{ request('year') }} <span class="badge">{{ $results->count() }} Records</span></h4>
                </div>
                <div class="col-xs-4">
                    <a href="/admin/human_resources/employees/dgt3_to_excel/{{ request('year') }}"><i class="fa fa-download"></i> Download to Excel</a>
                </div>
            </div>
    
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre(s) y Apellido(s) del Trabajador</th>
                                <th>Cédula de Identidad y Electoral</th>
                                <th>No. Sistema Dominicano de Seguridad Social</th>
                                <th>Fecha de Nacimiento (dd/mm/aaaa)</th>
                                <th>Hombre</th>
                                <th>Mujer</th>
                                <th>Nacionalidad</th>
                                <th>Fecha de Entrada (dd/mm/aaaa)</th>
                                <th>Ocupación</th>
                                <th>Salario Mensual RD$</th>
                                <th>Turno</th>
                                <th>Vacaciones Desde</th>
                                <th>Vacaciones Hasta</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $employee)
                                <tr>
                                    <td>{{ $employee->full_name }}</td>
                                    <td>{{ $employee->personal_id or $employee->passport }}</td>
                                    <td>{{ $employee->socialSecurity->number or null}}</td>
                                    <td>{{ $employee->date_of_birth->format('d/m/Y') }}</td>
                                    <td>{{ $employee->isOfGender('Masculine', 'X') }}</td>
                                    <td>{{ $employee->isOfGender('femenine', 'X') }}</td>
                                    {{-- <td>{{ $employee->isFemenine() ? 'x' : null }}</td> --}}
                                    <td>Dominicano / "Verificar si es extrangero"</td>
                                    <td>{{ $employee->hire_date->format('d/m/Y') }}</td>
                                    <td>{{ $employee->position->name or "AGENTE CALL CENTER" }}</td>
                                    <td>{{ number_format($employee->computedSalary(), 2) }}</td>
                                    <td>1</td>
                                    <td>{{ $employee->vacationsStarts()->format('d/m') }} </td>
                                    <td>{{ $employee->vacationsEnds()->format('d/m') }} </td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>    
                </div>
            </div>
    
            {{-- <div class="box-footer"></div> --}}
            
        </div>
    </div>
        
</div>