@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Human Resources', 'page_description'=>"Dashboard."])

@section('content')
	<div class="container-fluid">
	
		<div class="col-sm-12">
			<div class="col-sm-8">
				
				<div class="col-sm-6">
					@include('human_resources.partials.birthdays')
					@include('human_resources.partials.todays_birthdays')
					@include('human_resources.partials.issues')
				</div>				
				<div class="col-sm-6">
					@include('human_resources.partials.in_out_monthly')
					@include('human_resources.partials.rr_hh_reports')
				</div>	
				<div class="col-sm-12">
					@include('human_resources.partials.hc_by_department_and_aging')
				</div>			
			</div>

			<div class="col-sm-4">
					@include('human_resources.partials.hc_by_project_by_gender')
					@include('human_resources.partials.hc_by_status')
					@include('human_resources.partials.monthly_attrition')
					@include('human_resources.partials.hc_by_department_positions')
			</div>

		</div>		
	</div>
@stop

@section('scripts')
	<script src="/js/dainsys/app.js"></script>
	<script>
		$(function () {
			setTimeout(function() {
				$('.animated-delayed').addClass('animated rubberBand')
			}, 1000);
		});	
	</script>
@stop

			