@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Cards', 'page_description'=>'Cards list.'])

@section('content')
	<div class="container">
		<div class="box box-primary pad">
			<h3 class="page-header">
				Cards Items List 
			 	<a href="{{ route('admin.cards.create') }}">
			 		<i class="fa fa-plus"></i>
			 	</a>						 
			</h3>

			@if ($cards->isEmpty())
				<div class="bs-callout bs-callout-warning">
					<h1>No Cards has been added yet, please add one</h1>
				</div>
			@else
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>Card</th>
							<th>Employee</th>
							<th class="col-xs-3">
								<a href="{{ route('admin.cards.create') }}">
							 		<i class="fa fa-plus"></i>
							 	</a>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($cards as $card)
							<tr>
								<td>
									<a href="{{ route('admin.cards.show', $card->card) }}">{{ $card->card }}</a>
								</td>
								<td>
									<a href="{{ route('admin.employees.show', $card->employee->id) }}">{{ $card->employee->fullName }}</a>
								</td>
								<td>
									<a href="{{ route('admin.cards.edit', $card->card) }}" class="">
										Edit <i class="fa fa-pencil"></i>
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="text-center">
					{{ $cards->render() }}
				</div>
			@endif
		</div>
	</div>
@stop

@section('scripts')
	
@stop