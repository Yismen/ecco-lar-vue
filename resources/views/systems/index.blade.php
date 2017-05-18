@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Systems for Logins', 'page_description'=>'Manage the systems available in order to save the users logins.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">

					<h3 class="page-header">
				 		Systems
					 	<a href="{{ route('admin.systems.create') }}">
					 		<i class="fa fa-plus"></i>
					 	</a>
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
											<a href="{{ route('admin.systems.show', $system->id) }}">{{ ucwords(trim($system->name ))}}</a>
										</td>
										<td>
											<a href="{{ route('admin.systems.edit', $system->id) }}" class="">
												Edit <i class="fa fa-edit"></i>
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
		</div>
	</div>
@endsection
@section('scripts')

@stop