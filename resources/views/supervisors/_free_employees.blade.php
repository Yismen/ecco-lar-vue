@if ($free_employees->count() > 0)
    <div class="box box-warning">
        <div class="box-header">
            <h4>
                List of Employees Not Assigned to Any Supervisor
                <span class="badge">{{ $free_employees->count() }}</span>
            </h4>
        </div>
        <div class="box-body">
            <table class="table table-condensed table-hover">
                <tbody>
                    @foreach ($free_employees as $employee)
                        <tr is="employee-row" :employee="{{ $employee }}" />
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

