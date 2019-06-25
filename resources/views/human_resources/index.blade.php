@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Human Resources', 'page_description'=>"Dashboard."])

@section('content')
	<div class="container-fluid">

		<div class="row">
			{{-- / Birthdays --}}
			<div class="col-sm-4">
				<h4>Birthdays</h4>
				@include('human_resources.birthdays.list_today')
				<div class="row">
					<div class="col-md-6">
						@include('human_resources.birthdays.count_this_month')
					</div>
					<div class="col-md-6">
						@include('human_resources.birthdays.count_next_month')
					</div>
					<div class="col-md-6">
						@include('human_resources.birthdays.count_last_month')
					</div>
				</div>
				<hr>
				<h4>Missing Infos</h4>

				@include('human_resources._issues-table')
			</div>
			{{-- / Head Counts --}}
			<div class="col-sm-4">
				<h4>Head Counts</h4>
				<div class="row">
					<div class="col-lg-6">
						<headcount-by-status
							:info="{{ collect($stats['headcounts']['by_status']) }}"
							></headcount-by-status>
					</div>
					<div class="col-lg-6">
						<headcount-by-gender
							:info="{{ $stats['headcounts']['by_gender'] }}"
							></headcount-by-gender>
					</div>
					<div class="col-lg-6">
						<headcount-by-site
							:info="{{ $stats['headcounts']['by_site'] }}"
							></headcount-by-site>
					</div>
					<div class="col-lg-6">
						<headcount-by-department
							:info="{{ $stats['headcounts']['by_department'] }}"
							></headcount-by-department>
					</div>
					<div class="col-lg-6">
						<headcount-by-project
							:info="{{ $stats['headcounts']['by_project'] }}"
							></headcount-by-project>
					</div>
					<div class="col-lg-6">
						<headcount-by-supervisor
							:info="{{ $stats['headcounts']['by_supervisor'] }}"
							></headcount-by-supervisor>
					</div>
					<div class="col-lg-6">
						<headcount-by-position
							:info="{{ $stats['headcounts']['by_position'] }}"
							></headcount-by-position>
					</div>
					<div class="col-lg-6">
						<headcount-by-nationality
							:info="{{ $stats['headcounts']['by_nationality'] }}"
							></headcount-by-nationality>
					</div>
				</div>

			</div>
			{{-- Rotations and Issues --}}
			<div class="col-sm-4">
				<h4>Rotations</h4>
				<div class="row">
					<div class="col-lg-6">
						<rotations-this-month
							:info="{{ collect($stats['rotations']['this_month']) }}"
							></rotations-this-month>
					</div>
					<div class="col-lg-6">
						<rotations-last-month
							:info="{{ collect($stats['rotations']['last_month']) }}"
							></rotations-last-month>
					</div>
					<div class="col-lg-6">
						<rotations-this-year
							:info="{{ collect($stats['rotations']['this_year']) }}"
							></rotations-this-year>
					</div>
					<div class="col-lg-6">
						<rotations-last-year
							:info="{{ collect($stats['rotations']['last_year']) }}"
							></rotations-last-year>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<monthly-attrition
							:info="{{ collect($stats['attrition']['monthly']) }}"
							></monthly-attrition>
					</div>
				</div>

			</div>
		</div>
	</div>
@stop

@section('scripts')
	<script>
		$(function () {
			setTimeout(function() {
				$('.animated-delayed').addClass('animated rubberBand')
			}, 1000);
		});
	</script>
@stop

