<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="box box-success">
            <div class="box-header with-border">
                <div class="col-xs-6">

                </div>
                <div class="col-xs-6">
                    <a href="/admin/human_resources/employees/dgt4_to_excel/{{ request('year') }}/{{ request('month') }}"><i class="fa fa-download"></i> Download to Excel</a>
                </div>
                    <h4>
                        DGT-4 Report for {{ date('F', mktime(0,0,0, request('month'), 10)) }}, {{ request('year') }}
                        <span class="badge">{{ $results->count() }} Records</span>
                    </h4>
            </div>
    
            <div class="box-body">
                <table class="table table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Hire Date</th>
                            <th>Personal Id</th>
                            <th>Passport</th>
                            <th>Termination Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $employee)
                            <tr>
                                <td>{{ $employee->full_name }}</td>
                                <td>{{ $employee->hire_date->format('d/m/Y') }}</td>
                                <td>{{ $employee->personal_id }}</td>
                                <td>{{ $employee->passport }}</td>
                                <td>{{ $employee->termination ? $employee->termination->termination_date->format('d/m/Y') : '' }}</td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>    
            </div>
    
            {{-- <div class="box-footer"></div> --}}
            
        </div>
    </div>
        
</div>