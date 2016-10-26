@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Welcome', 'page_description'=>'Welcome page!'])

@section('content')
    <div class="container-fluids">
        <div class="jumbotron no-margin">
            <div class="container">
                <h1 class="my-main-header">Welcome to Dainsys App</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem expedita dolore distinctio, a, sequi eum libero repellat adipisci quos maiores rerum vel reprehenderit inventore architecto porro esse pariatur quo suscipit?</p>
                
                @if (Auth::check())

                    <div class="col-sm-12 text-center">
                        <div class="col-xs-2 col-xs-offset-2">
                            <img src="{{ asset(Auth::user()->profile->photo) }}" class="img-responsive img-circle" alt="Image">
                        </div>
                        <div class="col-xs-6">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium, libero nam illo asperiores ad, iste itaque eligendi est sed accusantium deserunt recusandae at, optio, quis. Mollitia nostrum atque, repellendus esse?
                            <pre>{{ Auth::user() }}</pre>
                            <pre>{{ Auth::user()->profile }}</pre>
                        </div>
                    </div>
                @else
                    <p>
                        <a href="/admin/login" class="btn btn-primary btn-lg">Login to the App</a>
                        <a class="btn btn-info btn-lg">Register</a>
                    </p>
                @endif
            </div>
        </div>

        <div class="jumbotron no-margin red-div">
            <div class="container">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
        </div>

        <div class="jumbotron no-margin black-div">
            <div class="container">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem expedita dolore distinctio, a, sequi eum libero repellat adipisci quos maiores rerum vel reprehenderit inventore architecto porro esse pariatur quo suscipit?</p>
            </div>
        </div>

        <div class="jumbotron no-margin grey-div">
            <div class="container">
                <div class="col-sm-4">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                </div>
                <div class="col-sm-8">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
        </div>

        <div class="jumbotron no-margin green-div">
            <div class="container">
                
                <div class="col-sm-8">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <div class="col-sm-4">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                </div>
            </div>
        </div>

        <div class="jumbotron no-margin yellow-div">
            <div class="container">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
        </div>

        <div class="jumbotron no-margin blue-div">
            <div class="container">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
        </div>

    </div>
@endsection
