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

				@include('human_resources.hc._stats')

			</div>
			{{-- Rotations and Issues --}}
			<div class="col-sm-4">
				<h4>Rotations</h4>
				<div class="row">
					@foreach ($stats['rotations']['this_month'] as $site => $this_month)
						<div class="col-lg-6">
							<rotations-this-month
								:hires="{{ $this_month['hires'] }}"
								:terminations="{{ $this_month['terminations'] }}"
								site="{{ $site }}"
							></rotations-this-month>
						</div>
					@endforeach
					{{-- last month --}}
					@foreach ($stats['rotations']['last_month'] as $site => $last_month)
						<div class="col-lg-6">
							<rotations-last-month
								:hires="{{ $this_month['hires'] }}"
								:terminations="{{ $this_month['terminations'] }}"
								site="{{ $site }}"
								></rotations-last-month>
						</div>
					@endforeach
					{{-- this-year --}}
					@foreach ($stats['rotations']['this_year'] as $site => $this_year)
						<div class="col-lg-6">
							<rotations-this-year
								:hires="{{ $this_year['hires'] }}"
								:terminations="{{ $this_year['terminations'] }}"
								site="{{ $site }}"
								></rotations-this-year>
						</div>
					@endforeach
					{{-- last-year --}}
					@foreach ($stats['rotations']['last_year'] as $site => $last_year)
						<div class="col-lg-6">
							<rotations-last-year
								:hires="{{ $last_year['hires'] }}"
								:terminations="{{ $last_year['terminations'] }}"
								site="{{ $site }}"
								></rotations-last-year>
						</div>
					@endforeach
				</div>
				<div class="row">
					@foreach ($stats['attrition']['monthly'] as $site => $attrition)
						<div class="col-sm-12">
							<monthly-attrition
								:info="{{ collect($attrition) }}"
								site="{{ $site }}"
								></monthly-attrition>
						</div>
					@endforeach

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

