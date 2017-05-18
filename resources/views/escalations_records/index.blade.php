@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Escalations Records', 'page_description'=>'Add a new Escalations Record!'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">

			        <h4 class="page-header">
			            Escalations Records
			        </h4>

					<router-view></router-view>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	<script src="{{ elixir('js/app.js') }}"></script>
@stop