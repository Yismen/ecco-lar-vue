@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="jumbotron">
		<div class="container">
			<h1>Hello, {{ ucwords($user->name) }}</h1>
			<h3>Welcome to Dainsys Intranet</h3>
			<p>
				At the left side of your screen you will find the links assigned to your role. At the very tope
				of your screen, right after your name, there is a icon wigh three bars which you can use the toggle 
				the visualization of this side menu.
			</p>
			<p>
				<a href="#" id="toggler" class="btn btn-primary btn-lg">
					<i class="fa fa-bars"></i>
					Toggle Side Menu
				</a>
			</p>
		</div>
	</div>
@stop

@section('scripts')
	
@stop