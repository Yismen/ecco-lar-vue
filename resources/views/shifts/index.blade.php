@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Shifts', 'page_description'=>'Control shift items'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="panel-title">
                            Shifts
                            <a href="{{ route('admin.shifts.create') }}" class="pull-right">
                                <i class="fa fa-plus"></i>
                                 Add Shift Item
                            </a>
                        </h3>
                    </div>
                    {{-- .box-bheader --}}
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-condensed table-striped" id="shifts-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Start At</th>
                                    <th>End At</th>
                                    <th>Monday</th>
                                    <th>Tuesday</th>
                                    <th>Wednesday</th>
                                    <th>Thursday</th>
                                    <th>Friday</th>
                                    <th>Saturday</th>
                                    <th>Sunday</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    {{-- .box-body --}}
                </div>
                {{-- .box --}}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        (function($){
            $(document).ready(function($) {

                let dTable = $('#shifts-table').DataTable({
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
                        "url": "{{ route('admin.shifts.index') }}",
                    },
                    "order": [[ 0, "asc" ]],
                    "columns": [
                        {data: 'employee', name: 'employee', searchable: "false", render: function(data, type, full){
                            return '<a href="/admin/employees/' + data.id +'" target="_employee">'+ (data.full_name).trim() +'</a>'
                        }},
                        {data: 'slug', name: 'slug', 'visible': false, orderable: false},
                        {data: 'start_at', name: 'start_at'},
                        {data: 'end_at', name: 'end_at'},
                        {data: 'mondays', name: 'mondays'},
                        {data: 'tuesdays', name: 'tuesdays'},
                        {data: 'wednesdays', name: 'wednesdays'},
                        {data: 'thursdays', name: 'thursdays'},
                        {data: 'fridays', name: 'fridays'},
                        {data: 'saturdays', name: 'saturdays'},
                        {data: 'sundays', name: 'sundays'},
                        {data: 'id', name: 'id', searchable: "false", orderable: false, render: function(data, type, full) {
                            return '<a href="/admin/shifts/'+data+'/edit"><i class="fa fa-pencil"></i> Edit</a>'
                        }},
                    ]
                });
            });

        })(jQuery);
    </script>
@endsection
