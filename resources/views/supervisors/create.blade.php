@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Supervisors', 'page_description'=>'Create a new supervisor.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					{!! Form::open(['route'=>['admin.supervisors.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}
						<div class="box-header with-border">
							<h4>
								Add a New Supervisor
								<a href="{{ route('admin.supervisors.index') }}" class="pull-right">
									<i class="fa fa-home"></i> List
								</a>
							</h4>
						</div>

						<div class="box-body">
							@include('supervisors._form')
						</div>

						<div class="box-footer">
							<div class="col-sm-12">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Create</button>
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

@push('scripts')

@endpush
