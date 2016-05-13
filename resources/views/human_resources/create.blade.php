@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<h1>Create, huh?</h1>
@stop

@section('scripts')
	
@stop