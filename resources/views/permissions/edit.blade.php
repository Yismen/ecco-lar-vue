@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="container">
		<div class="box box-primary pad">

			<div class="row">
				<div class="col-sm-12">
					<div class="page-header">
						Edit Permission {{ $permission->display_name }} 
						<a href="{{ route('admin.permissions.index') }}" class="pull-right">
							<i class="fa fa-list"></i>
						</a>
					</div>
						{!! Form::model($permission, ['route'=>['admin.permissions.update', $permission->name], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}	
							@include('permissions._form')

							<div class="col-sm-6 col-sm-offset-2 clear-fix">
								<button type="submit" class="btn btn-primary form-control">Update</button>
							</div>	
							<div class="col-sm-10 col-sm-offset-2">								
								<a href="{{ route('admin.permissions.index') }}"><< Return to Permissions List</a>
							</div>
						
						{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
	
@stop