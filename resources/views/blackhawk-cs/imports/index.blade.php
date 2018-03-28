@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Imports Dashboard'])

@section('content')
    <div class="container-fluid">
        <div class="row animated fadeInUp import-forms">
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                @include('blackhawk-cs.imports.form-import-qa')
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                @include('blackhawk-cs.imports.form-import-qa-errors')
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                @include('blackhawk-cs.imports.form-import-lob')
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                @include('blackhawk-cs.imports.form-import-performance')
            </div>
        </div>

        <div class="row animated fadeInRight">
            @include('blackhawk-cs.imports.results')
        </div>
    </div>
@endsection
@section('scripts')

@stop