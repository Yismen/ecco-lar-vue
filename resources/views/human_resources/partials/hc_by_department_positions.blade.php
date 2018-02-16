<div class="box box-primary danger-bg">
    <div class="box-header with-border"><h3>Total Employees by Project - Positions</h3></div>

    
    
    <div class="box-body">
        
        @foreach ($by_department_positions as $department)
            <div class="accordion" id="accordion">
                <div class="accordion-group">
                    <div class="accordion-heading">
                        
                        <a href="/admin/human_resources/employees/by_departments/{{ $department->id }}">
                            {{ $department->department }} 
                            <span class="badge">
                                {{ $department->positions->sum(function($position) {
                                    return $position->employees->sum('employees_count');
                                }) }}
                            </span>                                
                        </a>
                        <a class="accordion-toggle pull-right" data-toggle="collapse" data-parent="#accordion2" href="#collapseDeparment-{{ $department->id }}">
                            Toggle
                        </a>

                    </div>
                    <div id="collapseDeparment-{{ $department->id }}" class="accordion-body collapse">
                        <div class="accordion-inner">
                            <div class="box box-danger">
                                <div class="box-body">
                                    <table class="table table-condensed table-bordered">
                                        <tbody>
                                            @foreach ($department->positions as $position)
                                                <tr>
                                                    <th colspan="2">
                                                        <a href="/admin/human_resources/employees/by_positions/{{ $position->id }}">{{ $position->name }}</a>
                                                            @foreach ($position->employees as $employee)
                                                                <tr>
                                                                    <td>{{ $employee->gender->gender }}</td>
                                                                    <td class="col-xs-2">{{ $employee->employees_count }}</td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <th><span class="pull-right">Total</span></th>
                                                                <th>{{ $position->employees->sum('employees_count') }}</th>
                                                            </tr>
                                                    </th>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        @endforeach
        {{-- {{ dd($by_department->positions) }} --}}
        {{-- {{ $by_department->positions->employees->sum('employees_count') }} --}}
    </div>

    <div class="box-footer"></div>
    
</div>