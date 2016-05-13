@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-4 col-sm-push-8">
		@include('productions._dashboard')
	</div>

	<div class="col-sm-8 col-sm-pull-4">
		@include('productions._home')
	</div>
	
@stop

@section('scripts')
	
@stop