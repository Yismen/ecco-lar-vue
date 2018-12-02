@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'AFPs Management', 'page_description'=>'Manage AFPs for Human Resources'])

@section('content')
    <div class="container-fluid app">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        AFPs
                        <a href="/admin/afps/create" class="pull-right">
                            <i class="fa fa-plus"></i> Add
                        </a>
                    </div>

                    @include('afps._results')
                </div>
                {{-- /. Box --}}
            </div>
            {{-- /. Column --}}
        </div>
    </div>
@endsection
@section('scripts')
@stop