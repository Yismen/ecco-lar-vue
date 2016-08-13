@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Positions', 'page_description'=>'Positions list!'])

@section('content')
	<div class="container">
		<div class="box box-primary pad">
		
			<h3 class="page-header">
				Positions Items List 
			 	<a href="{{ route('admin.positions.create') }}">
			 		<i class="fa fa-plus"></i>
			 	</a>
			</h3>

			@if ($positions->isEmpty())
				<div class="bs-callout bs-callout-warning">
					<h1>No Positions has been added yet, please add one</h1>
				</div>
			@else
				<table class="table table-condensed table-striped">
					<thead>
						<tr>
							<th>Position Name</th>
							<th>Department</th>
							<th class="col-xs-3">								 
								<a href="{{ route('admin.positions.create') }}">
									Add 
							 		<i class="fa fa-plus"></i>
							 	</a>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($positions as $position)
							<tr>
								<td>
									<a href="{{ route('admin.positions.show', $position->id) }}">{{ $position->name }}</a>
								</td>

								<td>
									<a href="{{ route('admin.departments.show', $position->departments->id) }}">{{ $position->departments->department }}</a>
								</td>
								<td>
									<a href="{{ route('admin.positions.edit', $position->id) }}" rel="tooltip" title="Edit" data-placement="left">
										<i class="fa fa-pencil"></i>
									</a>
									{{-- {!! delete_button('positions.destroy', $position->id, ['class'=>'btn btn-danger','label'=>'<i class="fa fa-trash"></i>']) !!} --}}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				{!! $positions->render() !!}
			@endif
		</div>
	</div>
@stop

@section('scripts')
	
@stop