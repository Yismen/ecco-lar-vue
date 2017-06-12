<div class="box box-primary danger-bg">
    <div class="box-header with-border"><h4>Total Employees by Proyect - Positions</h4></div>

    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Department</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($by_department as $department)
                        @if ($department->positions->sum('employees_count') > 0)
                            <tr>
                                <td>{{ $department->department }}</td>
                                <td>{{ $department->positions->sum('employees_count') }}</td>
                            </tr>
                        @endif
                            
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total:</th>
                        <th>{{ $by_department->sum('positions.employees_count') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="box-footer"></div>
    
</div>