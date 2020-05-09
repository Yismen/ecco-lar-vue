@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'No Description'])

@section('content')
	@if ($permission)
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">					
					<div class="box box-primary pad">
						<div class="box-header">
							<h4>
								{{ ucwords(str_replace(['-', '_'], ' ', $permission->name)) }} 
								<a href="{{ route('admin.permissions.index') }}" class="pull-right">
									<i class="fa fa-list"></i> List
								</a>
							</h4>
						</div>
						<ul class="list-group">
							<li class="list-group-item">
								<strong>Permission: </strong>{{ $permission->name }}
							</li>
							<li class="list-group-item">
								<strong>Resource: </strong>{{ ucwords( str_replace(['_', '-'], ' ', $permission->name) ) }}
							</li>
							<li class="list-group-item">
								<strong>Description: </strong>{{ $permission->guard_name }}
							</li>
							<li class="list-group-item">
								<strong>Assigned to Roles: </strong>
								<br>
								@foreach ($permission->roles as $role)
									<span class="label label-info">{{ $role->name }}</span>
								@endforeach
							</li>
						</ul>
						<a href="{{ route('admin.permissions.edit', $permission->name) }}" class="btn btn-warning"> Edit </a>
					</div>
				</div>
			</div>
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@push('scripts')
	
@endpush