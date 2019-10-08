@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Performances', 'page_description'=>'Details.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h4>
                            Details for date {{ $date }}
                            <a href="{{ route('admin.performances_import.index') }}" class="pull-right">
                                <i class="fa fa-home"></i> List
                            </a>
                        </h4>
                    </div>

                    <div class="box-body table-responsive">
                        <table class="table table-condensed table-bordered" id="performances_import-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Employee</th>
                                    <th>Supervisor</th>
                                    <th>Project</th>
                                    <th>Campaign</th>
                                    <th>Login Time</th>
                                    <th>Prod. Time</th>
                                    <th>Sales</th>
                                    <th>Revenue</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th colspan="5" style="text-align:right">Total:</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
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

                let dTable = $('#performances_import-table').DataTable({
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
                        "url": "{{ route('admin.performances_import.by_date', $date) }}",
                    },
                    "order": [[ 1, "asc" ]],
                    "columns": [
                        {data: 'date', name: 'date', searchable: false, orderable: false},
                        {data: 'name', name: 'name', render: function(data, type, full){
                            return '<a href="/admin/performances/' + full.id +'" title="Performance Details" target="_performances">' + (data).trim() + '</a>'
                        }},
                        {data: 'supervisor_id', name: 'supervisor_id', orderable: false, searchable: false, render: function(data, type, full) {
                            return full.supervisor ? full.supervisor.name : null;
                        }},
                        {data: 'campaign', name: 'campaign.project.name', orderable: false, render: function(data, type, full) {
                            return full.campaign && full.campaign.project ? full.campaign.project.name : null;
                        }},
                        {data: 'campaign', name: 'campaign.name', orderable: false, render: function(data, type, full) {
                            return full.campaign ? full.campaign.name : null;
                        }},
                        {data: 'login_time', name: 'login_time', searchable: false},
                        {data: 'production_time', name: 'production_time', searchable: false},
                        {data: 'transactions', name: 'transactions', searchable: false},
                        {data: 'revenue', name: 'revenue', searchable: false},
                        {data: 'edit', name: 'edit', searchable: "false", orderable: false, render: function(data, type, full) {
                            return '<a href="'+data+'" target="_performances"><i class="fa fa-pencil"></i> Edit</a>'
                        }},
                    ],
                    "footerCallback": function(row, data, start, end, display) {
                        $(row).children('th')[1].textContent = Number(getSubTotal(data, 'login_time')).toFixed(2)
                        $(row).children('th')[2].textContent = Number(getSubTotal(data, 'production_time')).toFixed(2)
                        $(row).children('th')[3].textContent = Number(getSubTotal(data, 'transactions')).toFixed(2)
                        $(row).children('th')[4].textContent = '$' + Number(getSubTotal(data, 'revenue')).toFixed(2)
                    }
                });

                let getSubTotal = function(data, field) {
                    if(data.length == 0) {
                        return 0
                    }

                    return data.reduce(function(el1, el2) {
                        el1 = el1[field] == undefined ? el1 : el1[field]
                        return Number(el1) + Number(el2[field])
                    })
                }
            });

        })(jQuery);
    </script>
@stop
