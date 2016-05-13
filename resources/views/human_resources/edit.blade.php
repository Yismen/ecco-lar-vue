@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-8 col-sm-offset-1">
		<h1>Edit..., your life maybe?</h1>
	</div>
@stop

@section('scripts')
	
@stop