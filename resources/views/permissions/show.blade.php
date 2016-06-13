@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	@if ($permission)
		<div class="container">
			<div class="box box-primary pad">
				<ul class="list-group">
					<li class="list-group-item">
						<strong>Name: </strong>{{ $permission->name }}
					</li>
					<li class="list-group-item">
						<strong>Display Name: </strong>{{ $permission->display_name }}
					</li>
					<li class="list-group-item">
						<strong>Assigned to Roles: </strong>
						<br>
						@foreach ($permission->roles as $role)
							<span class="label label-info">{{ $role->display_name }}</span>
						@endforeach
					</li>
					<li class="list-group-item">
						<strong>Description: </strong>{{ $permission->description }}
					</li>
				</ul>
				<a href="{{ route('admin.permissions.edit', $permission->name) }}" class="btn btn-warning"> Edit </a>
				{{-- {!! delete_button('permissions.destroy', $permission->name, ['class'=>"btn btn-danger", 'label' => 'Delete']) !!} --}}
				<hr>
				<a href="{{ route('admin.permissions.index') }}" class=""> << Return to Permissions List </a>
			</div>
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@section('scripts')
	
@stop