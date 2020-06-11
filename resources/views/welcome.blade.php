@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->site(), ['page_header'=>'Welcome', 'page_description'=>'Welcome page!',
'hide_content_header'=>false])

@section('content')
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<div class="intro-header">
    <div class="no-margin main-header">
        <h1 class="app-title">{{ $app_name }}</h1>
        <p class="lead">Valuable, timely and on point information to aggregate value to your job.</p>
        <dainsys-logo default-animation="shake" class="logo" class="hidden-sm"
            logo="{{ asset('images/logo.png') }}" 
            :random-animation="true"
            >
        </dainsys-logo>
        <hr class="my-2 hidden">
        <a class="btn btn-warning btn-lg animatable call-to-action"  data-animation="from-bottom" href="/admin" role="button" >
            <i class="fa fa-sign-in"></i> Get Started!
        </a>
        <a href="#services" class="more-button animatable "  data-animation="from-top">
            <i class="fa fa-angle-double-down"></i> More
        </a>
    </div>
</div>

<div class="secondary-header no-margin text-center" id="services">
    <div class="row">
        <div class="col-sm-12 animatable" data-animation="from-bottom">
            <h1 class=" animatable" data-animation="from-bottom-left">Data Integration System</h1>
        </div>

        <div class="col-sm-10 col-sm-offset-1">
            <div class="col-md-4">
                <div class="row">
                    <animation-scale>
                        <i class="fa fa-5x fa-dashboard text-primary"></i>
                    </animation-scale>
                    <h3>Roles Based Access</h3>
                    <div
                        class="col-xs-6 col-xs-offset-3 col-sm-8 col-sm-offset-2 col-md-10 col-md-offset-1 col-lg-12 col-lg-offset-0">
                        <p>Limit access to sensitive information based on specific roles</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="row">
                    <animation-scale>
                        <i class="fa fa-5x fa-lock text-primary"></i>
                    </animation-scale>
                    <h3>ACL</h3>
                    <div
                        class="col-xs-6 col-xs-offset-3 col-sm-8 col-sm-offset-2 col-md-10 col-md-offset-1 col-lg-12 col-lg-offset-0">
                        <p>Limit the access to sensitive data based on our Access Level Control logic. Security
                            First.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="row">
                    <animation-scale>
                        <i class="fa fa-5x fa-dashboard text-primary"></i>
                    </animation-scale>
                    <h3>Dashboards</h3>
                    <div
                        class="col-xs-6 col-xs-offset-3 col-sm-8 col-sm-offset-2 col-md-10 col-md-offset-1 col-lg-12 col-lg-offset-0">
                        <p>We help create amazing dashboards with {{ $app_name }}. Your business at a glance.</p>
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
            <p>Process documentation? Collect data? Customize reports? Just ask for it. Get in contact with the
                System Administrator and together create very useful components.</p>
        </div>

        <div class="col-sm-12 ">
            <a href="/admin" class="btn btn-default btn-lg animatable"
                data-animation="from-bottom"  
                style="margin-top: 2rem;
                box-shadow: rgba(0, 0, 0, .5) -2px 2px 2px 0px;
                text-transform: uppercase;
                visibility: visible;
                font-weight: 700"
            > <i class="fa fa-sign-in"></i> Go For It! </a>
        </div>
    </div>
</div>
@endsection
