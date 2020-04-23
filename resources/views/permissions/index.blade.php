@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'No Description'])

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="box box-primary">
					<h4 class="box-header">
						Permissions Items List
						<a href="{{ route('admin.permissions.create') }}" class="pull-right">
							<i class="fa fa-plus"></i>
							New Permission
						</a>
					</h4>
					<div class="box-body table-responsive">
						<table class="table table-condensed table-hover table-striped" id="permissions-table">
							<thead>
								<tr>
									<th>Name</th>
									<th>Resource</th>
									<th>Guard</th>
									<th>Roles</th>
									<th class="col-xs-2">Actions</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>
@stop

@section('scripts')
	
<script>
    (function($){
        $(document).ready(function($) {
            let dTable = $('#permissions-table').DataTable({
                "processing": true,
                "serverSide": true,
                searchDelay: 800,
                // "scrollY": "600px",
                // "scrollCollapse": true,
				"responsive": true,
				"pageLength": 25,
                "lengthMenu": [ [25, 100, 200, -1], [25, 100, 200, "All"] ],
                "searching": { "regex": true },
                "language": {
                    "processing": "<i class='fa fa-spinner'></i> Loading, Please wait!"
                },
                "ajax": {
                    'type': 'get',
                    "url": "{{ route('admin.permissions.index') }}",
                },
                "order": [[ 1, "asc" ], [ 0, "asc" ]],
                "columns": [                   
                    {data: 'name', name: 'name', render: function(data, type, full) {
                        return `<a href="/admin/permissions/${data}" class="" title="">
                            ${data} ${'<i class="fa fa-eye"></i>'}
                        </a>`
                    }},                  
                    {data: 'resource', name: 'resource'},
                    {data: 'guard_name', name: 'guard_name'},
                    {data: 'roles', name: 'roles.name', orderable:false, render: function(data, type, full){
						let string = ''
						data.forEach(element => {
							string += `<label class="bg-green">${element.name_parsed}</label> ` 
						});

						return string
                    }},
                    {data: 'name', name: 'name', orderable:false, render: function(data, type, full) {				
                        return `<a href="/admin/permissions/${data}/edit" class="text-warning">
                            <i class="fa fa-pencil"></i> Edit
                        </a>`
					}}
                ]
            });
        });

    })(jQuery);

</script>
@stop

