@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Supervisors', 'page_description'=>'Create a new supervisor.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					{!! Form::open(['route'=>['admin.supervisors.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}
						<div class="box-header with-border">Adding a New Supervisor</div>

						<div class="box-body">
							@include('supervisors._form')
						</div>

						<div class="box-footer">
							<div class="col-sm-12">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Create</button>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-12">
									<a href="{{ route('admin.supervisors.index') }}"><< Return to Supervisors List</a>
								</div>
							</div>
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
