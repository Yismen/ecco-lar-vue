@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Punches ID', 'page_description'=>'Current Punches ID.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8">
				<div class="box box-primary">

					<div class="box-header with-border">
						<h4>
							Punches Items List
						 	<a href="{{ route('admin.punches.create') }}" class="pull-right">
						 		<i class="fa fa-plus"></i> Add
						 	</a>
						</h4>
					</div>

					<div class="box-body">
						<table class="table table-condensed table-hover" id="punches-table">
							<thead>
								<tr>
									<th>Punch ID</th>
									<th>Employee</th>
									<th>Slug</th>
									<th class="col-xs-3">Actions</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>


			<div class="col-sm-4">
				<div class="box box-danger">

					<div class="box-header with-border">
						<h4>
							List of Employees Missing Punch ID
						 	<a href="{{ route('admin.punches.create') }}" class="pull-right">
						 		<i class="fa fa-plus"></i> Add
						 	</a>
						</h4>
					</div>

					<div class="box-body">
						<table class="table table-condensed table-hover">
							<thead>
								<tr>
									<th>Employee</th>
									<th class="col-xs-3">Actions</th>
								</tr>
							</thead>

							<tbody>
								@foreach ($employees_missing_punch as $employee)
									<tr>
										<td>
											<a href="{{ route('admin.employees.show', $employee->id) }}" target="_employee">{{ $employee->full_name }}</a>
										</td>
										<td>
											<a href="{{ route('admin.employees.edit', $employee->id) }}" target="_employee">
												<i class="fa fa-pencil"></i> Edit
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>

					<div class="box-footer">
						{{ $employees_missing_punch->render() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	<script>
		(function($){
	        $(document).ready(function($) {

	            let dTable = $('#punches-table').DataTable({
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
	                    "url": "{{ route('admin.punches.index') }}",
	                },
	                "order": [[ 1, "asc" ]],
	                "columns": [

	                    // {data: 'punch', name: 'punch'},
	                    {data: 'punch', name: 'punch', render: function(data, type, full) {
	                        return '<a href="/admin/punches/'+data+'">'+ data +'</a>'
	                    }},
	                    {data: 'employee', name: 'employee', searchable: "false", render: function(data, type, full){
	                    	console.log(full)
	                        let first_name = data.first_name || '';
	                        let second_first_name = data.second_first_name || '';
	                        let last_name = data.last_name || '';
	                        let second_last_name = data.second_last_name  || '';
	                        return '<a href="/admin/employees/' + data.id +'" target="_employee">'+ (first_name +' '+second_first_name+' '+last_name+' '+second_last_name).trim() +'</a>'
	                    }},
	                    {data: 'slug', name: 'slug', 'visible': false, orderable: false},
	                    {data: 'punch', name: 'punch', searchable: "false", orderable: false, render: function(data, type, full) {
	                        return '<a href="/admin/punches/'+data+'/edit"><i class="fa fa-pencil"></i> Edit</a>'
	                    }},
	                ],
	                buttons: ['copy', 'excel', 'pdf']
	            });
	        });

	    })(jQuery);
	</script>
@stop
