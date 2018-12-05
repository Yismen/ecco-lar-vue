@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Positions', 'page_description'=>'Positions list!'])

@section('content')
<div class="container-fluid">
		<div class="col-lg-10 col-lg-offset-1">
			<div class="box box-primary">

				<div class="box-header with-border">
					<h3 class="box-title">
						Positions List
					</h3>
				 	<a href="{{ route('admin.positions.create') }}" class="pull-right">
				 		<i class="fa fa-plus"></i> Add
				 	</a>
				</div>

				<div class="box-body">
					@if ($positions->isEmpty())
						<div class="bs-callout bs-callout-warning">
							<h1>No Positions has been added yet, please add one</h1>
						</div>
					@else
						<div class="table-responsive">
							<table class="table table-condensed table-striped">
								<thead>
									<tr>
										<th>Position Name</th>
										<th>Employees</th>
										<th>Department</th>
										<th>Salary</th>
										<th>Payment Type</th>
										<th>Payment Frequency</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($positions as $position)
										<tr>
											<td>
												<a href="{{ route('admin.positions.show', $position->id) }}">
													{{ $position->department->department ?? '' }} - {{ $position->name }}
												</a>
											</td>

											<td>
												<span class="label {{ $position->employees_count > 0 ? 'bg-green' : 'bg-grey'}}">
													{{ $position->employees_count }}
												</span>
											</td>

											<td>
												@if ($position->department)
													<a href="{{ route('admin.departments.show', $position->department->id) }}">{{ $position->department->department ?? '' }}</a>
												@endif
											</td>
											<td>$ {{ number_format($position->salary, 2) }}</td>
											<td>{{ $position->payment_type ? $position->payment_type->name : '' }}</td>
											<td>{{ $position->payment_frequency ? $position->payment_frequency->name : '' }}</td>
											<td class="text-warning">
												<a href="{{ route('admin.positions.edit', $position->id) }}" rel="tooltip" title="Edit" data-placement="left" class="text-warning">
													<i class="fa fa-pencil"></i> Edit
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@endif
				</div>
				{{-- .box-body --}}
				@if ($positions->total() >= $positions->perPage())
					<div class="box-footer">
						{!! $positions !!}
					</div>
				@endif
			</div>
		</div>
	</div>
@stop

@section('scripts')
@stop