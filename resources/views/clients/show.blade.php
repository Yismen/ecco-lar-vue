@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'Showing Client '.$client->name.'\'s details'])

@section('content')
	@if ($client)
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary">
				<div class="box-body">
					<table class="table table-condensed">
						<tbody>
							<tr>
								<th>Client Name: </th>
								<td>{{ $client->name }}</td>
							</tr>
							{{-- /. Name --}}
							<tr>
								<th>Departments: </th>
								<th>Sources: </th>
							</tr>
							<tr>
								<td>
									<ul>
										@foreach ($client->departments as $department)
											<li>{{ $department->name }}</li>
										@endforeach
									</ul>
								</td>
								<td>
									<ul>
										@foreach ($client->sources as $source)
											<li>{{ $source->name }}</li>
										@endforeach
									</ul>
								</td>
							</tr>
							{{-- /. Employee --}}

						</tbody>
					</table>
					<a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit </a>
					<hr>
					<a href="{{ route('admin.clients.index') }}" class=""><i class="fa fa-home"></i> Return to Clients List </a>
				</div>
			</div>
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@section('scripts')

@stop