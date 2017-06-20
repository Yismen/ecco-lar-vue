@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Human Resources', 'page_description'=>"Dashboard."])

@section('content')
	<div class="container-fluid">
	
		<div class="col-sm-12 animated">
				
			<div class="col-sm-4 fadeIn">
				@include('human_resources.partials.rr_hh_reports')
				@include('human_resources.partials.issues')
			</div>

			<div class="col-sm-4 fadeIn">
				@include('human_resources.partials.birthdays')
				@include('human_resources.partials.todays_birthdays')
				@include('human_resources.partials.in_out_monthly')
				@include('human_resources.partials.hc_by_project_by_gender')
			</div>

			<div class="col-sm-4 fadeIn">
				@include('human_resources.partials.hc_by_status')
				@include('human_resources.partials.monthly_attrition')
				@include('human_resources.partials.hc_by_department_positions')
			</div>

		</div>		
	</div>
@stop

@section('scripts')
	<script src="/js/dainsys/app.js"></script>
@stop

			