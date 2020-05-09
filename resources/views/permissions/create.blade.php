@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Permissions', 'page_description'=>'Create a new permission for your app.'])

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					<div class="box-header">
						<h4>
							New Permission
							<a href="{{ route('admin.permissions.index') }}" class="pull-right">
								<i class="fa fa-list"></i> List
							</a>
						</h4>
					</div>

					{!! Form::open(['route'=>['admin.permissions.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}
						<div class="box-body">

							@include('permissions._form')

						</div>

						<div class="box-footer">
							<div class="col-sm-10 col-sm-offset-2">
								<button type="submit" class="btn btn-primary">CREATE</button>
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