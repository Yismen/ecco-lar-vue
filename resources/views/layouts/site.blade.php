<!DOCTYPE html>
<html style="height: auto; min-height: 100%;">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta id="_token" name="_token" content="{{ csrf_token() }}">  Laravel 5.3 token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Ecco | {{ $page_header ?? 'Admin Header' }}</title>
        <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
        <!-- Site Favicon -->
        <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>

    <style>
        .my-main-header {
            animation: from-left 1s 1 ease-in-out;
            font-weight: bold;
            font-size: 6rem;
            font-stretch: extra-expanded;
            text-shadow: -2px 1px 6px #4a4747;
            text-transform: uppercase;
        }
        .header-description {
            animation: from-bottom 1s 1 ease-in-out;
            font-size: 2rem;
            letter-spacing: .2rem;
        }
        .call-to-action {
            margin-top: 2rem;
            animation: from-right 1s 1 ease-in-out;
        }
        @keyframes from-left {
            from{
                transform: translateX(-50px);
                opacity: 0;
            }
        }
        @keyframes from-bottom {
            from{
                transform: translateX(-5px);
                transform: translateY(40px);
                opacity: 0;
            }
        }
        @keyframes from-right {
            from{
                transform: translateX(50px);
                opacity: 0;
            }
        }
    </style>
    <!--
        BODY TAG OPTIONS:
        =================
        Apply one or more of the following classes to get the
        desired effect
        |*********************************************************|
        | SKINS         | skin-blue                               |
        |               | skin-black                              |
        |               | skin-purple                             |
        |               | skin-yellow                             |
        |               | skin-red                                |
        |               | skin-green                              |
        |*********************************************************|
        |LAYOUT OPTIONS | fixed                                   |
        |               | layout-boxed                            |
        |               | layout-top-nav                          |
        |               | sidebar-collapse                        |
        |               | sidebar-mini                            |
        |*********************************************************|
        -->

    <body
        style="height: auto; min-height: 100%;"
        class="sidebar-collapse
        "
    >
        <div class="wrapper" style="height: auto;" id="app">
            <!-- Main Header -->
            {{-- @inject('user', 'App\Layout') --}}
            {{-- @include('layouts.partials.main-header') --}}
            <!-- Left side column. contains the logo and sidebar -->

            {{-- @include('layouts.partials.main-sidebar') --}}
            <!-- Content Wrapper. Contains page content -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="min-height: 960px;">
                {{-- @include('layouts.partials.session-flash-messages') --}}
                <div class="hidden-xs">
                    <back-to-top></back-to-top>
                </div>
                {{-- <loading-component></loading-component> --}}
                <!-- Your Page Content Here -->
                <!--
                    |************************************|
                    | Main Content Here
                    |************************************|
                     -->

                <!-- Main content -->
                <section class="content" style="padding: 0">
                    @yield('content')
                </section>
                <!-- /.content -->

            </div>
            <!-- /.content-wrapper -->
            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                    @include('layouts.partials.links.webmaster')
                </div>
                <!-- Default to the left -->
                <strong>
                    Copyright &copy; {{ date("Y") }}
                    <a href="{{ url('/admin') }}">
                        {{ $app_name }}, {{ $client_name }}
                    </a>.
                </strong> All rights reserved.
            </footer>

            <!-- Control Sidebar -->
            @if ($user)
                @include('layouts.partials.control-sidebar')
            @endif
            <div class="control-sidebar-bg"></div>
            <!-- /.control-sidebar -->
            <!-- Add the sidebars background. This div must be placed
                immediately after the control sidebar -->
        </div>
        <!-- ./wrapper -->
        <!-- REQUIRED JS SCRIPTS -->
        <script src="{{ mix('js/app.js') }}"></script>
        <script>
        </script>
        <!-- Optionally, you can add Slimscroll and FastClick plugins.
            Both of these plugins are recommended to enhance the
            user experience. Slimscroll is required when using the
            fixed layout. -->

        <!--
            |************************************|
            | All scripts will be placed here
            |************************************|
             -->
        @yield('scripts')
    </body>

</html>
