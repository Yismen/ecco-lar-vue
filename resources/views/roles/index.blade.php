@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Roles', 'page_description'=>'A list of the roles defined in the app.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm--10 col-sm-offset-1">
				<div class="box box-primary pad">
					<h3 class="page-header">
						Roles List 
					 	<a href="{{ route('admin.roles.create') }}">
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
									<th class="col-xs-2">
										<a href="{{ route('admin.roles.create') }}">
									 		Add <i class="fa fa-plus"></i>
									 	</a>
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($roles as $role)
									<tr>
										<td>
											<a href="{{ route('admin.roles.show', $role->name) }}">{{ $role->display_name }}</a>
										</td>
										<td>
											{{ $role->description }}
										</td>
										<td>
											<a href="{{ route('admin.roles.edit', $role->name) }}" class="">
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
		</div>
	</div>
@endsection

@section('scripts')
	
@stop