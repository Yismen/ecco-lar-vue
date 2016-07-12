<!-- Initiate the variable List at 0. This will be auto incremented in the table -->
<?php $list = 0 ?>
<div class="table-responsive">
	<table class="table table-hover table-condensed" id="employees-table">
		<thead>
			<tr>
				<!-- <th>#:</th> -->
				<th>Employee ID:</th>
				<th>First Name:</th>
				<th>Last Name:</th>
				<th>Hire Date:</th>
				<th>Position:</th>
				<th>Personal ID:</th>
				<th>Cell Phone:</th>
				<th>
					<a href="{{ route('admin.employees.create') }}" class="">Insert
						<i class="fa fa-plus"></i>
					</a>
				</th>
			</tr>
		</thead>
		<tbody>
			@if ($employees)
				@foreach ($employees as $employee)
					<tr class="{{ $employee->status == 'Inactive' ? 'warning' : ''}}">
						{{-- <td>{{  ++$list }}</td> --}}
						<td>{!! link_to_route('admin.employees.show', $employee->id, $employee->id) !!}</td>
						{{-- <td>{!! link_to_route('admin.employees.show', $employee->first_name." ".$employee->last_name, $employee->id ) !!}
							</td> --}}
						<td>{{ $employee->first_name }}</td>
						<td>{{ $employee->last_name }}</td>
						<td>{{ $employee->hire_date }}</td>
						<td>{{ $employee->positions->name }}</td>
						<td>{{ $employee->personal_id }}</td>
						<td>{{ $employee->cellphone_number }}</td>
						<td>																
							<a href="{{ route('admin.employees.edit', $employee->id) }}" class="">
								Edit <i class="fa fa-edit"></i>
							</a>
						</td>
					</tr>
				@endforeach
			@else
				<h3>No Employees saved yet...</h3>
			@endif
		</tbody>
		{{-- <tfoot>
			<tr>
				<th colspan="50">{!! $employees->render() !!}</th>
			</tr>
		</tfoot> --}}
	</table>
</div>	