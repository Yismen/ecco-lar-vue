@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Escalations Records', 'page_description'=>'List of Current Escalations Records'])

@section('content')
	<div class="container">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary pad">
				<h3 class="page-header">
					Escalations Records List
						 	<a href="{{ route('admin.escalations_records.create') }}" class="pull-right btn btn-primary">
						 		<i class="fa fa-plus"></i> Create
						 	</a>
				</h3>

				@if (count($escalations_records) > 0)
					<table class="table table-condensed table-hover">
						<thead>
							<tr>
								<th>Tracking Number</th>
								<th>Client</th>
								<th class="col-xs-3">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($escalations_records as $escalations_record)
								<tr>
									<td>
										<a href="{{ route('admin.escalations_records.show', $escalations_record->tracking) }}">{{ $escalations_record->tracking }}</a>
									</td>
									<td>
										{{ $escalations_record->escal_client->name }}
									</td>
									<td>
										<a href="{{ route('admin.escalations_records.edit', $escalations_record->tracking) }}" class="" rel="tooltip" title="Edit" data-placement="left">
											Edit <i class="fa fa-edit"></i>
										</a>
									</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								{!! $escalations_records->render() !!}
							</tr>
						</tfoot>
								adfasf asdf{!! $escalations_records->render() !!}

						
					</table>
				@else
					<div class="bs-callout bs-callout-warning">
						<h1>No Escalations Records has been added yet, please add one</h1>
					</div>
				@endif
			</div>
		</div>
	</div>
@stop

@section('scripts')
	
@stop