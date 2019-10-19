@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Downtimes Data', 'page_description'=>'description'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-danger">
                    <div class="box-header">
                        <h4>
                            Create Downtimes <small>D Only</small>
                            <a href="{{ route('admin.performances.index') }}" class="pull-right" title="Back to List">
                                <i class="fa fa-list"></i> List
                            </a>
                        </h4>
                    </div>

                    {!! Form::open(['route'=>['admin.downtimes.store'], 'method'=>'POST', 'class'=>'', 'role'=>'form', 'novalidate'=>true]) !!}
                        <div class="box-body" id="performances-create">
                             @include('downtimes._form')
                        </div>
                        {{-- .box-body --}}
                        <!-- /. Reported By -->
                        <div class="box-footer">
                            <div class="col-sm-offset-2">
                                <button class="btn btn-warning" type="submit">CREATE</button>
                            </div>
                        </div>
                        {{-- .box-footer --}}
                    {!! Form::close() !!}
                </div>
            </div>

            <div class="col-xs-12">  
                <div class="box box-info">
                    <div class="box-header">
                        <h4>Downtimes</h4>
                    </div>

                    <div class="box-body">
                        <table class="table table-condensed table-hover table-bordered" id="downtimes-table">
                            <thead>
                                <tr>
                                    <th>Updated At</th>
                                    <th>Employee</th>
                                    <th>Employee Second First Name</th>
                                    <th>Employee Last Name</th>
                                    <th>Employee Second Last Name</th>
                                    <th>Date</th>
                                    <th>Project / Campaign</th>
                                    <th>Downtime Time</th>
                                    <th>Reason</th>
                                    <th>Reported By</th>
                                    <th>Action</th>
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

                let dTable = $('#downtimes-table').DataTable({
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
                        "url": "{{ route('admin.downtimes.create') }}",
                    },
                    "order": [[ 0, "desc" ]],
                    "columns": [
                        {data: 'updated_at', name: 'updated_at', render: function(data, type, full) {
                            return moment(data).format('Y-M-D')
                        }},
                        {data: 'employee', name: 'employee.first_name', orderable:false, render: function(data, type, full){                           
                            return full.employee.full_name
                        }},
                        {data: 'employee', name: 'employee.second_first_name', orderable:false, visible:false, render: function(data, type, full){                           
                            return data
                        }},
                        {data: 'employee', name: 'employee.last_name', orderable:false, visible:false, render: function(data, type, full){                           
                            return data
                        }},
                        {data: 'employee', name: 'employee.second_last_name', orderable:false, visible:false, render: function(data, type, full){                           
                            return data
                        }},
                        {data: 'date', name: 'date'},
                        {data: 'campaign', name: 'campaign.project.name', orderable:false, render: function(data, type, full) {
                            return full.campaign && full.campaign.project ? 
                                `${full.campaign.project.name} // ${full.campaign.name}` : 
                                null;
                        }},
                        {data: 'login_time', name: 'login_time', searchable: false, render: function(data, type, full) {
                            return Number(data).toFixed(3)
                        }},
                        {data: 'downtime_reason', name: 'downtime_reason.name', orderable: false, searchable:false, render: function(data, type, full) {
                            return data ? data.name : ""
                        }},
                        {data: 'reported_by', name: 'reported_by', orderable: false, render: function(data, type, full) {
                            return data
                        }},
                        {data: 'id', name: 'id', orderable:false, searchable: false, render: function(data, type, full) {
                            return `<a href="/admin/downtimes/${data}/edit" title="Edit" class="btn btn-xs btn-warning">
                                <i class="fa fa-edit"></i> Edit
                            </a>`
                        }}
                        
                    ],
                    // "footerCallback": function(row, data, start, end, display) {
                    // "    $(row).children('th')[1].textContent = getSubTotal(data, 'login_time')
                    // "    $(row).children('th')[2].textContent = getSubTotal(data, 'production_time')
                    // "    $(row).children('th')[3].textContent = getSubTotal(data, 'transactions')
                    // "    $(row).children('th')[4].textContent = '$' + getSubTotal(data, 'revenue')
                    // "}
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
