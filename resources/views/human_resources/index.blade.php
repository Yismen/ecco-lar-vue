@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="container">
		<h1>Show a Dashboard</h1>
	</div>
@stop

			