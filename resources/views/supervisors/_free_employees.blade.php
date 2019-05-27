@if ($free_employees->count() > 0)
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
                        <tr is="employee-row" :employee="{{ $employee }}"  class="col-md-4 col-sm-6"/>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

