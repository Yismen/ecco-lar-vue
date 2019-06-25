@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Welcome', 'page_description'=>'Welcome page!', 'hide_content_header'=>false])

@section('content')
    <div class="">

        <div class="no-margin bg-{{ $color ?? 'yellow'}}  intro-header">
            <div class="container-fluid">
                <div class="col-sm-12 text-center">
                    <dainsys-logo default-animation="shake" logo="{{ asset('images/logo.png') }}" :random-animation="true"></dainsys-logo>

                    <h1 class="my-main-header" style="font-weight: bold; margin-bottom: 2.5rem; font-size: 50px;">
                        Welcome to {{ $app_name }}{{ isset($user) && $user->name ? ', ' . $user->name : '' }}
                    </h1>
                    @if ($user)
                        <a href="/admin/profiles" class="btn btn-default btn-lg">
                            User Profile! <i class="fa fa-angle-double-right"></i>
                        </a>
                    @else
                        <a href="/login" class="btn btn-default btn-lg">
                             <i class="fa fa-user"></i> Get Started!
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="secondary-header no-margin text-center">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="col-md-4">
                        <div class="row">
                            <animation-scale>
                                <i class="fa fa-5x fa-users text-primary"></i>
                            </animation-scale>
                            <h3>Employees</h3>
                            <div class="col-xs-6 col-xs-offset-3 col-sm-8 col-sm-offset-2 col-md-10 col-md-offset-1 col-lg-12 col-lg-offset-0">
                                <p>With {{ $app_name }} performance reports, dashboards, payrolls and invoicing are all one click away.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="row">
                            <animation-scale>
                                <i class="fa fa-5x fa-dashboard text-primary"></i>
                            </animation-scale>
                            <h3>Dashboards</h3>
                            <div class="col-xs-6 col-xs-offset-3 col-sm-8 col-sm-offset-2 col-md-10 col-md-offset-1 col-lg-12 col-lg-offset-0">
                                <p>We help create amazing dashboards with {{ $app_name }}. Your business at a glance.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="row">
                            <animation-scale>
                                <i class="fa fa-5x fa-lock text-primary"></i>
                            </animation-scale>
                            <h3>ACL</h3>
                            <div class="col-xs-6 col-xs-offset-3 col-sm-8 col-sm-offset-2 col-md-10 col-md-offset-1 col-lg-12 col-lg-offset-0">
                                <p>Limit the access to sensitive data based on our Access Level Control logic. Security First.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="secondary-header no-margin text-center bg-{{ $color ?? 'yelow' }} disabled color-palette">
            <div class="container-fluid">
                <h1 class="">{{ $app_name }}</h1>
                <div class="col-xs-8 col-xs-offset-2">
                    <p>Process documentation? Collect data? Customize reports? Just ask for it. Get in contact with the System Administrator and together create what you need. Please log in to gain access to {{ $app_name }}!</p>
                </div>
                </div>
            </div>
        </div>

        <div class="secondary-header no-margin text-center">
            <div class="container-fluid">
                <h1 class="">Roles Based Access</h1>
                @if ($user && $user->roles )
                    <h3 class="">You have the following roles assigned to you. </h3>
                    @foreach ($user->roles as $role)
                        <span class="label label-success">{{ personName($role->name) }}</span>
                    @endforeach
                    <p>Access their end points by using the left side menu by clicking on the <i class="fa fa-bars"></i> sign at the top.</p>
                @else
                    <p>Routes are limited by roles and permissions. Please Log In to gain access. </p>
                @endif
            </div>
        </div>
    </div>
@endsection
