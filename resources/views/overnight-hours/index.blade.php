@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Overnight Hours', 'page_description'=>'List of overnight hours of
production.'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            @include('overnight-hours._import')
            @include('overnight-hours._create')
        </div>

        <div class="col-md-8">
            @include('overnight-hours._list')
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function($){
	        $(document).ready(function($) {

	            let dTable = $('#overnight-hours-table').DataTable({
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
	                    "url": "{{ route('admin.overnight_hours.index') }}",
	                },
	                "order": [[ 0, "desc" ]],
	                "columns": [
                        {data: 'updated_at', name: 'updated_at', visible: false, searchable: false},
	                    {data: 'date', name: 'date', render: function(data, type, full) {
                            return moment(data).format('Y-MM-DD')
                        }},
                        {data: 'employee', name: 'employee.first_name', orderable:false, render(data, type, full) {
                            return data.full_name
                        }},
                        {data: 'hours', name: 'hours', render(data, type, full) {
                            return Number(data).toFixed(3)
                        }},
                        {data: 'id', name: 'id', render(data, type, full) {
                            return `
                                <a href="/admin/overnight_hours/${data}/edit" class="btn btn-warning btn-xs">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            `
                        }},
	                ],
	                buttons: ['copy', 'excel', 'pdf']
	            });
	        });

	    })(jQuery);
</script>
@endpush