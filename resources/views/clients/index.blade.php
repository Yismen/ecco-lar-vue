@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'Clients'])

@section('content')
	<div class="container-fluid">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-purple">
				
				<div class="table-responsive">
					<table class="table table-condensed table-bordered">
						<thead>
							<tr>
								<th>Client</th>
								<th>Department</th>
								<th>Source</th>
								<th><a href="{{ route('admin.clients.create') }}"><i class="fa fa-plus"></i> Add</a></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($clients as $client)
								<tr>
									<td><a href="{{ route('admin.clients.show', $client->id) }}">{{ $client->name }}</a></td>
									<td>
										<ul>
											@foreach ($client->departments as $department)
												<li> {{ $department->department }} </li>		
											@endforeach
										</ul>
									</td>
									<td>
										<ul>
											@foreach ($client->sources as $source)
												<li> {{ $source->name }} </li>		
											@endforeach
										</ul>
									</td>
									<td>
										<a href="{{ route('admin.clients.edit', $client->id) }}"><i class="fa fa-pencil"></i> Edit</a>
									</td>

								</tr>
							@endforeach
						</tbody>
					</table>
					{{ $clients->render() }}
				</div>
				
			</div>
		</div>
	</div>
@stop

@section('scripts')
	
@stop