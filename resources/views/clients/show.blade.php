@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	@if ($client)
		<div class="container">
			<div class="box box-primary pad">
				<table class="table table-condensed table-hover">
					<tbody>
						<tr>
							<th>Client Name: </th>
							<td>{{ $client->name }}</td>
						</tr>
						{{-- /. Name --}}
						<tr>
							<th>Production Goal: </th>
							<td>{{ $client->goal }}</td>
						</tr>
						{{-- /. Employee --}}

					</tbody>
				</table>
				<a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-warning"> Edit </a>
				<hr>
				<a href="{{ route('admin.clients.index') }}" class=""> << Return to Clients List </a>
			</div>
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@section('scripts')
	
@stop