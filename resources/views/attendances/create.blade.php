<div class="box-header">
    <h4>Add a new Attendance</h4>
</div>

{!! Form::open(['route'=>['admin.attendances.store'], 'method'=>'POST', 'class'=>'', 'role'=>'form']) !!}
    <div class="box-body">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">     
            <h4>Your Employees: (select one or more)</h4>
            <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : null }}" style="max-height: 300px; overflow-y: overlay;">
                @foreach ($attendance->employeesList as $employee)            
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox('employee_id[]', $employee->id, null, []) !!}
                            {{ $employee->full_name }}
                        </label>
                    </div>            
                @endforeach            
                {!! $errors->first('employee_id', '<span class="text-danger">:message</span>') !!}
            </div>
            
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            @include('attendances._form')
        </div>
    </div>

    <div class="box-footer">
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-1">
                <button class="btn btn-primary"><i class="fa fa-floppy-o"></i> CREATE</button>
            </div>
        </div>
    </div>
{!! Form::close() !!}