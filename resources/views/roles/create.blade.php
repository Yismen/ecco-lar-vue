
@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Roles Management', 'page_description'=>'Add a new role.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					<div class="box-header">
						<h4>Create Role
							<a href="{{ route('admin.roles.index') }}"class="pull-right"title="Return to List">
								<i class="fa fa-list"></i>
							</a>
						</h4>
					</div>

					{!! Form::open(['route'=>['admin.roles.store'], 'method'=>'post', 'class'=>'form-horizontal', 'role'=>'form']) !!}
						<div class="box-body">
							@include('roles._form')
						</div>

						<div class="box-footer">
							<div class="col-sm-10 col-sm-offset-2">
								<button type="submit" class="btn btn-primary form-control">Create</button>
							</div>
						</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')

@endpush
