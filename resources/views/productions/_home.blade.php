<div class="com-sm-12 ">
		<h3 class="page-header">
			Productions Items List
			 (
				 	<a href="{{ route('admin.productions.create') }}">
				 		<i class="fa fa-plus"></i>
				 	</a>
			 )
		</h3>
		<ul>
			<li>A form to search</li>
			<li>Use partials from downtimes to search data</li>
			<li><del>The ability to import data</del></li>
			<li><del>There should be module to edit</del></li>
			<li><del>there should be different modules</del>
				<del><ul>
					<li>DEOs</li>
					<li>Supervisors</li>
					<li>Management</li>
				</ul></del>
			</li>

		</ul>
	@if ($productions->isEmpty())
		<div class="bs-callout bs-callout-warning">
			<h1>No Productions has been added yet, please add one</h1>
		</div>
	@else
		<table class="table table-condensed table-hover table-bordered">
			<thead>
				<tr>
					<th>Date</th>
					<th>Employee ID</th>
					<th>Name</th>
					<th>Production Hours</th>
					<th>Records</th>
					<th>TP</th>
					<th>Client</th>
					<th>Source</th>
					{{-- <th>Source</th> --}}
					<th class="col-xs-3">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($productions as $production)
					<tr>
						<td>
							<a href="{{ route('admin.productions.show_date', $production->insert_date) }}">{{ $production->insert_date }}</a>
						</td>
						<td>
							<a href="{{ route('admin.productions.show_employee', $production->employee_id) }}">{{ $production->employee_id }}</a>
						</td>
						<td>
							<a href="{{ route('admin.employees.show', $production->employee_id) }}">{{ $production->employee->fullName }}</a>
						</td>
						<td>{{ $production->production_hours }}</td>
						<td>{{ $production->production }}</td>
						<td>{{ number_format($production->production / $production->production_hours, 2) }}</td>
						<td>{{ $production->client->name }}</td>
						<td>{{ $production->source->name }}</td>
						{{-- <td>{{ $production->source }}</td> --}}
						<td>
							<a href="{{ route('admin.productions.edit', $production->id) }}" class="btn btn-warning">
								<i class="fa fa-edit">	</i> Edit
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th colspan="3" text-align="right">Totals</th>
					<th>{{ $production->sum('production_hours') }}</th>
					<th>{{ $production->sum('production') }}</th>
					<th>{{ number_format($production->sum('production') / $production->sum('production_hours'), 2, ".", ",") }}</th>
					<th></th>
					<th></th>
				</tr>
			</tfoot>
		</table>
		<div class="text-center">
			{{ $productions->render() }}
		</div>
	@endif
</div>