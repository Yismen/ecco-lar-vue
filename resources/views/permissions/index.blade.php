@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class=" col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
		<div class="well row ">
				<h3 class="page-header">
					Permissions Items List
					 (
						 <small>
						 	<a href="{{ route('permissions.create') }}">
						 		<i class="fa fa-plus"></i>
						 	</a>
						 </small>
					 )
				</h3>
			@if ($permissions->isEmpty())
				<div class="bs-callout bs-callout-warning">
					<h1>No permissions has been added yet, please add one</h1>
				</div>
			@else
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>Permission Item</th>
							<th>Description</th>
							<th class="col-xs-3">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($permissions as $permission)
							<tr>
								<td>
									<a href="{{ route('permissions.show', $permission->name) }}">{{ $permission->display_name }}</a>
								</td>
								<td>
									{{ $permission->description }}
								</td>
								<td>
									<a href="{{ route('permissions.edit', $permission->name) }}" class="btn btn-warning">
										<i class="fa fa-edit"></i>
									</a>
									{!! delete_button('permissions.destroy', $permission->name, ['class'=>'btn btn-danger','label'=>'<i class="fa fa-trash"></i>']) !!}
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