@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Roles Management', 'page_description'=>'Edit Roles to change their interaction with the system.'])

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					<div class="row">
						<div class="col-sm-12">
							<div class="page-header">
								Edit Role {{ $role->display_name }} 
								<a 
									href="{{ route('admin.roles.index') }}" 
									class="pull-right"
									title="Return to List"
								>
									<i class="fa fa-list"></i>
								</a>

							</div>
								{!! Form::model($role, ['route'=>['admin.roles.update', $role->name], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
								
									@include('roles._form')

									<div class="col-sm-10 col-sm-offset-2">
										<button type="submit" class="btn btn-primary form-control">Update</button>
										<br><br>
										<a href="{{ route('admin.roles.index') }}"><< Return to Roles List</a>
									</div>
								
								{!! Form::close() !!}

								<div class="form-group">
									<form action="{{ url('/admin/roles', $role->name) }}" method="POST" class="" style="display: inline-block;">
									    {!! csrf_field() !!}
									    {!! method_field('DELETE') !!}
									
									    <button type="submit" id="delete-role" class="btn btn-danger"  name="deleteBtn">
									        <i class="fa fa-btn fa-trash"></i> Delete Role
									    </button>
									</form>	
								</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop