@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
		<div class="well row ">
				<h3 class="page-header">
					Positions Items List
					 (
						 <small>
						 	<a href="{{ route('positions.create') }}">
						 		<i class="fa fa-plus"></i>
						 	</a>
						 </small>
					 )
				</h3>
			@if ($positions->isEmpty())
				<div class="bs-callout bs-callout-warning">
					<h1>No Positions has been added yet, please add one</h1>
				</div>
			@else
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>Position Name</th>
							<th class="col-xs-3">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($positions as $position)
							<tr>
								<td>
									<a href="{{ route('positions.show', $position->id) }}">{{ $position->name }}</a>
								</td>
								<td>
									<a href="{{ route('positions.edit', $position->id) }}" class="btn btn-warning" rel="tooltip" title="Edit" data-placement="left">
										Edit <i class="fa fa-edit"></i>
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