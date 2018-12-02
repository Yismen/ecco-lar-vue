@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'ARS Management', 'page_description'=>'Manage ARSs for Human Resources'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        ARS List
                        <a href="{{ route('admin.arss.create') }}" class="pull-right">
                            <i class="fa fa-plus"></i> Add
                        </a>
                    </div>

                    @include('arss._results')
                </div>
                {{-- /. Box --}}
            </div>
            {{-- /. Column --}}
        </div>
    </div>
@endsection
@section('scripts')

@stop