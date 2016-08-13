@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Productions', 'page_description'=>'Daily Production Data'])

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, iusto amet quisquam veniam, temporibus nesciunt ipsa ullam corporis aut, quia quis enim nihil dolores officia modi impedit odio? Non, vel.
				</div>
			</div>
		</div>
	</div>
@endsection