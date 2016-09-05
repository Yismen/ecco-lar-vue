@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Passwords', 'page_description'=>'Manage user passwords'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary pad">
                    <div class="row" id="passwords">
                        <div class="col-sm-12">
                            <router-view></router-view>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ elixir('js/passwords.js') }}"></script>
@stop