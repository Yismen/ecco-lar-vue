
@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Welcome', 'page_description'=>'Welcome page!'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-primary pad">
                    <mymenu></mymenu>
                         Remember to update the Menu component to satisfy the
                         vue-router component

                    <router-view class="animated" transition="faderight" transition-mode="out-in"></router-view>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ elixir('js/main.js') }}"></script>
@stop