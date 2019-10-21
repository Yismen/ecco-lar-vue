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
                            <a href="{{ route('admin.downtimes.create') }}" class="pull-right">
                                <i class="fa fa-plus"></i> Add Downtime
                            </a>
                        </h4>
                    </div>

                    <div class="box-body table-responsive">
                        <table class="table table-condensed table-bordered table-hover" id="performances-table">
                        
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Employee</th>
                                    <th>Employee Second First Name</th>
                                    <th>Employee Last Name</th>
                                    <th>Employee Second Last Name</th>
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
                                    <th colspan="8" style="text-align:right">Total:</th>
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
                    "order": [[ 0, "desc" ]],
                    "columns": [
                        {data: 'date', name: 'date', render: function(data, type, full) {
                            return data
                        }},
                        {data: 'employee', name: 'employee.first_name', orderable:false, render: function(data, type, full){                           
                            return '<a href="/admin/performances/' + full.id +'" title="Performance Details">' + (data.full_name) + '</a>'
                        }},
                        {data: 'employee', name: 'employee.second_first_name', orderable:false, visible:false, render: function(data, type, full){                           
                            return '<a href="/admin/performances/' + full.id +'" title="Performance Details">' + (data.full_name) + '</a>'
                        }},
                        {data: 'employee', name: 'employee.last_name', orderable:false, visible:false, render: function(data, type, full){                           
                            return '<a href="/admin/performances/' + full.id +'" title="Performance Details">' + (data.full_name) + '</a>'
                        }},
                        {data: 'employee', name: 'employee.second_last_name', orderable:false, visible:false, render: function(data, type, full){                           
                            return '<a href="/admin/performances/' + full.id +'" title="Performance Details">' + (data.full_name) + '</a>'
                        }},
                        {data: 'supervisor', name: 'supervisor.name', orderable:false, render: function(data, type, full) {
                            return full.supervisor ? full.supervisor.name : null;
                        }},
                        {data: 'campaign', name: 'campaign.project.name', orderable:false, render: function(data, type, full) {
                            return full.campaign && full.campaign.project ? full.campaign.project.name : null;
                        }},
                        {data: 'campaign', name: 'campaign.name', orderable:false, render: function(data, type, full) {
                            return full.campaign ? full.campaign.name : null;
                        }},
                        {data: 'login_time', name: 'login_time', searchable: false},
                        {data: 'production_time', name: 'production_time', searchable: false},
                        {data: 'transactions', name: 'transactions', searchable: false},
                        {data: 'revenue', name: 'revenue', searchable: false},
                        {data: 'date', name: 'edit', searchable: "false", orderable: false, render: function(data, type, full) {
                            return '<a href="/admin/performances/'+full.id+'/edit"><i class="fa fa-pencil"></i> Edit</a>'
                        }},
                    ],
                    "footerCallback": function(row, data, start, end, display) {
                        $(row).children('th')[1].textContent = getSubTotal(data, 'login_time')
                        $(row).children('th')[2].textContent = getSubTotal(data, 'production_time')
                        $(row).children('th')[3].textContent = getSubTotal(data, 'transactions')
                        $(row).children('th')[4].textContent = '$' + getSubTotal(data, 'revenue')
                    }
                });

                let getSubTotal = function(data, field) {
                    if(data.length == 0) {
                        return 0
                    }

                    var el
                    const result = data.reduce(function(act, obj) {
                        el = obj[field] == undefined ? 0 : obj[field]   
                                       
                        return act + Number(el)
                    }, 0)

                    return result.toFixed(2)
                }
            });

        })(jQuery);
    </script>
@stop
