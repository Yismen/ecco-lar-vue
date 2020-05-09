@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Campaigns', 'page_description'=>'List of campaigns of production.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4>
                            Campaigns List
                            <a href="{{ route('admin.campaigns.create') }}" class="pull-right">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </h4>
                    </div>
                    {{-- .box-header --}}
                    <div class="box-body">
                        <table class="table table-condensed table-hover" id="campaigns-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Project</th>
                                    <th>Source</th>
                                    <th>Revenue Type</th>
                                    <th>Revenue Rate</th>
                                    <th>SPH Goal</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                   </div>
                   {{-- .box-body --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (function($){
        $(document).ready(function($) {

            let dTable = $('#campaigns-table').DataTable({
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
                    "url": "{{ route('admin.campaigns.index') }}",
                },
                "order": [[ 0, "asc" ]],
                "columns": [
                    {data: 'name', name: 'name'},
                    {data: 'project', name: 'project.name', orderable:false, render: function(data, index, full) {
                        return data.name;
                    }},
                    {data: 'source', name: 'source.name', orderable:false, render: function(data, index, full) {
                        return data.name;
                    }},
                    {data: 'revenue_type', name: 'revenueType.name', orderable:false, render: function(data, index, full) {
                        return data.name;
                    }},
                    {data: 'revenue_rate', name: 'revenue_rate'},   
                    {data: 'sph_goal', name: 'sph_goal'},  
                    {data: 'id', name: 'id', orderable: false, searchable: false, render: function(data, index, full) {
                        return `<a href="/admin/campaigns/${data}/edit" class="btn-warning btn-sm">
                            <i class="fa fa-edit"></i> Edit    
                        </a>`
                    }},                    
                ],
            });
        });

    })(jQuery);
</script>
@endpush
