<div class="box box-primary danger-bg">
    <div class="box-header with-border"><h4>Total Active Employees by Project (by gender)</h4></div>

    <div class="box-body">

        @if ($hc_by_department->count() > 0)
            <table class="table table-condensed table-bordered">
                <thead>
                    <tr>
                        <th>Department</th>
                        <th class="col-xs-2">Head Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hc_by_department as $department)
                        <tr>
                            <td>
                                <a href="/admin/human_resources/employees/by_departments/{{ $department->id }}">{{ $department->name }}</a>
                            </td>
                            <td>{{ $department->employees_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th><span class="pull-right">Total:</span></th>
                        <th class="col-xs-2">{{ $hc_by_department->sum('employees_count') }}</th>
                    </tr>
                </tfoot>
            </table>
        @endif

    </div>

</div>