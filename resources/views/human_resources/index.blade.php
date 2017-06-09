@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Human Resources', 'page_description'=>"Dashboard."])

@section('content')
	<div class="container-fluid">
		<div class="col-sm-4">
			<div class="box box-primary danger-bg">
				<div class="box-header with-border"><h4>Total Employees</h4></div>
		
				<div class="box-body">
					
				</div>
		
				<div class="box-footer"></div>
				
			</div>
		</div>
		
	</div>
@stop

@section('scripts')
	<script src="/js/dainsys/app.js"></script>
@stop

			