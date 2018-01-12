@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Positions', 'page_description'=>'Positions list!'])

@section('content')
	<div class="container-fluid">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary pad">
			
				<h3 class="page-header">
					Positions Items List 
				 	<a href="{{ route('admin.positions.create') }}">
				 		<i class="fa fa-plus"></i>
				 	</a>
				</h3>

				@if ($positions->isEmpty())
					<div class="bs-callout bs-callout-warning">
						<h1>No Positions has been added yet, please add one</h1>
					</div>
				@else
					<table class="table table-condensed table-striped">
						<thead>
							<tr>
								<th>Position Name</th>
								<th>Department</th>
								<th>Salary</th>
								<th>Payment Type</th>
								<th>Payment Frequency</th>
								<th>								 
									<a href="{{ route('admin.positions.create') }}">
										Add 
								 		<i class="fa fa-plus"></i>
								 	</a>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($positions as $position)
								<tr>
									<td>
										<a href="{{ route('admin.positions.show', $position->id) }}">{{ $position->department->department }} - {{ $position->name }}</a>
									</td>

									<td>
										<a href="{{ route('admin.departments.show', $position->department->id) }}">{{ $position->department->department }}</a>
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
					{!! $positions->render() !!}
				@endif
			</div>
		</div>
	</div>
@stop

@section('scripts')
	
@stop