@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Punches ID', 'page_description'=>'Current Punches ID.'])

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">

					<h3 class="page-header">
						Punches Items List
					 	<a href="{{ route('admin.punches.create') }}">
					 		<i class="fa fa-plus"></i>
					 	</a>
					</h3>

					@if ($punches->isEmpty())
						<div class="bs-callout bs-callout-warning">
							<h1>No Punches has been added yet, please add one</h1>
						</div>
					@else
						<table class="table table-condensed table-hover">
							<thead>
								<tr>
									<th>Punch ID</th>
									<th>Employee</th>
									<th class="col-xs-3">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($punches as $punch)
									<tr>
										<td>
											<a href="{{ route('admin.punches.show', $punch->punch) }}">{{ $punch->punch }}</a>
										</td>
										<td>
											<a href="{{ route('admin.employees.show', $punch->employee->id) }}">{{ $punch->employee->fullName }}</a>
										</td>
										<td>
											<a href="{{ route('admin.punches.edit', $punch->punch) }}" >
												<i class="fa fa-edit">	</i> Edit
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<div class="text-center">
							{{ $punches->render() }}
						</div>
					@endif

				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop