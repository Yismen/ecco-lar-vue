 {{--  {!! Form::open(['route'=>['admin.performances_import.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'files' => true ]) !!}

    <div class="box-header">
        <h4>Import Perforces Data</h4>
    </div>

    <div class="col-sm-12">
        <div class="form-group {{ $errors->has('excel_file') ? 'has-error' : null }}">
            {!! Form::label('excel_file', 'File Name:', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::file('excel_file[]', null, ['class'=>'form-control', 'placeholder'=>'File Name', 'multiple' => 'multiple']) !!}
                {!! $errors->first('excel_file', '<span class="text-danger">:message</span>') !!}
                {!! $errors->first('excel_file.*', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">SUBMIT</button>
        <button type="reset" class="btn btn-default">CANCEL</button>
    </div>

{!! Form::close() !!}  --}}

<dropzone-form url="{{ route('admin.performances_import.store') }}"></dropzone-form>
