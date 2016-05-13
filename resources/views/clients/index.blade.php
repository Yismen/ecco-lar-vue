@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class=" col-sm-12">
		<div class="well row ">
				<h3 class="page-header">
					Clients Items List
					 (
						 <small>
						 	<a href="{{ route('clients.create') }}">
						 		<i class="fa fa-plus"></i>
						 	</a>
						 </small>
					 )
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
									<a href="{{ route('clients.show', $client->id) }}">{{ strtoupper($client->name) }}</a>
								</td>
								<td>
									{{ $client->goal }}
								</td>
								<td>
									<a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">
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
@stop

@section('scripts')
	
@stop