@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	
	<div class="container">

		<div class="box box-primary pad">

			<div class="row">
				<div class="col-sm-4 col-sm-push-8">
					@include('productions._dashboard')
				</div>

				<div class="col-sm-8 col-sm-pull-4">
					@include('productions._home')
				</div>
			</div>

		</div>
	</div>
	
	
@stop

@section('scripts')
	
@stop


