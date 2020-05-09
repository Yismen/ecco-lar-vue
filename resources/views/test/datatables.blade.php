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
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#testing').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": {
                    'type': 'post',
                    "url": '/admin/api/test/datatables',
                },
                "columns": [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' }
                ],
                buttons: ['copy', 'excel', 'pdf']
            } );

        } );
    </script>
@endpush