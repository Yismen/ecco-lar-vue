@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'No Description'])

@section('content')
	<div class="container-fluid">
		<div class="box box-primary pad">

			<div class="row">
				<div class="col-sm-12">
					<div class="page-header">
						Edit Permission {{ $permission->display_name }} 
						<a href="{{ route('admin.permissions.index') }}" class="pull-right">
							<i class="fa fa-list"></i>
						</a>
					</div>
					{{-- {!! Form::model($permission, ['route'=>['admin.permissions.update', $permission->name], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}	
						@include('permissions._form')

						<div class="col-sm-8 col-sm-offset-2 clear-fix">
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Update</button>
								<a href="{{ route('admin.permissions.index') }}"><i class="fa fa-angle-double-left"></i> Return to Permissions List</a>
							</div>
						</div>	
					{!! Form::close() !!} --}}
				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
	
@stop