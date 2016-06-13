@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Roles', 'page_description'=>'Roles list'])

@section('content')
	<div class=" col-sm-12">
		<div class="well row ">
				<h3 class="page-header">
					Roles List 
				 	<a href="{{ route('roles.create') }}">
				 		<i class="fa fa-plus"></i>
				 	</a>

				</h3>
			@if ($roles->isEmpty())
				<div class="bs-callout bs-callout-warning">
					<h1>No Roles has been added yet, please add one</h1>
				</div>
			@else
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>Role Item</th>
							<th>Description</th>
							<th class="col-xs-3">
								<a href="{{ route('roles.create') }}">
							 		Add <i class="fa fa-plus"></i>
							 	</a>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($roles as $role)
							<tr>
								<td>
									<a href="{{ route('roles.show', $role->name) }}">{{ $role->display_name }}</a>
								</td>
								<td>
									{{ $role->description }}
								</td>
								<td>
									<a href="{{ route('roles.edit', $role->name) }}" class="">
										<i class="fa fa-pencil"></i>
									</a>
									{{-- {!! delete_button('roles.destroy', $role->name, ['class'=>'btn btn-danger','label'=>'<i class="fa fa-trash"></i>']) !!}
									 --}}

								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="text-center">
					{{ $roles->render() }}
				</div>
			@endif
		</div>
	</div>
@stop

@section('scripts')
	
@stop