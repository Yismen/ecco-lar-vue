<div class="box box-danger">
    
    {!! Form::open(['route' => ['admin.import-performance'], 'method'=>'post', 'files' => true]) !!}
        <div class="box-header with-border">
            <h4>Import Performance Files</h4>
        </div>

        <div class="box-body">
            <div class="form-group {{ $errors->has('performance_files') ? 'has-error' : null }}">
                <label for="performance_files">Select Files:</label>
                <input type="file" name="performance_files[]" id="performance_files" multiple value="{{ old('performance_files') }}" class="form-control">
                {!! $errors->first('performance_files', '<span class="text-danger">:message</span>') !!}
                <span class="help-block">File name must start with 'performance_summary'. Otherwise will not be accepted.</span>
            </div>
            {{-- /.Select Files --}}   

            <div class="form-group">
                <button class="btn btn-danger" type="submit"><i class="fa fa-upload"></i> Import</button>
            </div>
        </div>

        
        {!! Form::close() !!}
        
    <div class="box-body">
        
        @include('blackhawk-cs.imports.dates-table', ['route' => '/admin/blackhawk-cs/performance/delete', 'resource' => $statistic->performance_dates])
        
    </div>
    
</div>