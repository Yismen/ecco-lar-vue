<div class="box-header">
    <h4>Add a new Attendance</h4>
</div>

{!! Form::open(['route'=>['admin.attendances.store'], 'method'=>'POST', 'class'=>'', 'role'=>'form']) !!}
    <div class="box-body">
        @include('attendances._form')
    </div>

    <div class="box-footer">
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-1">
                <button class="btn btn-primary"><i class="fa fa-floppy-o"></i> CREATE</button>
            </div>
        </div>
    </div>
{!! Form::close() !!}