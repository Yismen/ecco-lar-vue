@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Revenue Types for Logins', 'page_description'=>'Manage the revenue_types available in order to save the users logins.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">

					<div class="box-header">
						<h4>
					 		Revenue Types
						 	<a href="{{ route('admin.revenue_types.create') }}">
						 		<i class="fa fa-plus"></i>
						 	</a>
						</h4>
					</div>

					<div class="box-body">
						@if ($revenue_types->isEmpty())
							<div class="bs-callout bs-callout-warning">
								<h1>No Revenue Types has been added yet, please add one</h1>
							</div>
						@else
							<table class="table table-condensed table-hover">
								<thead>
									<tr>
										<th>Revenue Types Item</th>
										<th class="col-xs-3">Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($revenue_types as $revenue_type)
										<tr>
											<td>
												<a href="{{ route('admin.revenue_types.show', $revenue_type->id) }}">{{ ucwords(trim($revenue_type->name ))}}</a>
											</td>
											<td>
												<a href="{{ route('admin.revenue_types.edit', $revenue_type->id) }}" class="">
													Edit <i class="fa fa-edit"></i>
												</a>
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
	</div>
@endsection
@section('scripts')

@stop