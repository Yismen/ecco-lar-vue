@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'No Description'])

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
						<h3 class="page-header">
							Clients Items List 
							<a href="{{ route('admin.clients.create') }}" class="pull-right">
						 		<i class="fa fa-plus"></i>
						 	</a>
						</h3>
					@if ($clients->isEmpty())
						<div class="bs-callout bs-callout-warning">
							<h1>No Clients has been added yet, please add one</h1>
						</div>
					@else
						<table class="table table-condensed table-hover">
							<thead>
								<tr>
									<th>Client Name</th>
									<th>Goal</th>
									<th class="col-xs-3">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($clients as $client)
									<tr>
										<td>
											<a href="{{ route('admin.clients.show', $client->id) }}">{{ strtoupper($client->name) }}</a>
										</td>
										<td>
											{{ $client->goal }}
										</td>
										<td>
											<a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-warning">
												<i class="fa fa-edit">	</i> Edit
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<div class="text-center">
							{{ $clients->render() }}
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
	
@stop