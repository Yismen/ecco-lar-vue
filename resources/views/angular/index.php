<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Yismen Jorge">
    <meta name="csrf-token" content="<?php echo csrf_token() ?>">

    <title>Clean Blog</title>

    <!-- Bootstrap Core CSS -->
    <link href="../plugins/bootstrap/themes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- <link href="public/plugins/bootstrap/startbootstrap-clean-blog-1.0.2/css/clean-blog.min.css" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body ng-app="dainsys">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Start Bootstrap</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right" ng-controller="LoginCtrl">
                    <li>
                        <a href="#/">Home</a>
                    </li>
                    <li>
                        <a href="#/articles">Articles</a>
                    </li>
                    <li>
                        <a href="#/about-us">About</a>
                    </li>
                    <li>
                        <a href="#/contact-us">Contact</a>
                    </li>
                    <li>
                        <a href="#/employees">Employees</a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="">Dropdown <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#/profile">Profile</a></li>
                            <li><a href="" ng-click="logout()">Logout</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

	<!-- Messages Interface -->
    <div  style="margin-top:60px;">
        <div class="row" ng-show="flash">
            <div class="col-sm-6 col-sm-offset-3">
                <div id="flash">
                    <div class="alert alert-{{ flashType || info }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Attention!</strong> {{ flash }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading Interface -->
        <div data-ng-if="loading" style="position: absolute; z-index:500; top:0; left:0; width:100%; height:100%; background-color: rgba(0,0,0,0.5);">
            <div class="">
                <div class="text-center">
                    <h1 style="position:absolute; font-size: 72px; top:40%; left:47%;"><i class="fa fa-spinner fa-spin"></i></h1>
                    <h5 class="">Loading...</h5>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container-fluid" ng-view></div>
    </div>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="../plugins/jQuery/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <!-- <script src="public/plugins/bootstrap/startbootstrap-clean-blog-1.0.2/js/clean-blog.min.js"></script> -->

    <!-- AngularJs here -->
	<script src="<?php echo asset('plugins/angular-1.4.3/angular.min.js') ?>"></script>
    <script src="<?php echo asset('plugins/angular-1.4.3/angular-route.min.js') ?>"></script>
    <script src="<?php echo asset('plugins/angular-1.4.3/angular-cookies.min.js') ?>"></script>

    <script src="<?php echo asset('angular-js/app/apps.js') ?>"></script>
    <script src="<?php echo asset('angular-js/services/services.js') ?>"></script>
    <script src="<?php echo asset('angular-js/controllers/controllers.js') ?>"></script>
  <!--   <script src="../angular-js/controllers/main.js"></script>
    <script src="../angular-js/controllers/loading.js"></script>
    
    <script src="../angular-js/services/application.js"></script>
    <script src="../angular-js/services/auth.js"></script>
    <script src="../angular-js/services/filters.js"></script>
    <script src="../angular-js/services/routefilter.js"></script> -->

</body>

</html>

