@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

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
						{!! Form::model($permission, ['route'=>['admin.permissions.update', $permission->name], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}	
							@include('permissions._form')

							<div class="col-sm-6 col-sm-offset-2 clear-fix">
								<button type="submit" class="btn btn-primary form-control">Update</button>
							</div>	
							
							<div class="form-group">
								<div class="col-sm-10 col-sm-offset-2">								
									<a href="{{ route('admin.permissions.index') }}"><< Return to Permissions List</a>
								</div>
							</div>
						
						{!! Form::close() !!}

						<div class="col-sm-10 col-sm-offset-1">
							<div class="form-group">
								<form action="{{ url('/admin/permissions', $permission->name) }}" method="POST" class="" style="display: inline-block;">
								    {!! csrf_field() !!}
								    {!! method_field('DELETE') !!}
								
								    <button type="submit" id="delete-permission" class="btn btn-danger"  name="deleteBtn">
								        <i class="fa fa-btn fa-trash"></i> Remove Permission
								    </button>
								</form>
							</div>
						</div>

				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
	
@stop