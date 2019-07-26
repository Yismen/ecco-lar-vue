@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Schedules ID', 'page_description'=>'Current Schedules ID.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8">
				<div class="box box-primary">

					<div class="box-header with-border">
						<h4>
							Schedules Items List, Based on
							<a href="{{ route('admin.shifts.index') }}" target="_shifts">
								Shifts <i class="fa fa-angle-double-right"></i>
							</a>
						 	<a href="{{ route('admin.schedules.create') }}" class="pull-right">
						 		<i class="fa fa-plus"></i> Add
						 	</a>
						</h4>
					</div>

					<div class="box-body table-responsive">
						<table class="table table-condensed table-hover" id="schedules-table">
							<thead>
								<tr>
									<th>Employee</th>
									<th>Slug</th>
									<th>Date</th>
									<th>Hours</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>


			<div class="col-sm-4">
				@include('schedules._missing_schedules')
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	<script>
		(function($){
	        $(document).ready(function($) {

	            let dTable = $('#schedules-table').DataTable({
	                "processing": true,
	                "serverSide": true,
	                "searchDelay": 1000,
				    responsive: true,
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
	                    "url": "{{ route('admin.schedules.index') }}",
	                },
	                "order": [[ 1, "asc" ], [2, "asc"]],
	                "columns": [
	                    {data: 'employee', name: 'employee', searchable: false, render: function(data, type, full){
	                        return data.full_name.trim();
	                    }},
	                    {data: 'slug', name: 'slug', 'visible': false, orderable: false},
	                    {data: 'date', name: 'date', render: function(data, type, full){
	                    	date = moment(data.date)
	                        return date.format("M/D/Y") + ', ' + date.format('dddd');
	                    }},
	                    {data: 'hours', name: 'hours', render: function(data, type, full){
	                        return Number(data).toFixed(2);
	                    }},
	                    {data: 'id', name: 'id', orderable: false, render: function(data, type, full){
	                        return '<a href="/admin/schedules/' + data + '/edit" class="text-warning"><i class="fa fa-pencil"></i> Edit</a>';
	                    }}
	                ]
	            });
	        });

	    })(jQuery);
	</script>
@stop
