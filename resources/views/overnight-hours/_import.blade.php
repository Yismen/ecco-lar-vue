<div class="box box-primary">

    <div class="box-header">
        <h4>Import Overnight Hours From Excel</h4>
    </div>

    <div class="box-body">
        {!! Form::open(['route'=>['admin.import_overnight_hours.store'], 'method'=>'POST', 'class'=>'form-horizontal',
        'role'=>'form', 'files' => true])
        !!}

        {{-- <form action="" enctype="multipart/form-data"></form> --}}
        <!-- Selet Excel File -->
        <div class="col-sm-12">
            <div class="form-group {{ $errors->has('_file_') ? 'has-error' : null }}">
                {!! Form::label('_file_', 'Selet Excel File:', ['class'=>'col-xs-4 col-md-12']) !!}
                <div class="col-xs-8 col-md-12">
                    {!! Form::file('_file_', ['class'=>'form-control', 'placeholder'=>'Selet Excel
                    File']) !!}
                    {!! $errors->first('_file_', '<span class="text-danger">:message</span>') !!}
                </div>
                <span class="col-xs-offset-4 col-md-offset-0 help-block">Excel files only!</span>
            </div>
        </div>
        <!-- /. Selet Excel File -->

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>

    <div class="box-footer">
        @component('components.errors-div')

        @endcomponent
    </div>



</div>