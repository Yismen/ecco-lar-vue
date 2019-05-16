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
                @foreach($free_employees as $employee)
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="{{ $employee->id }}" name="employee[]">
                                    {{ $employee->full_name }}
                                </label>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
