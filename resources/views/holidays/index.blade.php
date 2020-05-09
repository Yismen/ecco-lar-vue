@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Holidays', 'page_description'=>'List of holidays of
production.'])

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			@include('holidays._create')
		</div>

		<div class="col-md-8">
			@include('holidays._list')
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script>
	(function($){
	        $(document).ready(function($) {

	            let dTable = $('#holidays-table').DataTable({
	                "processing": true,
	                "responsive": true,
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
	                    "url": "{{ route('admin.holidays.index') }}",
	                },
	                "order": [[ 0, "asc" ]],
	                "columns": [
	                    {data: 'date', name: 'date', render: function(data, type, full) {
                            return moment(data).format('Y-MM-DD')
                        }},
                        {data: 'name', name: 'name'},
                        {data: 'description', name: 'description'},
                        {data: 'id', name: 'id', orderable:false, searchable:false, render(data, type, full) {
                            return `
                                <a href="/admin/holidays/${data}/edit" class="btn btn-warning btn-xs">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            `
                        }},
	                ]
	            });
	        });

	    })(jQuery);
</script>
@endpush