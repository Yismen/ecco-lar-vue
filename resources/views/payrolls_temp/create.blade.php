@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Payrolls Temporary', 'page_description'=>'Import temporary data from Excel file.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					<div class="box-header with-border">Import Data</div>

					{!! Form::open(['route'=>['admin.payrolls_temp.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off", 'files' => true]) !!}
					    
					    <div class="box-body">
					    	<div class="col-sm-6">
					    		<div class="form-group {{ $errors->has('from_date') ? 'has-error' : null }}">
					    		    {!! Form::label('from_date', 'Date From:', ['class'=>'control-label']) !!}
					    		    {!! Form::input('date', 'from_date', null, ['class'=>'form-control', 'placeholder'=>'Date From']) !!}
					    		    {!! $errors->first('from_date', '<span class="text-danger">:message</span>') !!}
					    		</div>
					    		<!-- /. Date From -->
					    	</div>

					    	<div class="col-sm-6">
					    		<div class="form-group {{ $errors->has('to_date') ? 'has-error' : null }}">
					    		    {!! Form::label('to_date', 'To Date:', ['class'=>'control-label']) !!}
					    		    {!! Form::input('date', 'to_date', null, ['class'=>'form-control', 'placeholder'=>'To Date']) !!}
					    		    {!! $errors->first('to_date', '<span class="text-danger">:message</span>') !!}
					    		</div>
					    		<!-- /. To Date -->
					    	</div>

					    	<div class="col-sm-12">
					    		<div class="form-group {{ $errors->has('payroll_file') ? 'has-error' : null }}">
								    <label class="col-sm-2 control-label">Payroll File:</label>
							    	<div class="col-sm-10">
							    		<input type="file" name="payroll_file">
							    		<span class="help-block">Please select a file to be uploaded</span>
						    		    {!! $errors->first('payroll_file', '<span class="text-danger">:message</span>') !!}
							    	</div>
					    		</div>
					    	</div>
					    </div>
					
					    <div class="box-footer">
					        <button type="submit" class="btn btn-default">CANCEL</button>
					        <button type="submit" class="btn btn-primary">IMPORT</button>
					    </div>
					
					{!! Form::close() !!}
					
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop