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
					<div class="table-responsive">
						<table class="table table-condensed table-striped" id="positions-table">
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
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@push('scripts')
<script>
	(function($){
		$(document).ready(function($) {

			let dTable = $('#positions-table').DataTable({
				"processing": true,
				"serverSide": true,
				"searchDelay": 1000,
				// "scrollY": "600px",
				// "scrollCollapse": true,
				"pageLength": 25,
				"lengthMenu": [ [25, 100, 200, -1], [25, 100, 200, "All"] ],
				"searching": { "regex": true },
				"language": {
					"processing": "<i class='fa fa-spinner'></i> Loading, Please wait!"
				},
				"ajax": {
					'type': 'get',
					"url": "{{ route('admin.positions.index') }}",
				},
				"order": [[ 0, "asc" ]],
				"columns": [
					{data: 'name', name: 'name', render: function(data, type, full) {
						return `<a href="/admin/positions/${full.id}" title="Details">
							${data} 
							<i class="fa fa-eye"></i>
						</a>`
					}},					
					{data: 'name', name: 'name',searchable: false, orderable:false, render: function(data, type, full) {
						let cClass = full.employees_count > 0 ? "green" : "gray"
						return `<a 
								href="/admin/positions/${full.id}" title="Employees"
								class="label bg-${cClass}"
							>
							${full.employees_count} 
						</a>`
					}},					
					{data: 'department', name: 'department.name', orderable:false, render: function(data, type, full) {
						return `<a 
								href="/admin/departments/${data.id}" title="Employees"
								target="_departments"
							>
							${data.name} 
						</a>`
					}},
					{data:'salary', name: 'salary', render: function(data, type, full) {
						return `$ ${Number(Number(data).toFixed(2)).toLocaleString()}`
					}},					
					{data: 'payment_type', name: 'payment_type.name', orderable:false, render: function(data, type, full) {
						return data.name
					}},					
					{data: 'payment_frequency', name: 'payment_frequency.name', orderable:false, render: function(data, type, full) {
						return data.name
					}},
					{data: 'id', name: 'id', render: function(data, type, full) {
						return `<a href="/admin/positions/${full.id}/edit" title="Edit" class="text-warning">
							<i class="fa fa-edit"></i> Edit
						</a>`
					}}
				]
			});
		});

	})(jQuery);
</script>
@endpush
