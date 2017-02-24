@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Welcome', 'page_description'=>'Welcome page!'])

@section('content')
    <div class="container-fluids">
        @if (Auth::check())
            <div class="jumbotron no-margin grey-div">
                <div class="container">
                        <div class="col-sm-12 text-center">
                            <h1 class="my-main-header">Welcome to Dainsys, {{ $user->name }}</h1>
                            <p><i class="fa fa-arrow-up"></i> Please use the top menu icon to see your app's end points. </p>
                            <a href="/admin/profiles" class="btn btn-default btn-lg">
                                View your profile! <i class="fa fa-angle-double-right"></i>
                            </a>
                            {{-- <div class="col-sm-4 text-center">
                                <img src="{{ asset(Auth::user()->profile->photo) }}" class="img-responsive img-circle" alt="Image">
                            </div>
                            <div class="col-sm-6">
                                @if ($user->roles->count() > 0)
                                    <ul class="list-group">
                                        <li class="list-group-item active">
                                            <h4>You have been given the following roles:</h4>
                                        </li>
                                         @foreach ($user->roles as $role)
                                            <li class="list-group-item">{{ $role->display_name }}</li>
                                         @endforeach
                                    </ul>
                                @else
                                    No roles
                                @endif
                            </div> --}}
                        </div>

                </div>
            </div>
        @else

            <div class="jumbotron no-margin">
                <div class="container">
                    <div class="text-center">
                        <h1 class="my-main-header">Welcome to Dainsys App</h1>
                        <p>An app designed for you.</p>
                    </div>
                    
                   
                </div>
            </div>
            <div class="jumbotron no-margin yellow-div text-center">
                <div class="container">
                    <h1 class="">Dainsys</h1>
                    <p>Process documentation? Collect data? Customize reports? Just ask for it. Get in contact with the System Administrator and together create what you need. Please log in to gain access to Dainsys!</p>
                    <a href="/admin/login" class="btn btn-primary btn-lg">
                        <i class="fa fa-sign-in"></i>
                         Login to the App
                    </a>
                    <a href="/admin/register" class="btn btn-info btn-lg">
                        <i class="fa fa-user-plus"></i>
                         Register
                    </a>
                </div>
            </div>
        @endif


        <div class="jumbotron no-margin green-div text-center">
            <div class="container">
                <h1 class="">Our Services</h1>
                
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
    
         
    </div>
@endsection
