@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'No Description'])

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="box box-primary pad">
					<h3 class="page-header">
						Permissions Items List
						<a href="{{ route('admin.permissions.create') }}" class="pull-right">
							<i class="fa fa-plus"></i>
							New Permission
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
									<th>Resource</th>
									<th>Name</th>
									<th>Guard</th>
									<th class="col-xs-3">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($permissions as $permission)
									<tr>
										<td>{{ ucwords( str_replace(['_', '-'], ' ', $permission->resource) ) }}</td>
										<td>
											<a href="{{ route('admin.permissions.show', $permission->name) }}">
												{{ ucwords( str_replace(['_', '-'], ' ', $permission->name) ) }}
											</a>
										</td>
										<td>
											{{ $permission->guard_name }}
										</td>
										<td>
											<a href="{{ route('admin.permissions.edit', $permission->name) }}" class="btn btn-warning btn-xs">
												<i class="fa fa-pencil"></i>
												Edit
											</a>
											<form
												action="{{ url('/admin/permissions', $permission->name) }}"
												method="POST"
												style="display:inline-block;"
												id="delete-form-{{ $permission->id }}"
												onsubmit="submitForm(event, {{ $permission->id }})"
											>
												{!! csrf_field() !!} {!! method_field('DELETE') !!}

												<button type="submit" id="delete-permission" class="btn btn-danger btn-xs" name="deleteBtn">
													<i class="fa fa-btn fa-trash"></i> Remove
												</button>
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@endif
				</div>
			</div>
		</div>

	</div>
@stop

@section('scripts')
	<script>
		function submitForm(event, id) {
			event.preventDefault();
			if(confirm("are you sure?")) {
				event.target.submit();
			}
		}
	</script>
@stop

