<div class="col-sm-10 col-sm-offset-1">
    <div class="box box-danger">
        <div class="box-header">
            <h4>
                List of Employees Not Assigned to Any Supervisor
                <span class="badge bg-yellow">{{ $free_employees->count() }}</span>
            </h4>
        </div>
        <div class="box-body">

            <?php $count = $free_employees->count() == 0 ? 0 : ceil($free_employees->count() / 2) ?>

            @foreach ($free_employees->chunk($count) as $chunk)
                <div class="col-sm-6">
                    @foreach ($chunk as $employee)
                         <employee-check-box :employee="{{ $employee }}"
                            >,
                            {{ optional($employee->project)->name }} -
                            {{ optional($employee->position)->name }}
                        </employee-check-box>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
