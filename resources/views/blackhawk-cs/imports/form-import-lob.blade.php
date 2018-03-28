<div class="box box-success">
    
    {!! Form::open(['route' => ['admin.import-lob-summary'], 'method'=>'post', 'files' => true]) !!}
        <div class="box-header with-border">
            <h4>Import LOB Files</h4>
        </div>

        <div class="box-body">
            <div class="form-group {{ $errors->has('lob_files') ? 'has-error' : null }}">
                <label for="lob_files">Select Files:</label>
                <input type="file" name="lob_files[]" id="lob_files" multiple value="{{ old('lob_files') }}" class="form-control">
                {!! $errors->first('lob_files', '<span class="text-danger">:message</span>') !!}
                <span class="help-block">File name must start with 'LOB_summary'. Otherwise will not be accepted.</span>
            </div>
            {{-- /.Select Files --}}   

            <div class="form-group">
                <button class="btn btn-success" type="submit"><i class="fa fa-upload"></i> Import</button>
            </div>
        </div>

        
        {!! Form::close() !!}
    
</div>