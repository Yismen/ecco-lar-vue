@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Logins', 'page_description'=>'List of login_names for all the users.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h4>
                            <div class="col-xs-8">
                                Logins Items List
                            </div>
                            <div class="col-xs-4">
                                <a href="{{ route('admin.login_names.create') }}" class="">
                                    <i class="fa fa-plus"></i> Create
                                </a>

                                <div role="presentation" class="dropdown pull-right">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-download"></i>
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="li">
                                            <a href="{{ route('admin.login_names.to-excel.all-employees') }}">
                                                <i class="fa fa-file-excel-o"></i> All Employees
                                            </a>
                                        </li>
                                        <li class="li">
                                            <a href="{{ route('admin.login_names.to-excel.all') }}">
                                                <i class="fa fa-file-excel-o"></i> All Login Names
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                {{-- ./ Download button --}}
                            </div>
                        </h4>
                    </div>

                    <div class="box-body">
                        <table class="table table-condensed table-hover" id="login-names-table">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Login</th>
                                    <th>Slug</th>
                                    <th class="col-xs-2">Actions</th>
                                </tr>
                            </thead>

                        </table>
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

                let dTable = $('#login-names-table').DataTable({
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
                        "url": "{{ route('admin.login_names.index') }}",
                    },
                    "order": [[ 1, "asc" ]],
                    "columns": [
                        {data: 'employee', name: 'employee', searchable: "false", render: function(data, type, full){
                            return '<a href="/admin/employees/' + data.id +'" target="_employee">'+ (data.full_name).trim() +'</a>'
                        }},
                        {data: 'login', name: 'login', render: function(data, type, full) {
                            return '<a href="/admin/login_names/'+full.id+'">'+ data +'</a>'
                        }},
                        {data: 'slug', name: 'slug', 'visible': false, orderable: false},
                        {data: 'id', name: 'id', searchable: "false", orderable: false, render: function(data, type, full) {
                            return '<a href="/admin/login_names/'+data+'/edit"><i class="fa fa-pencil"></i> Edit</a>'
                        }},
                    ]
                });
            });

        })(jQuery);
    </script>
@stop
