@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'No Description'])

@section('content')
	<div class="container-fluid">
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
									<div class="form-group">
										<div class="col-sm-10 col-sm-offset-1">
											<form 
												action="{{ url('/admin/permissions', $permission->name) }}" 
												method="POST" class="" 
												id="delete-form-{{ $permission->id }}"
												onsubmit="submitForm(event, {{ $permission->id }})"
											>
												{!! csrf_field() !!} {!! method_field('DELETE') !!}
									
												<button type="submit" id="delete-permission" class="btn btn-danger btn-xs" name="deleteBtn">
													<i class="fa fa-btn fa-trash"></i> Remove
												</button>
											</form>
										</div>
									</div>
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
	<script>
		function submitForm(event, id) {
			event.preventDefault();
			if(confirm("are you sure?")) {
				event.target.submit();
			}
		}
	</script>
@stop

