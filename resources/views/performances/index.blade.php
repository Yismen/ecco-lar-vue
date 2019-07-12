@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Performances', 'page_description'=>'Details.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h4>
                            Performance Data
                            <a href="{{ route('admin.performances.create') }}" class="pull-right">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </h4>
                    </div>

                    <div class="box-body table-responsive">
                        <table class="table table-condensed table-bordered" id="performances-table">
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

                let dTable = $('#performances-table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "searchDelay": 1000,
                    // "scrollY": "600px",
                    // "scrollCollapse": true,
                    "pageLength": 25,
                    "lengthMenu": [ [25, 100, 200], [25, 100, 200] ],
                    "searching": { "regex": true },
                    "language": {
                        "processing": "<i class='fa fa-spinner'></i> Loading, Please wait!"
                    },
                    "ajax": {
                        'type': 'get',
                        "url": "{{ route('admin.performances.index') }}",
                    },
                    "order": [[ 0, "desc" ], [ 1, "asc" ]],
                    "columns": [
                        {data: 'date', name: 'date'},
                        {data: 'name', name: 'name', render: function(data, type, full){
                            return '<a href="/admin/performances/' + full.id +'" title="Performance Details">' + (data).trim() + '</a>'
                        }},
                        {data: 'supervisor_id', name: 'supervisor_id', orderable: false, searchable: false, render: function(data, type, full) {
                            return full.supervisor ? full.supervisor.name : null;
                        }},
                        {data: 'campaign_id', name: 'campaign_id', orderable: false, searchable: false, render: function(data, type, full) {
                            return full.campaign && full.campaign.project ? full.campaign.project.name : null;
                        }},
                        {data: 'campaign', name: 'campaign', orderable: false, searchable: false, render: function(data, type, full) {
                            return full.campaign ? full.campaign.name : null;
                        }},
                        {data: 'login_time', name: 'login_time', searchable: false},
                        {data: 'production_time', name: 'production_time', searchable: false},
                        {data: 'transactions', name: 'transactions', searchable: false},
                        {data: 'revenue', name: 'revenue', searchable: false},
                        {data: 'edit', name: 'edit', searchable: "false", orderable: false, render: function(data, type, full) {
                            return '<a href="'+data+'"><i class="fa fa-pencil"></i> Edit</a>'
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
                    return data.reduce(function(el1, el2) {
                        el1 = el1[field] == undefined ? el1 : el1[field]
                        return Number(el1) + Number(el2[field])
                    })
                }
            });

        })(jQuery);
    </script>
@stop
