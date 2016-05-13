@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	@if ($production)
		<div class="col-sm-8 col-sm-offset-2 well row">
			<div class="row">
				<div class="col-xs-2">
					<img src="{{ asset($production->employee->photo) }}" alt="" class="img-responsive img-circle center-block img-thumbnail text-left" width="100px">
				</div>

				<div class="col-xs-10">
					<h1>{{ $production->employee->fullName }}</h1>
				</div>
			</div>

			<hr>


			<table class="table table-condensed table-hover">
				<tbody>
					<tr>
						<th>Card: </th>
						{{-- <td>{{ $production->card }}</td> --}}
					</tr>
					{{-- /. Login --}}
					<tr>
						<th>Employee's Name: </th>
						<td>
							<a href="{{ route('admin.employees.show', $production->employee->id) }}">{{ $production->employee->fullName }}</a>				
						</td>
					</tr>
					{{-- /. Employee --}}

				</tbody>
			</table>
			<a href="{{ route('productions.edit', $production->id) }}" class="btn btn-warning"> Edit </a>
			<hr>
			<a href="{{ route('productions.index') }}" class=""> << Return to Productions List </a>
			
		</div>
		{{ $production }}
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@section('scripts')
	
@stop