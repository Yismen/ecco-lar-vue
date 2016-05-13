@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	@if ($user)
		<div class="col-sm-4 col-sm-offset-4 well row">
			<ul class="list-group">
				<li class="list-group-item">
					<strong>Name: </strong>{{ $user->name }}
				</li>
				<li class="list-group-item">
					<strong>Assigned to Roles: </strong>
					<br>
					@foreach ($user->roles as $role)
						<span class="label label-success">{{ $role->display_name }}</span>
					@endforeach
				</li>
				<li class="list-group-item">
					<strong>Username: </strong>{{ $user->username }}
				</li>
				<li class="list-group-item">
					<strong>Email: </strong>{{ $user->email }}
				</li>
				<li class="list-group-item {{ $user->is_admin ? 'text-success' : '' }}">
					<strong>Status: </strong>{{ $user->is_active ? 'Active User' : 'This user is not active' }}
				</li>
				<li class="list-group-item {{ $user->is_admin ? 'text-warning' : '' }}">
					<strong>Is Admin?: </strong>{{ $user->is_admin ? 'Yes, this user is admin' : 'No admin' }}
				</li>
			</ul>
			<a href="{{ route('users.edit', $user->username) }}" class="btn btn-warning"> Edit </a>
			{!! delete_button('users.destroy', $user->username, ['class'=>"btn btn-danger", 'label' => 'Delete']) !!}
			<hr>
			<a href="{{ route('users.index') }}" class=""> << Return to Users List </a>
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@section('scripts')
	
@stop