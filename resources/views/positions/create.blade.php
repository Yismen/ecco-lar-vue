@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Positions', 'page_description'=>'Create a new position.'])

@section('content')
	<div class="container-fluid">
		<div class="box box-primary pad">
			<div class="row">
				<div class="col-sm-12">
					{!! Form::open(['route'=>['admin.positions.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}
						<div class="form-group">
							<legend>Adding a New Position</legend>
						</div>

						@include('positions._form')

						<div class="col-sm-10 col-sm-offset-2">
							<button type="submit" class="btn btn-primary form-control">Create</button>
							<br><br>
							<a href="{{ route('admin.positions.index') }}"><< Return to Positions List</a>
						</div>

					{!! Form::close() !!}
				</div>
			</div>

			{{-- // errors --}}
		</div>

	</div>
	
@stop

@section('scripts')

@stop
