@extends('emails.layout')

@section('header')
    Welcome to Dainsys!
@stop

@section('title')
    Welcome to Dainsys, {{ $user->name }}.
@stop

@section('subtitle')
    A new user have been created for you!
@stop

@section('content')
    <p>
        Welcome to Dainsys, your APP!. Please click the following link and provide the credentials given in this email. Please chage your password as soon as you log in.
    </p>
    <p>
        {{ url('/admin/login') }}
    </p>
    
    <hr>
    These are your credentials: <br>
    <strong>Username:</strong> {{ $user->email }}<br>
    <strong>Password:</strong> {{ $password }}<br>
    <small>We strongly encourage you to change this password as soon as you log in!</small>
@stop

