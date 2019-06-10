@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Welcome', 'page_description'=>'Welcome page!'])

@section('content')
    <div class="">

        <div class="jumbotron no-margin bg-{{ $color ?? 'yellow'}}  slanted-right">
            <div class="container-fluid">
                <div class="col-sm-12 text-center">
                    <dainsys-logo default-animation="shake" logo="{{ asset('images/logo.png') }}" :random-animation="true"></dainsys-logo>

                    <h1 class="my-main-header">Welcome to {{ $app_name }} {{ $user->name ?? '' }}</h1>
                    <p><i class="fa fa-arrow-up"></i> Click top menu icon <i class="fa fa-bars"></i> to see your applications links. </p>
                    @if ($user)
                        <a href="/admin/profiles" class="btn btn-default btn-lg">
                            View your profile! <i class="fa fa-angle-double-right"></i>
                        </a>
                    @else
                        <p>Start using Dainsys</p>
                        <a href="/login" class="btn btn-default btn-lg">
                             <i class="fa fa-user"></i> Get Started!
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="jumbotron no-margin text-center">
            <div class="container-fluid">
                <h1 class="">Features</h1>
                {{ $app_name }} is full of amazing features to help you manage your business. Admin users can control who access the app, limit routes with permissions, limit access to certain areas based on roles.

                <div class="col-sm-4">
                    <h3><i class="fa fa-4x fa-users"></i></h3>
                    {{ $app_name }} allow you to keep track of your employees, their data, historical data. With this awesome app you can download reports, view dashboards, track your business at a glance. With {{ $app_name }} you can automate tasks such as reporting, payroll, invoicing. So easy.
                </div>
                <div class="col-sm-4">
                    <h3><i class="fa fa-4x fa-line-chart"></i></h3>
                    How are you responding to your clients' needs? How is the business performing? Areas of strength? Oportunities for Improvements? All at the distance of a click.
                </div>
                <div class="col-sm-4">
                    <h3><i class="fa fa-4x fa-lock"></i></h3>
                    With {{ $app_name }} you control who see what. Our Authentication and Authorization methods ensures your crew have only the information they need to act uppon and take decisions. Your information protected!
                </div>
            </div>
        </div>

        <div class="jumbotron no-margin text-center bg-{{ $color ?? 'yelow' }} disabled color-palette">
            <div class="container-fluid">
                <h1 class="">{{ $app_name }}</h1>
                <p>Process documentation? Collect data? Customize reports? Just ask for it. Get in contact with the System Administrator and together create what you need. Please log in to gain access to {{ $app_name }}!</p>
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
