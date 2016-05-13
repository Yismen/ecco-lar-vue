@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="container">
		
		<div class="col-sm-8 col-sm-offset-1">
		<div class="row ">
			<br>
			<div class="jumbotron">				
				{!! Form::open(['route'=>['departments.store'], 'class'=>'form-horizontal', 'role'=>'form']) !!}		
					<div class="form-group">
						<legend>Create A New HH RR Department</legend>
					</div>						
				
					@include('departments._form')				
				
				{!! Form::close() !!}

				@if ($departments->total() == 0)
					<h3>There are not departments created</h3>
				@else
					<table class="table table-condensed table-hover">
						<thead>
							<tr>
								<th>Department Name</th>
								<th colspan="2">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ( $departments as $department)
								<tr>
									<td>
										{{ $department->department }}
									</td>
									<td>
										{!! link_to_route('departments.edit', 'Edit', $department->id, ['class'=>'btn btn-warning']) !!}
									</td>
									<td>
										{!! delete_form(['departments.destroy', $department->id]) !!}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@endif
				{{-- Pagination Links --}}
				{!! $departments->render() !!}
				{{-- /. Pagination Links --}}
			</div>
		</div>
	</div>

	
	</div>
@stop

@section('scripts')
	
@stop