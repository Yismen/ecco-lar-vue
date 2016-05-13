@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
		<div class="well row ">
				<h3 class="page-header">
					Menus Items List
					 (
						 <small>
						 	<a href="{{ route('menus.create') }}">
						 		<i class="fa fa-plus"></i>
						 	</a>
						 </small>
					 )
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
							<th class="col-xs-3">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($menus as $menu)
							<tr>
								<td>
									<a href="{{ route('menus.show', $menu->name) }}">{{ $menu->display_name }}</a>
								</td>
								<td>
									{{ $menu->description }}
								</td>
								<td>
									<a href="{{ route('menus.edit', $menu->name) }}" class="btn btn-warning" rel="tooltip" title="Edit" data-placement="left">
										<i class="fa fa-edit"></i>
									</a>
									{!! delete_button('menus.destroy', $menu->name, ['class'=>'btn btn-danger','label'=>'<i class="fa fa-trash"></i>']) !!}
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