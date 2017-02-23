@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="container">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary pad">
				<h3 class="page-header">
					Payments Items List
						 	<a href="{{ route('admin.payments.create') }}" class="pull-right btn btn-primary">
						 		<i class="fa fa-plus"></i> Create
						 	</a>
				</h3>
				@if ($payments->isEmpty())
					<div class="bs-callout bs-callout-warning">
						<h1>No Payments has been added yet, please add one</h1>
					</div>
				@else
					<table class="table table-condensed table-hover">
						<thead>
							<tr>
								<th>Payment Name</th>
								<th class="col-xs-3">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($payments as $payment)
								<tr>
									<td>
										<a href="{{ route('admin.payments.show', $payment->id) }}">{{ $payment->payment_type }}</a>
									</td>
									<td>
										<a href="{{ route('admin.payments.edit', $payment->id) }}" class="" rel="tooltip" title="Edit" data-placement="left">
											Edit <i class="fa fa-edit"></i>
										</a>
										{{-- {!! delete_button('payments.destroy', $payment->id, ['class'=>'btn btn-danger','label'=>'<i class="fa fa-trash"></i>']) !!} --}}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{!! $payments->render() !!}
				@endif
			</div>
		</div>
	</div>
@stop

@section('scripts')
	
@stop