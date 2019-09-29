@extends('layouts.app', ['page_header'=>'Welcome', 'page_description'=>'Welcome page!', 'hide_content_header'=>false])
@section('content')
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

<div class="container-fluid">
    <h1 class="my-main-header"
    style="
        display: flex;
        font-weight: 500;
        font-size: 2.5rem;
        font-stretch: extra-expanded;
        text-transform: uppercase;
    ">
        <img src="{{ asset('images/logo.png') }}" alt="Image" height="30px">
        Welcome to {{ $app_name }}{{ isset($user) && $user->name ? ', ' . $user->name : '' }}
    </h1>

    <div class="row">
        <div class="col-sm-9">
            @include('app.partials.stats')

            @include('app.partials.birthdays')

            @include('app.partials.latest-members')
        </div>
        <div class="col-sm-3">
            @include('app.partials.your-apps')
        </div>
    </div>
</div>
@endsection
