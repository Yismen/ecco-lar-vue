@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Punches', 'page_description'=>'Details for punches.'])

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
			<a href="{{ route('admin.punches.edit', $punch->punch) }}" class="btn btn-warning"> Edit </a>
			<hr>
			<a href="{{ route('admin.punches.index') }}" class="">
				Punches List 
				<i class="fa fa-list"></i>
			</a>
			
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@push('scripts')
	
@endpush