@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Import Perforces Data', 'page_description'=>'description'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h4>Create</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop
