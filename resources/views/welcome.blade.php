@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->site(), ['page_header'=>'Welcome', 'page_description'=>'Welcome page!', 'hide_content_header'=>false])

@section('content')
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <div class="">
        <div class="no-margin bg-{{ $color ?? 'yellow'}}  intro-header">
            <div class="container-fluid">
                <div class="col-sm-12 text-center">
                    <dainsys-logo default-animation="shake" logo="{{ asset('images/logo.png') }}" :random-animation="true"></dainsys-logo>

                    <div class="row">
                        <div class="col-lg-10 col-lg-offset-1">
                            <h1 class="my-main-header" style="font-weight: bold; font-size: 4.5rem; text-transform: uppercase;">
                                Welcome to {{ $app_name }}
                            </h1>
                        </div>
                    </div>

                    <hr class="divider" style="max-width: 3.25rem; border-width: .4rem; border-color: #fff;">

                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <p style="font-size: 2rem">Dainsys (Data Integration System) is an app created to provide you with valuable, timely and on point information to add value to your job.</p>
                        </div>
                    </div>
                    <a href="/admin" class="btn btn-default btn-lg">
                        <i class="fa fa-user"></i> Get Started!
                    </a>
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
                    <p>Process documentation? Collect data? Customize reports? Just ask for it. Get in contact with the System Administrator and together create very useful components.</p>
                </div>
                </div>
            </div>
        </div>

        <div class="secondary-header no-margin text-center">
            <div class="container-fluid">
                <h1 class="">Roles Based Access</h1>
                <p>Routes are limited by roles and permissions. Please Log In to gain access. </p>
                <a href="/admin" class="btn btn-primary">
                    <i class="fa fa-sing-in"></i> Sign In
                </a>
                <p>Or @include('layouts.partials.links.webmaster'), System Administrator</p>
            </div>
        </div>
    </div>
@endsection

