@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Schedules ID', 'page_description'=>'Current Schedules ID.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8">
				<div class="box box-primary">

					<div class="box-header with-border">
						<h4>
							Schedules Items List
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
									<th>Schedules</th>
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
	                // "order": [[ 0, "asc" ]],
	                "columns": [
	                    // {data: 'employee', name: 'employee', searchable: "false", render: function(data, type, full){
	                    //     let first_name = data.first_name || '';
	                    //     let second_first_name = data.second_first_name || '';
	                    //     let last_name = data.last_name || '';
	                    //     let second_last_name = data.second_last_name  || '';
	                    //     return '<a href="/admin/employees/' + data.id +'" target="_employee">'+ (first_name +' '+second_first_name+' '+last_name+' '+second_last_name).trim() +'</a>'
	                    // }},
	                    {data: 'first_name', name: 'first_name', render: function(data, type, full){
	                        return full.full_name.trim();
	                    }},
	                    {data: 'schedules', name: 'schedules', searchable: "false", orderable: false, render: function(data, type, full) {
	                    	var links = ''

	                    	full.schedules.forEach(function(value, index) {
	                    		return links = links +

                    			'<a href="/admin/schedules/'+value.id+'/edit" class="btn btn-info btn-xs" style="margin-right: 10px;">' +
	                    			value.day.toUpperCase() + ', ' + value.hours + ' Hours' +
	                    			' <i class="fa fa-pencil"></i>' +
                    			'</a>'
	                    	})
	                        return links
	                    }},
	                ],
	                buttons: ['copy', 'excel', 'pdf']
	            });
	        });

	    })(jQuery);
	</script>
@stop
