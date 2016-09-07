@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="container">
		<div class="box box-primary pad">
				<h3 class="page-header">
					Permissions Items List
				 	<a href="{{ route('admin.permissions.create') }}" class="pull-right">
				 		<i class="fa fa-plus"></i>
				 	</a>
				</h3>
			@if ($permissions->isEmpty())
				<div class="bs-callout bs-callout-warning">
					<h1>No permissions has been added yet, please add one</h1>
				</div>
			@else
				<table class="table table-condensed table-hover table-striped">
					<thead>
						<tr>
							<th>Permission Item</th>
							<th>Description</th>
							<th class="col-xs-3">
								<a href="{{ route('admin.permissions.create') }}">
							 		<i class="fa fa-plus"></i> Add
							 	</a>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($permissions as $permission)
							<tr>
								<td>
									<a href="{{ route('admin.permissions.show', $permission->name) }}">{{ $permission->display_name }}</a>
								</td>
								<td>
									{{ $permission->description }}
								</td>
								<td>
									<a href="{{ route('admin.permissions.edit', $permission->name) }}" class="">
										<i class="fa fa-pencil"></i>
									</a>
									{{-- {!! delete_button('admin.permissions.destroy', $permission->name, ['class'=>'btn btn-danger','label'=>'<i class="fa fa-trash"></i>']) !!} --}}
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

