
@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Welcome', 'page_description'=>'Welcome page!'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary pad">
                    <div class="panel panel-default">
                        <div class="panel-heading">Welcome</div>

                        <div class="panel-body">
                            Your Application's Landing Page.
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection