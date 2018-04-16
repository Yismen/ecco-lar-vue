<div class="box box-warning">
    
    {!! Form::open(['route' => ['admin.import-qa-errors'], 'method'=>'post', 'files' => true]) !!}
        <div class="box-header with-border">
            <h4>Import QA Errors Files</h4>
        </div>

        <div class="box-body">
            <div class="form-group {{ $errors->has('qa_errors_files') ? 'has-error' : null }}">
                <label for="qa_errors_files">Select Files:</label>
                <input type="file" name="qa_errors_files[]" id="qa_errors_files" multiple value="{{ old('qa_errors_files') }}" class="form-control">
                {!! $errors->first('qa_errors_files', '<span class="text-danger">:message</span>') !!}
                <span class="help-block">File name must start with 'qa_errors'. Otherwise will not be accepted.</span>
            </div>
            {{-- /.Select Files --}}   

            <div class="form-group">
                <button class="btn btn-warning" type="submit"><i class="fa fa-upload"></i> Import</button>
            </div>
        </div>

        
        {!! Form::close() !!}
        
    <div class="box-body">
        
        @include('blackhawk-cs.imports.dates-table', ['route' => '/admin/blackhawk-cs/qa_errors/delete', 'resource' => $statistic->qa_error_dates])
        
    </div>
    
</div>