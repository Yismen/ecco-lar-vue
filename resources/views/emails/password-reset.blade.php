@extends('emails.layout')

@section('header')
    Passord Changed!
@stop

@section('title')
    {{ $user->name }}
@stop

@section('subtitle')
    The admin have changed your password
@stop

@section('content')
    <p>
        Please clike here <a href="{{ url('/admin/login') }}">Dainsys</a> to log in with the new credentials.
        <hr>
        <h5>Credentials:</h5>
        <strong>Username:</strong> {{ $user->email }} <br>
        <strong>Password:</strong> {{ $password }} <br>
        <small>We strongly recomend to change this password as soon as yo login!</small>
    </p>
@stop

