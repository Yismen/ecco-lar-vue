@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

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
					@foreach ($role->users as $user)
						<span class="label label-success">{{ $user->name }}</span>
					@endforeach
				</li>
				<li class="list-group-item">
					<strong>Assigned to Permissions: </strong>
					<br>
					@foreach ($role->perms as $permission)
						<span class="label label-primary">{{ $permission->display_name }}</span>
					@endforeach
				</li>
				<li class="list-group-item">
					<strong>Assigned to Menus: </strong>
					<br>
					@foreach ($role->menus as $menu)
						<span class="label label-info">{{ $menu->display_name }}</span>
					@endforeach
				</li>
				<li class="list-group-item">
					<strong>Description: </strong>{{ $role->description }}
				</li>
			</ul>
			<a href="{{ route('roles.edit', $role->name) }}" class="btn btn-warning"> Edit </a>
			{!! delete_button('roles.destroy', $role->name, ['class'=>"btn btn-danger", 'label' => 'Delete']) !!}
			<hr>
			<a href="{{ route('roles.index') }}" class=""> << Return to Roles List </a>
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@section('scripts')
	
@stop