@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Welcome', 'page_description'=>'Welcome page!'])

@section('content')
    <div class="">

        <div class="jumbotron no-margin bg-{{ $color ?? 'yellow'}}  slanted-right">
            <div class="container-fluid">
                <div class="col-sm-12 text-center">
                    <dainsys-logo default-animation="shake" logo="{{ asset('images/logo.png') }}" :random-animation="true" />

                    <h1 class="my-main-header">Welcome to {{ $app_name }} {{ $user->name ?? '' }}</h1>
                    <p><i class="fa fa-arrow-up"></i> Click top menu icon <i class="fa fa-bars"></i> to see your applications links. </p>
                    @if ($user)
                        <a href="/admin/profiles" class="btn btn-default btn-lg">
                            View your profile! <i class="fa fa-angle-double-right"></i>
                        </a>
                    @else
                        <p>Start using Dainsys</p>
                        <a href="/login" class="btn btn-default btn-lg">
                             <i class="fa fa-user"></i> Please Sing In!
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="jumbotron no-margin text-center">
            <div class="container-fluid">
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
                    {{ $app_name }} allows to monitor performance for users under your groups ?? just for yourself.
                </div>
            </div>
        </div>

        <div class="jumbotron no-margin text-center bg-{{ $color ?? 'yelow' }} disabled color-palette">
            <div class="container-fluid">
                <h1 class="">{{ $app_name }}</h1>
                <p>Process documentation? Collect data? Customize reports? Just ask for it. Get in contact with the System Administrator and together create what you need. Please log in to gain access to Dainsys!</p>
            </div>
        </div>

        <div class="jumbotron no-margin text-center">
            <div class="container-fluid">
                <h1 class="">Roles Based Access</h1>
                @if ($user && $user->roles )
                    <h3 class="">You have the following roles assigned to you. </h3>
                    <p>Access their end points by using the left side menu.</p>
                    @foreach ($user->roles as $role)
                        <h4>
                            <span class="label label-success">{{ personName($role->name) }}</span>
                        </h4>
                    @endforeach
                @else
                    <p>Routes are limited by roles and permissions. Please Log In to gain access. </p>
                @endif
            </div>
        </div>
    </div>
@endsection
