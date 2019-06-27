@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'Edit Downtime Reason ' . $downtime_reason->name])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h4>
					Details Reason For Downtime {{ $downtime_reason->name }}
					<a href="{{ route('admin.downtime_reasons.index') }}" class="pull-right" title="Return to the List">
						<i class="fa fa-home"></i>
					</a>
				</h4>
			</div>

			<div class="box-body">
				<h4>Under construction. Show Hours Details...</h4>
				{{ $downtime_reason->hours }}
			</div>

		</div>
	</div>

@stop

@section('scripts')

@stop
