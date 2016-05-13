@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	@if ($card)
		<div class="col-sm-8 col-sm-offset-2 well row">
			<table class="table table-condensed table-hover">
				<tbody>
					<tr>
						<th>Card: </th>
						<td>{{ $card->card }}</td>
					</tr>
					{{-- /. Login --}}
					<tr>
						<th>Employee's Name: </th>
						<td>
							<a href="{{ route('admin.employees.show', $card->employee->id) }}">{{ $card->employee->fullName }}</a>				
						</td>
					</tr>
					{{-- /. Employee --}}

				</tbody>
			</table>
			<a href="{{ route('admin.cards.edit', $card->card) }}" class="btn btn-warning"> Edit </a>
			<hr>
			<a href="{{ route('admin.cards.index') }}" class=""> << Return to Cards List </a>
			
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@section('scripts')
	
@stop