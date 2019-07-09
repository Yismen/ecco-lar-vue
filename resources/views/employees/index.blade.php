@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Employees', 'page_description'=>'List of active employees.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">

                        <div class="col-sm-6">
                            <h3>Employees List</h3>
                        </div>

                        <div class="col-sm-6">
                            <!-- Single button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-file-excel-o"></i> Download Excel <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('admin.employees.export_to_excel', 'actives') }}" class="">
                                            <i class="fa fa-download"></i> Actives
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.employees.export_to_excel', 'inactives') }}" class="">
                                            <i class="fa fa-download"></i> Inactives
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="{{ route('admin.employees.export_to_excel', 'all') }}" class="">
                                            <i class="fa fa-download"></i> All
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="{{ route('admin.employees.create') }}" class="pull-right">
                                <i class="fa fa-plus"></i> Create
                            </a>

                        </div>

                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-condensed table-bordered" id="employees-table">
                                <thead>
                                    <tr>
                                        <th>Employee ID:</th>
                                        <th>Name:</th>
                                        <th>Second First Name:</th>
                                        <th>Last Name:</th>
                                        <th>Second Last Name:</th>
                                        <th>Hire Date</th>
                                        <th>Status</th>
                                        <th>Position:</th>
                                        <th>Personal ID / Passport:</th>
                                        <th>Passport:</th>
                                        <th>Cell Phone:</th>
                                        <th>Other Phone:</th>
                                        <th>Edit:</th>

                                    </tr>
                                </thead>

                            </table>
                        </div>
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

            let dTable = $('#employees-table').DataTable({
                "processing": true,
                "serverSide": true,
                searchDelay: 800,
                // "scrollY": "600px",
                // "scrollCollapse": true,
                "pageLength": 50,
                "lengthMenu": [ [50, 100, 200, -1], [50, 100, 200, "All"] ],
                "searching": { "regex": true },
                "createdRow": function( row, data, dataIndex){
                    if(! data.active){
                        $(row).addClass('danger');
                    }
                },
                "language": {
                    "processing": "<i class='fa fa-spinner'></i> Loading, Please wait!"
                },
                "ajax": {
                    'type': 'get',
                    "url": "{{ route('admin.employees.list') }}",
                },
                "order": [[ 1, "asc" ], [ 2, "asc" ], [ 3, "asc" ], [ 4, "asc" ]],
                "columns": [
                    {data: 'id', name: 'id', render: function(data, type, full) {
                        return '<a href="/admin/employees/'+data+'">'+ data +'</a>'
                    }},
                    {data: 'first_name', name: 'first_name', render: function(data, type, full){
                        return full.full_name.trim();
                    }},
                    {data: 'second_first_name', name: 'second_first_name', 'visible': false},
                    {data: 'last_name', name: 'last_name', 'visible': false},
                    {data: 'second_last_name', name: 'second_last_name', 'visible': false},
                    {data: 'hire_date', name: 'hire_date'},
                    {data: 'status', name: 'status', orderable: false, searchable: false},
                    {data: 'position_id', name: 'position_id', render: function(data, type, full){
                        let position = full.position ? full.position.name : '';
                        let project = full.project ? ', At ' + full.project.name : '';
                        let salary = full.position ? ', $' + full.position.salary : '';

                        return position + project + salary;
                    }},
                    {data: 'personal_id', name: 'personal_id', render: function(data, type, full) {
                        return data ? data : full.passport
                    }},
                    {data: 'passport', name: 'passport', visible: false},
                    {data: 'cellphone_number', name: 'cellphone_number'},
                    {data: 'secondary_phone', name: 'secondary_phone', visible: false},
                    {data: 'edit', name: 'edit', searchable: "false", orderable: false, render: function(data, type, full) {
                        return '<a href="'+data+'"><i class="fa fa-pencil"></i> Edit</a>'
                    }},
                ],
                buttons: ['copy', 'excel', 'pdf']
            });
        });

    })(jQuery);

</script>

@stop
