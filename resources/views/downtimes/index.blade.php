
@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class=" col-sm-8 col-sm-offset-2">
		<div class="well row ">
			<h3 class="page-header">
				Down Time Reports
			</h3>
			@include('downtimes.partials.dashboard')
		
		</div>
		@unless ($downtimes)
			<h3>No downtimes added!</h3>
		@else
			@foreach ($downtimes as $downtime)
				<div class="well row">
					<i class="fa fa-user"> </i>
					<a href="{{ route('admin.employees.show', $downtime->employee->id) }}">{{ $downtime->employee->fullName }}</a>		
					, <i class="fa fa-calendar"> </i> {{ $downtime->insert_date }}
					<br><br>
					From: <i class="fa fa-calendar"> </i> {{ $downtime->from_time }}
					To: <i class="fa fa-calendar"> </i> {{ $downtime->to_time }}
					<br><br>
					<a href="{{ route('downtimes.show', $downtime->id) }}"><i class="fa fa-eye"></i></a>
					{{ number_format($downtime->from_time - $downtime->to_time - ($downtime->break_time/60), 2) }} Hours, {{ $downtime->reason->reason }},
					<a href="{{ route('downtimes.edit', $downtime->id) }}"><i class="fa fa-pencil"> </i></a>
				</div>
			@endforeach
		@endunless
	</div>
@stop

@section('scripts')
	
	
@stop