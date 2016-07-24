@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['Roles Management'=>'title', 'page_description'=>'Manage the roles and its permissions.'])

@section('content')
	@if ($role)
		<div class="col-sm-4 col-sm-offset-4 well row">
			<ul class="list-group">
				<li class="list-group-item">
					<strong>Name: </strong>{{ $role->name }}
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
			
			<hr>
			<a href="{{ route('admin.roles.index') }}" class=""> << Return to Roles List </a>
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@section('scripts')
	
@stop