<!DOCTYPE html>
<html style="height: auto;">

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
    <link rel="shortcut icon" href="{{ asset('storage/images/logo.png') }}" type="image/x-icon">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->

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

<body
    class="
        {{ $settings->skin ?? config('dainsys.layout_color', 'skin-yellow') }}
        {{ $settings->layout ?? config('dainsys.layout', 'default')  }}
        {{ $settings->sidebar_collapse ?? config('dainsys.sidebar_collapse', '')  }}
        {{ $settings->sidebar_mini ?? config('dainsys.sidebar_mini', '')  }}
    "
>
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
                    {{ $page_header ?? config('dainsys.app_name') }}
                    <small>{{ $page_description ?? '' }}</small>
                </h1>
                <!-- <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                            <li class="active">Here</li>
                        </ol> -->
            </section>
            @endif

            <!-- Main content -->
            <section class="content" id="app">
                <loading-component></loading-component>
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
        </footer>

        <!-- Control Sidebar -->
        @if ($user)
            @include('layouts.partials.nav-settings')
        @endif
        <!-- /.control-sidebar -->
        <!-- Add the sidebars background. This div must be placed
            immediately after the control sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED JS SCRIPTS -->
    <script src="{{ mix('js/app.js') }}"></script>
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