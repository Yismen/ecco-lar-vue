@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'Showing Client '.$client->name.'\'s details'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h4>
					Client - {{ $client->name }}
					<a href="{{ route('admin.clients.index') }}" class="pull-right" title="Back to Clients List">
						<i class="fa fa-home"></i>
					</a>
				</h4>
			</div>
			<div class="box-body">
				<table class="table">
					<tbody>
						<tr>
							<th class="text-right">Contact Person</th>
							<td class="text left">{{ $client->contact_name }}</td>
						</tr>
						<tr>
							<th class="text-right">Email</th>
							<td class="text left">{{ $client->email }}</td>
						</tr>
						<tr>
							<th class="text-right">Phones</th>
							<td class="text left">{{ $client->main_phone }} / {{ $client->secondary_phone }}</td>
						</tr>
						<tr>
							<th class="text-right">Account Number</th>
							<td class="text left">{{ $client->account_number }}</td>
						</tr>
						<tr>
							<th class="text-right">Projects</th>
							<td class="text left">
                                <ul class="list-group">
									@foreach ($client->projects as $project)
									<li class="list-group-item">
										{{ $project->name }}
										<span class="badge bg-info" title="Employees">{{ $project->employees()->count() }}</span>
									</li>
									@endforeach
                                </ul>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div> 
@stop

@push('scripts')

@endpush