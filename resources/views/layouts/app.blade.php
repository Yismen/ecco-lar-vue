<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html style="height: auto;">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta id="_token" name="_token" content="{{ csrf_token() }}">  <!-- Laravel token -->
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Ecco | {{ $page_header or 'Admin Header' }}</title>

        <link rel="stylesheet" type="text/css" href="{{ elixir('css/all.css') }}">
        <!-- Site Favicon -->
        <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico') }}">
        {{-- <meta name="msvalidate.01" content="FF0D79C53170EBEB62609685F3D5A21C" /> --}}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
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
    <body class="{{ $settings->skin or config('dainsys.layout_color', 'skin-yellow') }} 
        {{ $settings->layout or config('dainsys.layout', 'default') }} 
        {{ $settings->sidebar_collapse or config('dainsys.sidebar_collapse', '')  }}
        {{ $settings->sidebar_mini or config('dainsys.sidebar_mini', '') }}" 
        style="height: auto;">  
        <div class="wrapper" style="height: auto;">
            <!-- Main Header -->
            {{-- @inject('user', 'App\Layout') --}}
            @include('layouts.partials.navbar-top')
            <!-- Left side column. contains the logo and sidebar -->
       
            @include('layouts.partials.navbar-left')
            <!-- Content Wrapper. Contains page content -->
            
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="min-height: 946px;">

                <!-- Content Header (Page header) -->
                @if (! isset($hide_content_header) )
                    <section class="content-header">
                        <h1>
                            {{ $page_header or config('dainsys.app_name') }}
                            <small>{{ $page_description or '' }}</small>
                        </h1>
                        <!-- <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                            <li class="active">Here</li>
                        </ol> -->
                    </section>
                @endif

                <!-- Main content -->
                <section class="content" id="app">
                    <loading-spinner></loading-spinner>
                    <!-- Your Page Content Here -->
                    <!-- 
                    |************************************|
                    | Main Content Here
                    |************************************|
                     -->
                    @include('layouts.partials.flashes')
                    @include('layouts.partials.spinner')
                    
                    @yield('content')
                </section>
                <!-- /.content -->
            
            </div>
            <!-- /.content-wrapper -->
            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                    @include('layouts.partials.back-to-top')
                    @include('layouts.partials.links.webmaster')
                </div>
                <!-- Default to the left -->
                <strong>
                    Copyright &copy; {{ date("Y") }} 
                    <a href="{{ url('/admin') }}">
                        {{ $app_name }}, {{ $client_name }}
                    </a>.
                </strong> All rights reserved.
                @if ($user)
                    @include('layouts.partials.nav-settings')
                @endif
            </footer>
            
            <!-- Control Sidebar -->
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
        </div>
        <!-- ./wrapper -->
        <!-- REQUIRED JS SCRIPTS -->
        <script src="{{ elixir('js/all.js') }}"></script>
        <!-- Optionally, you can add Slimscroll and FastClick plugins.
        Both of these plugins are recommended to enhance the
        user experience. Slimscroll is required when using the
        fixed layout. -->

        <!-- 
        |************************************|
        | All scripts will bi placed here
        |************************************|
         -->
         @yield('scripts')
    </body>
</html>