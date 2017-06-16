@extends('emails.layout')

@section('header')
    Password Changed!
@stop

@section('title')
    Dear {{ $user->name }},
@stop

@section('subtitle')
    The admin have changed your password!
@stop

@section('content')
    <p>
       Please click the following link and provide the credentials given in this email. Please change your password as soon as you log in.
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

