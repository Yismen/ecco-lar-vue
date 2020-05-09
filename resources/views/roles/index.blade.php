@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Roles', 'page_description'=>'A list of the roles defined in the app.'])

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="box box-primary">
					<div class="box-header">
						<h4>Roles List
							<a href="{{ route('admin.roles.create') }}" class="pull-right">
								<i class="fa fa-plus"></i> Add Role
							</a>
						</h4>
					</div>

					<div class="box-body">
						@if ($roles->isEmpty())
							<div class="bs-callout bs-callout-warning">
								<h1>No Roles has been added yet, please add one</h1>
							</div>
						@else
							<table class="table table-condensed table-hover">
								<thead>
									<tr>
										<th>Name</th>
										<th>Guard</th>
										<th class="col-xs-2">
											Actions
										</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($roles as $role)
										<tr>
											<td>
												<a href="{{ route('admin.roles.show', $role->name) }}">{{ ucwords(trim(str_replace(['-', '_'], ' ', $role->name))) }}</a>
											</td>
											<td>
												{{ $role->guard_name }}
											</td>
											<td>
												<a href="{{ route('admin.roles.edit', $role->name) }}" class="text-warning">
													<i class="fa fa-pencil"></i> Edit
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
	</div>
@endsection

@push('scripts')

@endpush
