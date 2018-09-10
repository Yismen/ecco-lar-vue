@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Payrolls Process'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <router-view name="payrolls"></router-view>
            <router-view></router-view>
        </div>
    </div>
@endsection
@section('scripts')
@stop