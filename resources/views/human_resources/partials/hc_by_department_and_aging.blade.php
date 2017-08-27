<div class="box box-primary danger-bg">
    <div class="box-header with-border"><h3>Total Employees by Proyect - Positions</h3></div>


    <div class="box-body">

        <table class="table table-condensed table-bordered">
            <thead>
                <tr>
                    <th>Department</th>
                    <th>< 3 Months</th>
                    <th>> 3 < 6 Months</th>
                    <th>> 6 < 9 Months</th>
                    <th>> 9 Months < 1 Year</th>
                    <th>> 1 < 3 Year</th>
                    <th>> 3 Year</th>
                    <th>Total</th>
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
                    <th>{{ $hc_by_department_and_aging->sum('employees_count') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="box-footer"></div>
    
</div>