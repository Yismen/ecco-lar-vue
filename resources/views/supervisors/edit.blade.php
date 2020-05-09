@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Supervisors', 'page_description'=>'Edit supervisor.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h4>
							Edit Supervisor {{ $supervisor->name }}
							<a href="{{ route('admin.supervisors.index') }}" class="pull-right">
								<i class="fa fa-home"></i> List
							</a>
						</h4>
					</div>

					{!! Form::model($supervisor, ['route'=>['admin.supervisors.update', $supervisor->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}

						<div class="box-body">
							@include('supervisors._form')

							{{-- <div class="checkbox">
								<label>
									<input type="checkbox" value="1" name="active">
									Is Active
								</label>
							</div> --}}

							<div class="checkbox">
								<label>
									{!! Form::checkbox('active', 1, null, []) !!}
									Is Active
								</label>
							</div>
						</div>

						<div class="box-footer">
							<div class="col-sm-12">
								<div class="form-group">
									<button type="submit" class="btn btn-success">UPDATE</button>
								</div>
							</div>
						</div>
					{!! Form::close() !!}

					{{-- <div class="box-footer">
						<delete-request-button
							url="{{ route('admin.supervisors.destroy', $supervisor->id) }}"
							redirect-url="{{ route('admin.supervisors.index') }}"
						></delete-request-button>
					</div> --}}
				</div>
			</div>

			{{-- // errors --}}
		</div>

	</div>

@stop

@push('scripts')

@endpush
