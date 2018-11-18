@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Menu Items', 'page_description'=>'Control menu items'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">
								Menu Items
								<a href="{{ route('admin.menus.create') }}" class="pull-right">
							 		<i class="fa fa-plus"></i> 
							 		 Add Menu Item
							 	</a>
							</h3>
						</div>
						<div class="panel-body">
							<table class="table table-bordered table-condensed table-striped">
								<thead>
									<tr>
										<th>Name</th>
										<th>Route</th>
										<th>Description</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($menus as $menu)
										<tr>
											<td><a href="{{ route('admin.menus.show', $menu->id) }}">{{ $menu->display_name }}</a></td>
											<td>{{ $menu->name }}</td>
											<td>{{ $menu->description }}</td>
											<td>
												<a href="{{ route('admin.menus.edit', $menu->id) }}" class="text-warning">
													<i class="fa fa-pencil"></i> Edit
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
