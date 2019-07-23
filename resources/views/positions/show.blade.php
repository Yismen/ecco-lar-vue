@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Positions', 'page_description'=>$position->name.'\'s details'])

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h4>
							{{ $position->name }}
							<a href="{{ route('admin.positions.index') }}" class="pull-right">
								<i class="fa fa-home"></i> List
							</a>
						</h4>
					</div>
					{{-- ./ Box header --}}
					<div class="box-body">
						<div class="dl-horizontal">
							<dt>Name:</dt>
							<dd>{{ $position->name }}</dd>
							<dt>Department:</dt>
							<dd>{{ $position->department->name }}</dd>
							<dt>Payment Type:</dt>
							<dd>{{ $position->payment_type ? $position->payment_type->name : 'Please Add One!' }}</dd>
							<dt>Payment Frequency:</dt>
							<dd>{{ $position->payment_frequency ? $position->payment_frequency->name : 'Please Add One!' }}</dd>
							<dt>Salary:</dt>
							<dd>RD$ {{ number_format($position->salary, 2) }}</dd>
						</div>
					</div>
					{{-- .box-body --}}
					<div class="box-footer">
						<a href="{{ route('admin.positions.edit', $position->id) }}" class="btn btn-warning">
							<i class="fa fa-edit"></i> Edit
						</a>
					</div>
				</div>
				{{-- .box --}}
				@if ($position->employees->count() > 0)
					<div class="box box-info">
						<div class="box-header with-border">
							<h4>Employees for this Position</h4>
						</div>
						{{-- /.box-header --}}
						<div class="box-body">
							<div class="table-responsive">
								<table class="table table-condensed table-bordered">
									<thead>
										<tr>
											<th>Site</th>
											<th>Project</th>
											<th>Name</th>
											<th>Supervisor</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($position->employees as $employee)
											<tr>
												<td>
													<a href="{{ route('admin.sites.index') }}" target="_employee">{{ optional($employee->site)->name }}</a>
												</td>

												<td>
													<a href="{{ route('admin.projects.index') }}" target="_employee">{{ optional($employee->project)->name }}</a>
												</td>

												<td>
													<a href="{{ route('admin.employees.show', $employee->id) }}" target="_employee">{{ $employee->full_name }}</a>
												</td>

												<td>
													<a href="{{ route('admin.supervisors.index') }}" target="_employee">{{ optional($employee->supervisor)->name }}</a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				@endif
			</div>
			{{-- .column --}}
		</div>
		{{-- /. Row --}}
	</div>
	{{-- .container --}}
@stop

@section('scripts')

@stop
