@extends('emails.layout')

@section('header')
    Password Changed!
@stop

@section('title')
    {{ $user->name }}
@stop

@section('subtitle')
    The admin have changed your password
@stop

@section('content')
    <p>
        Please click here <a href="{{ url('/admin/login') }}">Dainsys</a> to log in with the new credentials, or copy and paste this link into your web browser URL: <br>
        {{ url('/admin/login') }}
        <hr>
        <h5>Credentials:</h5>
        <strong>Username:</strong> {{ $user->email }} <br>
        <strong>Password:</strong> {{ $password }} <br>
        <small>We strongly encourage to change this password as soon as you log in!</small>
    </p>
@stop

