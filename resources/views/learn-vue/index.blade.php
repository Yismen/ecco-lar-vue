@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Learn Vue', 'page_description'=>'Create to learn some vue js.'])

<style>
	._Done {
		color: red;
	}
</style>

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					<nba>MY new task</nba>

					<hr>


					<tasks>This is tasks</tasks>
				</div>
			</div>
		</div>
	</div>
@endsection