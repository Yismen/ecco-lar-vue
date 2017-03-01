@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Escalations Clients', 'page_description'=>'List of Current Escalations Clients'])

@section('content')
	<div class="container">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary pad">
				<h3 class="page-header">
					Escalations Clients List
						 	<a href="{{ route('admin.escalations_clients.create') }}" class="pull-right btn btn-primary">
						 		<i class="fa fa-plus"></i> Create
						 	</a>
				</h3>

				@if (count($escalclients) > 0)
					<table class="table table-condensed table-hover">
						<thead>
							<tr>
								<th>Payment Name</th>
								<th class="col-xs-3">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($escalclients as $escalclient)
								<tr>
									<td>
										<a href="{{ route('admin.escalations_clients.show', $escalclient->slug) }}">{{ $escalclient->name }}</a>
									</td>
									<td>
										<a href="{{ route('admin.escalations_clients.edit', $escalclient->slug) }}" class="" rel="tooltip" title="Edit" data-placement="left">
											Edit <i class="fa fa-edit"></i>
										</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{!! $escalclients->render() !!}
				@else
					<div class="bs-callout bs-callout-warning">
						<h1>No Escalations Clients has been added yet, please add one</h1>
					</div>
				@endif
			</div>
		</div>
	</div>
@stop

@section('scripts')
	
@stop