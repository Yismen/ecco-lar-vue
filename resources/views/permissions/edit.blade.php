@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'No Description'])

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-warning pad">
					
					<div class="box-header">
						<h4>
							Edit Permission {{ ucwords( str_replace(['_', '-'], ' ', $permission->name) ) }}
							<a href="{{ route('admin.permissions.index') }}" class="pull-right">
								<i class="fa fa-list"></i> List
							</a>
						</h4>
					</div>
					
					<div class="box-body">
						{!! Form::model($permission, ['route'=>['admin.permissions.update', $permission->name], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}	

							<!-- Name -->
							<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
								{!! Form::label('name', 'Name:', ['class'=>'col-sm-2 control-label']) !!}
								<div class="col-sm-10">
									{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Name']) !!}
									{!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
								</div>
							</div>
							<!-- /. Name -->

							<!-- Roles -->
							<div class="form-group {{ $errors->has('roles') ? 'has-error' : null }}">
								{!! Form::label('roles', 'Roles:', ['class'=>'col-sm-2 control-label']) !!}
								<div class="col-sm-10">
									<div class="row">
										@foreach ($permission->roles_list as $id => $role)								
											<div class="col-sm-4">
												<div class="checkbox">
													<label>
														{!! Form::checkbox('roles[]', $id, null, []) !!} 
														{{ $role }}
													</label>
												</div>
											</div>	
										@endforeach
									</div>									
								</div>
							</div>
							<!-- /. Roles -->

							<div class="col-sm-8 col-sm-offset-2 clear-fix">
								<div class="form-group">
									<button type="submit" class="btn btn-warning">Update</button>
								</div>
							</div>	
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
	
@stop