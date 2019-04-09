@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Import Perforces Data', 'page_description'=>'description'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="box box-primary">

                    <div class="box-body">
                        @include('layouts.partials.errors')

                        @include('performances._import-form')
                    </div>

                </div>

                @include('performances._imported-dates')
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop
