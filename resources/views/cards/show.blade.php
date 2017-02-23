@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Cards', 'page_description'=>'Details.'])

@section('content')
	@if ($card)
		<div class="container">
			<div class="box box-primary pad">
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
				<a href="{{ route('admin.cards.index') }}" class=""> 
					<< Cards List 
					<i class="fa fa-list"></i> 
				</a>
			</div>
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@section('scripts')
	
@stop