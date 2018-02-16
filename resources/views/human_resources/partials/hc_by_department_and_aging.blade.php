<div class="box box-primary danger-bg">
    <div class="box-header with-border"><h3>Total Employees by Project - Positions</h3></div>


    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-condensed table-bordered">
                <thead>
                    <tr>
                        <th>Department</th>
                        <th class="col-xs-2">< 8 Months</th>
                        <th class="col-xs-2">>= 8 Months</th>
                        <th class="col-xs-2">>= 1 Year, 4 Months</th>
                        <th class="col-xs-2">>= 2 Years</th>
                        <th class="col-xs-2">>= 2 Years, 8 Months</th>
                        <th class="col-xs-2">>= 3 Years, 4 Months</th>
                        <th class="col-xs-2">>= 4 Years</th>
                        <th class="col-xs-2">>= 4 Years, 8 Months</th>
                        <th class="col-xs-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hc_by_department_and_aging as $department)
                        <tr>
                            <td>{{ $department->department }}</td>
                            <td>{{ $department->employees_last_tree_months_count }}</td>
                            <td>{{ $department->employees_between_three_and_six_months_count }}</td>
                            <td>{{ $department->employees_between_six_and_nime_months_count }}</td>
                            <td>{{ $department->employees_between_nime_months_and_a_year_count }}</td>
                            <td>{{ $department->employees_between_one_and_three_years_count }}</td>
                            <td>{{ $department->employees_over_three_years_count }}</td>
                            <td>{{ $department->employees_over_three_years_count }}</td>
                            <td>{{ $department->employees_over_three_years_count }}</td>
                            <td>{{ $department->employees_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Totals</th>
                        <th>{{ $hc_by_department_and_aging->sum('employees_last_tree_months_count') }}</th>
                        <th>{{ $hc_by_department_and_aging->sum('employees_between_three_and_six_months_count') }}</th>
                        <th>{{ $hc_by_department_and_aging->sum('employees_between_six_and_nime_months_count') }}</th>
                        <th>{{ $hc_by_department_and_aging->sum('employees_between_nime_months_and_a_year_count') }}</th>
                        <th>{{ $hc_by_department_and_aging->sum('employees_between_one_and_three_years_count') }}</th>
                        <th>{{ $hc_by_department_and_aging->sum('employees_over_three_years_count') }}</th>
                        <th>{{ $hc_by_department_and_aging->sum('employees_over_three_years_count') }}</th>
                        <th>{{ $hc_by_department_and_aging->sum('employees_over_three_years_count') }}</th>
                        <th>{{ $hc_by_department_and_aging->sum('employees_count') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="box-footer"></div>
    
</div>