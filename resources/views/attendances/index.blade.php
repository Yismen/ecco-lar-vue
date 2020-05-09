@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Attendances', 'page_description'=>'Your Employees\' Attendances.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                
                <div class="box box-primary">
					@include('attendances.create')
                </div>
                
            </div>

			<div class="col-sm-10 col-sm-offset-1">
				<div class="box box-primary">

					<div class="box-header with-border">
						<h4>
							Attendances List
						</h4>
					</div>

					<div class="box-body">
						<table class="table table-condensed table-hover table-bordered" id="attendances-table">
							<thead>
								<tr>
									<th>Date</th>
									<th>Employee</th>
									<th>Employee</th>
									<th>Employee</th>
									<th>Employee</th>
									<th>Code</th>
									<th>Actions</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
	<script>
		(function($){
	        $(document).ready(function($) {

	            let dTable = $('#attendances-table').DataTable({
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
	                    "url": "{{ route('admin.attendances.index') }}",
	                },
	                "order": [[ 0, "desc" ]],
                    "createdRow": function( row, data, dataIndex){
                        $(row).css('background-color', data.attendance_code.color);
                    },
	                "columns": [
	                    {data: 'date', name: 'date', render: function(data, type, full) {
                            return `<a href="/admin/attendances/date/${data}" title="See Attendances by Date">
                                ${data} 
                                <i class="fa fa-eye"></i>
                            </a>`
	                    }},
	                    {data: 'employee', name: 'employee.first_name', orderable:false, render: function(data, type, full){
                            return `<a href="/admin/attendances/employee/${data.id}" title="See Attendances by Employee">
                                ${data.full_name} 
                                <i class="fa fa-eye"></i>
                            </a>`
	                    }},
	                    {data: 'employee', name: 'employee.second_first_name', orderable:false, visible:false, render: function(data, type, full){
                            return data.full_name;
	                    }},
	                    {data: 'employee', name: 'employee.last_name', orderable:false, visible:false,render: function(data, type, full){
                            return data.full_name;
	                    }},
	                    {data: 'employee', name: 'employee.second_last_name', orderable:false, visible:false, render: function(data, type, full){
                            return data.full_name;
	                    }},
	                    {data: 'attendance_code', name: 'attendance_code.name', orderable:false, render: function(data, type, full){
                            return `<a href="/admin/attendances/code/${data.id}" title="See Attendances by Code">
                                ${data.name} 
                                <i class="fa fa-eye"></i>
                            </a>`
	                    }},
	                    {data: 'id', name: 'id', orderable:false, render: function(data, type, full){
                            return `<a href="/admin/attendances/${data}/edit" class="text-warning">
                                <i class="fa fa-edit"></i> Edit    
                            </a>`;
	                    }}
	                ]
	            });
	        });

	    })(jQuery);
	</script>
@endpush
