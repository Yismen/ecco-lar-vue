<div class="col-sm-10 col-sm-offset-1">
    <div class="box box-danger">
        <div class="box-header">
            <h4>
                List of Employees Not Assigned to Any Supervisor
                <span class="badge bg-yellow">{{ $free_employees->count() }}</span>
            </h4>
        </div>
        <div class="box-body">
            <table class="table table-condensed table-hover">
                <tbody>
                    @foreach ($free_employees as $employee)
                        <tr class="col-sm-6">
                            <td>
                                <employee-check-box :employee="{{ $employee }}"
                                >,
                                    {{ optional($employee->position)->name }}
                                </employee-check-box>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
