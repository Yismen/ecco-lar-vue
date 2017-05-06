@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Employees', 'page_description'=>'List of active employees.'])

@section('content')
    
    <navigation-view></navigation-view>
    
    <div class="container">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="row">
            </div>
            <div class="box box-primary pad">
                <router-view></router-view>
                <router-view name="home"></router-view>
                <router-view name="escalations"></router-view>
            </div>
        </div>
    </div>
@endsection



@section('scripts')   
    <script src="/js/dainsys/app.js"></script> 
@stop