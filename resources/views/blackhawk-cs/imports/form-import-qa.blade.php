<div class="box box-primary">
    
    {!! Form::open(['route' => ['admin.import-qa'], 'method'=>'post', 'files' => true]) !!}
        <div class="box-header with-border">
            <h4>Import QA Files</h4>
        </div>

        <div class="box-body">
            <div class="form-group {{ $errors->has('qa_files') ? 'has-error' : null }}">
                <label for="qa_files">Select Files:</label>
                <input type="file" name="qa_files[]" id="qa_files" multiple value="{{ old('qa_files') }}" class="form-control">
                {!! $errors->first('qa_files', '<span class="text-danger">:message</span>') !!}                
                <span class="help-block">File name must start with 'qa_summary'. Otherwise will not be accepted.</span>
            </div>
            {{-- /.Select Files --}}   

            <div class="form-group">
                <button class="btn btn-primary" type="submit"><i class="fa fa-upload"></i> Import</button>
            </div>
        </div>
        
    {!! Form::close() !!}   
    
    
</div>