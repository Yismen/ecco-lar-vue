@extends('emails.layout')

@section('header')
    Welcome to Dainsys!
@stop

@section('title')
    {{ $user->name }}
@stop

@section('subtitle')
    A new user have been created for you!
@stop

@section('content')
    <p>
        We have created an user for you in our Dainsys app. Please access the following link to log in: <a href="{{ url('/admin/login') }}">Dainsys</a>
        <hr>
        These are your credentials: <br>
        <strong>Username:</strong> {{ $user->email }} <br>
        <strong>Password:</strong> {{ $password }} <br>
        <small>We strongly recomend to change this password as soon as yo login!</small>
    </p>
@stop