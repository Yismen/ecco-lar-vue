
@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Roles Management', 'page_description'=>'Manage roles, permissions and menus items per role.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					<div class="row">
						<div class="col-sm-12">
							<ul class="list-group">
								<li class="list-group-item">
									<strong>Name: </strong>{{ $role->name }}
									<a href="{{ route('admin.roles.index') }}" class="pull-right"><i class="fa fa-home"></i> List</a>
								</li>
								<li class="list-group-item">
									<strong>Display Name: </strong>{{ $role->display_name }}
								</li>
								<li class="list-group-item">
									<strong>Assigned to Users: </strong>
									<br>
									@if ($role->users)
										@foreach ($role->users as $user)
											<span class="label label-success">{{ $user->name }}</span>
										@endforeach
									@endif
								</li>
								<li class="list-group-item">
									<strong>Assigned to Permissions: </strong>
									<br>
									@if ($role->perms)
										@foreach ($role->perms as $permission)
											<span class="label label-primary">{{ $permission->display_name }}</span>
										@endforeach
									@endif
								</li>
								<li class="list-group-item">
									<strong>Assigned to Menus: </strong>
									<br>
									@if ($role->menus)
										@foreach ($role->menus as $menu)
											<span class="label label-info">{{ $menu->display_name }}</span>
										@endforeach
									@endif
								</li>
								<li class="list-group-item">
									<strong>Description: </strong>{{ $role->description }}
								</li>
							</ul>
							<a href="{{ route('admin.roles.edit', $role->name) }}" class="btn btn-warning"> Edit </a>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop
