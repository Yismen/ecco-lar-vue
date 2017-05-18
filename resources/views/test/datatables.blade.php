@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Datatables Testing Page', 'page_description'=>'Here we will text datatables functionality.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary pad">
                    <div class="table-responsive">
                        <table class="table table-hover table-condensed table-bordered" id="testing">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Status</th>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#testing').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": '{!! route('test.datatables.data') !!}'
                },
                "columns": [
                    {"data": "first_name"},
                    {"data": "last_name"},
                    {"data": "status"}
                ],
                buttons: ['copy', 'excel', 'pdf']
            } );

        } );
    </script>
@stop