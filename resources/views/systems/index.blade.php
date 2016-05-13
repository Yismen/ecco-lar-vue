@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class=" col-sm-12">
		<div class="well row ">
				<h3 class="page-header">
					Systems Items List
					 (
						 <small>
						 	<a href="{{ route('systems.create') }}">
						 		<i class="fa fa-plus"></i>
						 	</a>
						 </small>
					 )
				</h3>
			@if ($systems->isEmpty())
				<div class="bs-callout bs-callout-warning">
					<h1>No Systems has been added yet, please add one</h1>
				</div>
			@else
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>System Item</th>
							<th class="col-xs-3">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($systems as $system)
							<tr>
								<td>
									<a href="{{ route('systems.show', $system->id) }}">{{ ucwords(trim($system->name ))}}</a>
								</td>
								<td>
									<a href="{{ route('systems.edit', $system->id) }}" class="btn btn-warning">
										<i class="fa fa-edit"></i>
									</a>
									{{-- {!! delete_button('systems.destroy', $system->id, ['class'=>'btn btn-danger','label'=>'<i class="fa fa-trash"></i>']) !!}  --}}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="text-center">
					{{ $systems->render() }}
				</div>
			@endif
		</div>
	</div>
@stop

@section('scripts')
	
@stop