@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	@if ($menu)
		<div class="col-sm-4 col-sm-offset-4 well row">
			<ul class="list-group">
				<li class="list-group-item">
					<strong>Name: </strong>{{ $menu->name }}
				</li>
				<li class="list-group-item">
					<strong>Display Name: </strong>{{ $menu->display_name }}
				</li>
				<li class="list-group-item">
					<strong>Assigned to Roles: </strong>
					<br>
					@foreach ($menu->roles as $role)
						<span class="label label-success">{{ $role->display_name }}</span>
					@endforeach
				</li>
				<li class="list-group-item">
					<strong>Description: </strong>{{ $menu->description }}
				</li>
				<li class="list-group-item">
					<strong>Icon Class: </strong>{{ $menu->icon }} <i class="{{ $menu->icon }}"></i>
				</li>
			</ul>
			<a href="{{ route('admin.menus.edit', $menu->name) }}" class="btn btn-warning"> Edit </a>
			<hr>
			<a href="{{ route('admin.menus.index') }}" class=""> << Return to Menus List </a>
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@section('scripts')
	
@stop