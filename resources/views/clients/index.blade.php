@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'Clients'])

@section('content')
	<div class="container-fluid">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary">
				<div class="box-header">
					<h4>Clients</h4>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-condensed table-bordered">
							<thead>
								<tr>
									<th>Name</th>
									<th>Phone</th>
									<th>Email</th>
									<th><a href="{{ route('admin.clients.create') }}"><i class="fa fa-plus"></i> Add</a></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($clients as $client)
									<tr>
										<td>
											<a href="{{ route('admin.clients.show', $client->id) }}">{{ $client->name }}</a>
										</td>
										<td>{{ $client->main_phone }}</td>
										<td>{{ $client->email }}</td>
										<td>
											<a href="{{ route('admin.clients.edit', $client->id) }}"><i class="fa fa-pencil"></i> Edit</a>
										</td>

									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
@stop

@push('scripts')

@endpush