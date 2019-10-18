@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Import Perforces Data', 'page_description'=>'description'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-body">
                        @include('performances_import._import-form')
                        @include('layouts.partials.errors')
                    </div>

                    @if (Session::has('imported_files'))
                        <div class="box-footer">
                            <ul>
                                @foreach (session()->get('imported_files') as $file)
                                    <li>{{ $file }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="box-header">
                            <h4>Imported Dates</h4>
                            <span id="ready"></span>
                        </div>

                        <div class="box-body table-responsive">
                            <table class="table table-condensed table-bordered table-hover" id="performances-table">
                                <thead>
                                    <tr>
                                        <th>Performance Date</th>
                                        <th>File Name</th>
                                        <th>Project</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
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
            document.getElementById('ready').innerHTML = `<delete-request-button
                            url="/admin/performances_import/mass_delete?date=asdfad&
                            file_name=2015157"
                            btn-class="btn btn-link no-padding text-red"
                            redirect-url="/admin/performances_import"
                            ></delete-request-button>`
            let dTable = $('#performances-table').DataTable({
                "processing": true,
                "serverSide": true,
                searchDelay: 800,
                // "scrollY": "600px",
                // "scrollCollapse": true,
                "pageLength": 25,
                "lengthMenu": [ [25, 100, 200, 500], [25, 100, 200, 500] ],
                "language": {
                    "processing": "<i class='fa fa-spinner'></i> Loading, Please wait!"
                },
                "ajax": {
                    'type': 'get',
                    "url": "{{ route('admin.performances_import.index') }}",
                },
                "order": [[ 0, "asc" ]],
                "columns": [
                    {data: 'date', name: 'date', render: function(data, type, full) {
                        return `<a href="/admin/performances_import/by_date/${full.date}"
                                    title="SHOW ONLY DATA FOR THIS DATE">
                                    ${full.date}
                                </a>`
                    }},
                    {data: 'file_name', name: 'file_name'},                    
                    {data: 'campaign.project', name: 'campaign.project.name', orderable: false, render: function(data, type, full) {
                        // console.table(data,full)
                        return data.name
                    }},
                    {data: 'created_at', name: 'created_at', render: function(data, type, full) {
                        return String(moment(data).fromNow()).toLocaleUpperCase()
                    }},
                    {data: 'id', name: 'id', searchable: "false", orderable: false, render: function(data, type, full) {
                        return `<a 
                                href="/admin/performances_import/mass_delete?date=${full.date}&file_name=${full.file_name}" 
                                class="btn btn-link no-padding text-red"\
                            >Delete</a>`
                    }},
                ]
            });
        });

    })(jQuery);

</script>
@stop
