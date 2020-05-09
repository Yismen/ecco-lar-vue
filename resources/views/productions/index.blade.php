@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Production', 'page_description'=>'Manage productions data.'])

@section('content')
	
	<div class="container-fluid">

		<div class="box box-primary pad">

			<div class="row">
				<div class="col-sm-12">
					@include('productions._dashboard')
				</div>

				<div class="col-sm-12">
					@include('productions._home')
				</div>
			</div>

		</div>
	</div>
	
	
@stop

@push('scripts')
@endpush


