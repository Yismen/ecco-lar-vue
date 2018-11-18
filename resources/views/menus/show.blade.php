@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'No Description'])

@section('content')
	@if ($menu)
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-info">
					<div class="box-header">
						<h4>
							Menu Details [{{ personName($menu->name) }}]
							<a href="{{ route('admin.menus.index') }}" class="pull-right">
								<i class="fa fa-list"></i> 
								Menus List
							</a>
						</h4>
					</div>

					<div class="box body pad">
						<ul class="list-group">
							<li class="list-group-item">
								<strong>Route: </strong><a href="{{ url($menu->name) }}">{{ $menu->name }}</a>
							</li>
							<li class="list-group-item">
								<strong>Display Name: </strong>{{ $menu->display_name }}
							</li>
							<li class="list-group-item">
								<strong>Assigned to Roles: </strong>
								<br>
								@foreach ($menu->roles as $role)
									<span class="label label-info">{{ $role->name }}</span>
								@endforeach
							</li>
							<li class="list-group-item">
								<strong>Description: </strong>{{ $menu->description }}
							</li>
							<li class="list-group-item">
								<strong>Icon Class: </strong>{{ $menu->icon }} <i class="{{ $menu->icon }}"></i>
							</li>
						</ul>
						<a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-warning"> Edit </a>
					</div>
				</div>
			</div>
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@section('scripts')
	
@stop