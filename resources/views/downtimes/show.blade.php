@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	{{-- {{ $downtime }} --}}
	@if ($downtime->count() > 0)
		<div class="col-sm-8 col-sm-offset-2 well row">
			<i class="fa fa-user"> </i>
			<a href="{{ route('admin.employees.show', $downtime->employee->id) }}">{{ $downtime->employee->fullName }}</a>		
			, <i class="fa fa-calendar"> </i> {{ $downtime->insert_date }}
				<br><br>
				From: <i class="fa fa-calendar"> </i>{{ $downtime->from_time }}
				To: <i class="fa fa-calendar"> </i>{{ $downtime->to_time }}
				<br><br>
				{{-- {{ number_format( $downtime->to_time->diffInHours($downtime->from_time) - ($downtime->break_time/60), 2) }} --}}
				{{ number_format($downtime->from_time - $downtime->to_time - ($downtime->break_time/60), 2) }} Hours, {{ $downtime->reason->reason }},
				<a href="{{ route('admin.downtimes.edit', $downtime->id) }}"><i class="fa fa-pencil"> </i></a>
			<hr>
			<a href="{{ route('admin.downtimes.index') }}" class=""> << Return to Downtimes List </a>
			
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@section('scripts')
	
@stop