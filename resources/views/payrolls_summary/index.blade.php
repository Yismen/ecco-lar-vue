
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
							    		<input type="file" class="form-control" multiple="multiple" name="payroll_file[]">
							    		@if ($errors->any())
							    		    @foreach ($errors->all() as $error)
							    		        <span class="text-danger">{{ $error }}</span>
							    		    @endforeach
							    		@endif
							    		<span class="help-block">Please select a file to be uploaded</span>
							    	</div>
					    		</div>
					    	</div>
					    </div>

					    {{-- @include('payrolls_summary._import_errors') --}}
					    @include('layouts.partials.file-import-errors')
					
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
@push('scripts')

@endpush