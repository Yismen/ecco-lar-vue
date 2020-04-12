@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Departments', 'page_description'=>'List of departments available.'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Your roles dont have any dashboards assigned!</h4>
                    <p>
                        <a href="{{ url()->previous() }}" class="btn btn-primary">
                            <i class="fa fa-arrow-left"></i> Go Back!
                        </a>
                    </p>
                    {{-- <p class="mb-0"></p> --}}
                  </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
@stop