@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Sites', 'page_description'=>'Details.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-info">
                    <div class="box-header">
                        <h4>
                            {{ $site->name }} Details
                            <a href="{{ route('admin.sites.index') }}" class="pull-right">
                                <i class="fa fa-home"></i> List
                            </a>
                        </h4>
                    </div>
                    <div class="box-body">
                        {{ $site }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@stop