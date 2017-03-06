@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Welcome', 'page_description'=>'Welcome page!'])

@section('content')
    <div class="container-fluids">
        @if (Auth::check())

            <div class="jumbotron no-margin green-div">
                <div class="container">
                    <div class="col-sm-12 text-center">
                        @include('layouts.partials.logo')
                        <h1 class="my-main-header">Welcome to Dainsys, {{ $user->name }}</h1>
                        <p><i class="fa fa-arrow-up"></i> Use the top menu icon <i class="fa fa-bars"></i> to see your application's links. </p>
                        <a href="/admin/profiles" class="btn btn-default btn-lg">
                            View your profile! <i class="fa fa-angle-double-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        @else

            <div class="jumbotron red-div no-margin">
                <div class="container">
                    @include('layouts.partials.logo')
                    <div class="text-center">                        
                        <h1 class="my-main-header">Welcome to Dainsys App</h1>
                        <p>An app designed for you.</p>
                        <a href="/admin/login" class="btn btn-primary btn-lg"><i class="fa fa-sign-in"></i> Get Started</a>
                    </div>
                </div>
            </div>

        @endif

        <div class="jumbotron no-margin text-center">
            <div class="container">
                <h1 class="">Services</h1>
                
                <div class="col-sm-4">
                    <h3><i class="fa fa-4x fa-database"></i></h3>
                    Our database can help you to keep track of important information, regarding activities developed in you project. 
                </div>
                <div class="col-sm-4">
                    <h3><i class="fa fa-4x fa-file-excel-o"></i></h3>
                    With in this app you can pull reports previously designed and export them as excel files, even send them by email.
                </div>
                <div class="col-sm-4">
                    <h3><i class="fa fa-4x fa-user"></i></h3>
                    Dainsys allows to monitor performance for users under your groups or just for yourself.
                </div>
            </div>
        </div>

        <div class="jumbotron red-div no-margin text-center">
            <div class="container">
                <h1 class="">Dainsys</h1>
                <p>Process documentation? Collect data? Customize reports? Just ask for it. Get in contact with the System Administrator and together create what you need. Please log in to gain access to Dainsys!</p>
            </div>
        </div>

        <div class="jumbotron">
            <div class="container">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto inventore, repudiandae laborum? Natus quis ullam fugiat eius, voluptas sapiente, qui corporis ea? Natus eos laborum sapiente, ducimus eius ut consequuntur!
            </div>
        </div>
    </div>
@endsection
