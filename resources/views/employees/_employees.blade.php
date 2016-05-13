
			<div class="table-responsive">
				<table class="table table-hover table-condensed">
					<thead>
						<tr>
							<th>Employee ID:</th>
							<th>Name:</th>
							<th>Personal ID:</th>
							<th>Cell Phone:</th>
							<th>
								<a href="{{ route('admin.employees.create') }}" class="btn btn-primary">Insert
									<i class="fa fa-plus"></i>
								</a>
							</th>
						</tr>
					</thead>
					<tbody>
						@if ($employees)
							@foreach ($employees as $employee)
								<tr>
									<td>{!! link_to_route('admin.employees.show', $employee->id, $employee->id) !!}</td>
									<td>{!! link_to_route('admin.employees.show', $employee->first_name." ".$employee->last_name, $employee->id ) !!}
										</td>
									<td>{{ $employee->personal_id }}</td>
									<td>{{ $employee->cellphone_number }}</td>
									<td>																
										<a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">
											Edit <i class="fa fa-edit"></i>
										</a>
									</td>
								</tr>
							@endforeach
						@else
							<h3>No Employees saved yet...</h3>
						@endif
					</tbody>
					<tfoot>
						<tr>
							<th colspan="50">{!! $employees->render() !!}</th>
						</tr>
					</tfoot>
				</table>
			</div>	