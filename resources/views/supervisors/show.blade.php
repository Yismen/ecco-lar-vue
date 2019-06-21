@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Supervisors', 'page_description'=>'Details'])

@section('content')
	<div class="container-fluid">S
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					<div class="box-header with-boarder">
						Details for Supervisor {{ $supervisor->name }}, has
						<span class="badge badge-primary">{{ $supervisor->employees->count()  }}</span> employees assigned.
						<a href="/admin/supervisors" class="pull-right"><i class="fa fa-list"></i> List</a>
					</div>

					<div class="box-body pad">
						@if ($supervisor->employees->count() > 0)
							<table class="table table-condensed table-bordered">
								<thead>
									<tr>
										<th>Id</th>
										<th>Name</th>
										<th>Department</th>
										<th>Position</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($supervisor->employees as $employee)
										<tr>
											<td>{{ $employee->id }}</td>
											<td><a href="/admin/employees/{{ $employee->id }}" target="_new">{{ $employee->full_name }}</a></td>
											<td>
												<a href="/admin/departments/{{ $employee->position->department->id }}" target="_new">
													{{ $employee->position->department->name }}
												</a>
											</td>
											<td>
												<a href="/admin/positions/{{ $employee->position->id }}" target="_new">{{ $employee->position->name }}</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						@endif
					</div>

					<div class="box-footer"></div>

				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop
