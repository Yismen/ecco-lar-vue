@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Menu Items', 'page_description'=>'Items to be displayed as part of the menus.'])

@section('content')
	<div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
		<div class="well row ">
				<h3 class="page-header">
					Menus Items List 
					
					 	<a href="{{ route('admin.menus.create') }}">
					 		<i class="fa fa-plus"></i>
					 	</a>
				</h3>
			@if ($menus->isEmpty())
				<div class="bs-callout bs-callout-warning">
					<h1>No Menus has been added yet, please add one</h1>
				</div>
			@else
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>Menu Item</th>
							<th>Description</th>
							<th class="col-xs-3">
								<a href="{{ route('admin.menus.create') }}">
							 		Add <i class="fa fa-plus"></i>
							 	</a>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($menus as $menu)
							<tr>
								<td>
									<a href="{{ route('admin.menus.show', $menu->name) }}">{{ $menu->display_name }}</a>
								</td>
								<td>
									{{ $menu->description }}
								</td>
								<td>
									<a href="{{ route('admin.menus.edit', $menu->name) }}" class="" rel="tooltip" title="Edit" data-placement="left">
										<i class="fa fa-pencil"></i>
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
	</div>
@stop

@section('scripts')
	
@stop