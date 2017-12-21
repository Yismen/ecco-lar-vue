@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'No Description'])

@section('content')
	<div class="container-fluid">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary pad">
				<h3 class="page-header">
					Payments Frequency List
				 	<a href="{{ route('admin.payment_frequencies.create') }}" class="pull-right btn btn-primary">
				 		<i class="fa fa-plus"></i> Create
				 	</a>
				</h3>

				@if ($payment_frequencies->isEmpty())
					<div class="bs-callout bs-callout-warning">
						<h1>No Payments has been added yet, please add one</h1>
					</div>
				@else
					<table class="table table-condensed table-hover">
						<thead>
							<tr>
								<th>Payment Name</th>
								<th class="col-xs-3">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($payment_frequencies as $payment_frequency)
								<tr>
									<td>
										<a href="{{ route('admin.payment_frequencies.show', $payment_frequency->id) }}">{{ $payment_frequency->name }}</a>
									</td>
									<td>
										<a href="{{ route('admin.payment_frequencies.edit', $payment_frequency->id) }}" class="" rel="tooltip" title="Edit" data-placement="left">
											Edit <i class="fa fa-edit"></i>
										</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{!! $payment_frequencies->render() !!}
				@endif
			</div>
		</div>
	</div>
@stop

@section('scripts')
	
@stop