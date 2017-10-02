@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Payrolls Temporary', 'page_description'=>'Import temporary data from Excel file.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					<div class="box-header with-border">Import Data</div>

					{!! Form::open(['route'=>['admin.payrolls_summary.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off", 'files' => true]) !!}
					    
					    <div class="box-body">

					    	<div class="col-sm-12">
					    		<div class="form-group {{ $errors->has('payroll_file') ? 'has-error' : null }}">
								    <label class="col-sm-2 control-label">Payroll File:</label>
							    	<div class="col-sm-10">
							    		<input type="file" class="form-control" name="payroll_file">
						    		    {!! $errors->first('payroll_file', '<span class="text-danger">:message</span>') !!}
						    		    {!! $errors->first('file_name', '<span class="text-danger">:message</span>') !!}
							    		<span class="help-block">Please select a file to be uploaded</span>
							    	</div>
					    		</div>
					    	</div>
					    </div>

					    @include('payrolls_summary._import_errors')
					
					    <div class="box-footer">
					        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> IMPORT</button>
					        <button type="reset" class="btn btn-default">CANCEL</button>
					    </div>
					
					{!! Form::close() !!}
					
				</div>

				@include('payrolls_summary._dashboard')
				
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop