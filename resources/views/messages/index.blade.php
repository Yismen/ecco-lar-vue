@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Messages'])

@section('content')
    <div class="container-fluid">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>Your Messages</h4>
                </div>

                <div class="box-body">
                    <div class="col-sm-12">
                        <div class="sd">
                            <div class="col-xs-2">Image</div>
                            <div class="col-xs-8">Message</div>
                            <div class="col-xs-2">Buttons</div>
                        </div>
                    </div>
                </div>

                <div class="box-footer"></div>
                
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop