@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->site(), ['page_header'=>'Welcome', 'page_description'=>'Welcome page!',
'hide_content_header'=>false])

@section('content')
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<div class="">
    <div class="no-margin bg-{{ $color ?? 'yellow'}}  intro-header">
        <div class="container-fluid">
            <div class="col-sm-12 text-center intro-content">
                <dainsys-logo default-animation="shake" logo="{{ asset('images/logo.png') }}" :random-animation="true">
                </dainsys-logo>

                <div class="header-title">
                    {{ $app_name }}
                </div>

                {{-- <div class="divider col-xs-6 col-sm-2"></div> --}}

                <div class="col-sm-8 col-sm-offset-2 header-description">
                    Valuable, timely and on point information to
                    aggregate value to your job.
                </div>
                <a href="/admin" class="btn btn-default btn-lg call-to-action">
                    <i class="fa fa-sign-in"></i> Get Started!
                </a>
            </div>
        </div>
    </div>

    <div class="secondary-header no-margin text-center">
        <div class="row">
            <div class="col-sm-12" style="margin-bottom: 2rem;">
                <h1>Data Integration System</h1>
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
                <a href="/admin" class="btn btn-primary btn-lg animatable" style="background-color: white;
                        margin-top: 2rem;
                        color: black;
                        border: 1px #fefefe solid;">
                    <i class="fa fa-sign-in"></i> Go For It!
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    (function(){
            const animate = document.querySelectorAll(".animatable")
            // animate.style.opacity = 0;

            console.log(animate)

            const observer = new IntersectionObserver(elements => {
                elements.forEach(element => {
                    if(element.intersectionRatio > 0) {
                        element.target.classList.add("animated")
                        element.target.classList.add("slideInUp")
                    }
                });
            })

            animate.forEach(element => {
                observer.observe(element)
            });
        })()
</script>
@endsection