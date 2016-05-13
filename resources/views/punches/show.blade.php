@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	@if ($punch)
		<div class="col-sm-8 col-sm-offset-2 well row">
			<table class="table table-condensed table-hover">
				<tbody>
					<tr>
						<th>Punch: </th>
						<td>{{ $punch->punch }}</td>
					</tr>
					{{-- /. Login --}}
					<tr>
						<th>Employee's Name: </th>
						<td>
							<a href="{{ route('admin.employees.show', $punch->employee->id) }}">{{ $punch->employee->fullName }}</a>				
						</td>
					</tr>
					{{-- /. Employee --}}

				</tbody>
			</table>
			<a href="{{ route('punches.edit', $punch->punch) }}" class="btn btn-warning"> Edit </a>
			<hr>
			<a href="{{ route('punches.index') }}" class=""> << Return to Cards List </a>
			
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@section('scripts')
	
@stop