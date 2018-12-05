@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Departments', 'page_description'=>'Show details of the department.'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		<div class="box box-primary pad">
			<h4 class="page-header">
				{{ $department->department }}
				<a href="{{ route('admin.departments.edit', $department->id) }}">
					<i class="fa fa-pencil"></i>
				</a>
				<a href="{{ route('admin.departments.index') }}" class="pull-right">
					<i class="fa fa-home"></i> List
				</a>
			</h4>

			@if (!$department->positions->count())

				<div class="alert alert-danger">
					<strong>Alone!</strong> This department has not been given any position yet.
				</div>
			@else
				<h3>Positions</h3>
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>Name</th>
							<th class="col-xs-3">
								<a href="{{ route('admin.positions.create') }}"><i class="fa fa-plus"></i> Add Position</a>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($department->positions as $position)
							<tr>
								<td>
									<a href="{{ route('admin.positions.show', $position->id) }}">{{ $position->name }}</a>
								</td>
								<td>
									<a href="{{ route('admin.positions.edit', $position->id) }}"><i class="fa fa-pencil"></i> Edit</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif

		</div>
	</div>
@endsection