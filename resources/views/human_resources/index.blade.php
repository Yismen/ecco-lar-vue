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
						<div class="row">
				            <div class="col-sm-12">
				                <div class="box box-primary">
				                    <div class="box-body">
				                        <headcount-by-status
											:info="{{ collect($stats['headcounts']['by_status']) }}"
										></headcount-by-status>
				                    </div>
				                    {{-- <div class="box-footer">
				                        <a href="#" title="View Details by Status"
				                        target="_employees_">
				                            <i class="fa fa-eye"></i> Details
				                        </a>
				                    </div> --}}
				                </div>
				            </div>
				        </div>
					</div>
					{{-- .by-status --}}
					<div class="col-lg-6">
						<div class="row">
				            <div class="col-sm-12">
				                <div class="box box-primary">
				                    <div class="box-body">
				                        <headcount-by-gender
											:info="{{ $stats['headcounts']['by_gender'] }}"
										></headcount-by-gender>
				                    </div>
				                    {{-- <div class="box-footer">
				                        <a href="/admin/human_resources/head_count/by_gender" title="View Details by Gender"
				                        target="_employees_">
				                            <i class="fa fa-eye"></i> Details
				                        </a>
				                    </div> --}}
				                </div>
				            </div>
				        </div>
					</div>
					{{-- .by-gender --}}
					<div class="col-lg-6">
				        <div class="row">
				            <div class="col-sm-12">
				                <div class="box box-primary">
				                    <div class="box-body">
				                        <headcount-by-site
											:info="{{ $stats['headcounts']['by_site'] }}"
										></headcount-by-site>
				                    </div>
				                    <div class="box-footer">
				                        <a href="/admin/sites" title="View Details by Site"
				                        target="_employees_">
				                            <i class="fa fa-eye"></i> Details
				                        </a>
				                    </div>
				                </div>
				            </div>
				        </div>
					</div>
					{{-- /.by-site --}}
					<div class="col-lg-6">
						<div class="row">
				            <div class="col-sm-12">
				                <div class="box box-primary">
				                    <div class="box-body">
				                        <headcount-by-department
											:info="{{ $stats['headcounts']['by_department'] }}"
										></headcount-by-department>
				                    </div>
				                    <div class="box-footer">
				                        <a href="/admin/departments" title="View Details by Departments"
				                        target="_employees_">
				                            <i class="fa fa-eye"></i> Details
				                        </a>
				                    </div>
				                </div>
				            </div>
				        </div>
					</div>
					{{-- .by-department --}}
					<div class="col-lg-6">
				        <div class="row">
				            <div class="col-sm-12">
				                <div class="box box-primary">
				                    <div class="box-body">
				                        <headcount-by-project
											:info="{{ $stats['headcounts']['by_project'] }}"
										></headcount-by-project>
				                    </div>
				                    <div class="box-footer">
				                        <a href="/admin/projects" title="View Details by Project"
				                        target="_employees_">
				                            <i class="fa fa-eye"></i> Details
				                        </a>
				                    </div>
				                </div>
				            </div>
				        </div>
					</div>
					{{-- .by-project --}}
					<div class="col-lg-6">
				        <div class="row">
				            <div class="col-sm-12">
				                <div class="box box-primary">
				                    <div class="box-body">
				                        <headcount-by-supervisor
											:info="{{ $stats['headcounts']['by_supervisor'] }}"
										></headcount-by-supervisor>
				                    </div>
				                    <div class="box-footer">
				                        <a href="/admin/supervisors" title="View Details by Supervisor"
				                        target="_employees_">
				                            <i class="fa fa-eye"></i> Details
				                        </a>
				                    </div>
				                </div>
				            </div>
				        </div>
					</div>
					{{-- .by-supervisors --}}
					<div class="col-lg-6">
						 <div class="row">
				            <div class="col-sm-12">
				                <div class="box box-primary">
				                    <div class="box-body">
				                        <headcount-by-position
											:info="{{ $stats['headcounts']['by_position'] }}"
										></headcount-by-position>
				                    </div>
				                    <div class="box-footer">
				                        <a href="/admin/positions" title="View Details by Position"
				                        target="_employees_">
				                            <i class="fa fa-eye"></i> Details
				                        </a>
				                    </div>
				                </div>
				            </div>
				        </div>
					</div>
					{{-- .by-positions --}}
					<div class="col-lg-6">
						<div class="row">
				            <div class="col-sm-12">
				                <div class="box box-primary">
				                    <div class="box-body">
				                        <headcount-by-nationality
											:info="{{ $stats['headcounts']['by_nationality'] }}"
										></headcount-by-nationality>
				                    </div>
				                    <div class="box-footer">
				                        <a href="/admin/nationalities" title="View Details by Nationality"
				                        target="_employees_">
				                            <i class="fa fa-eye"></i> Details
				                        </a>
				                    </div>
				                </div>
				            </div>
				        </div>
					</div>
					{{-- .by-nationality --}}
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

