@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Payments Type', 'page_description'=>'Details for payments.'])

@section('content')
	@if ($payment)
		<div class="col-sm-8 col-sm-offset-2 well row">
			<table class="table table-condensed table-hover">
				<tbody>
					<tr>
						<th>Payment: </th>
						<td>{{ $payment->payment_type }}</td>
					</tr>
					{{-- /. Login --}}

				</tbody>
			</table>
			<a href="{{ route('admin.payments.edit', $payment->payment) }}" class="btn btn-warning"> Edit </a>
			<hr>
			<a href="{{ route('admin.payments.index') }}" class="">
				Payment Type List 
				<i class="fa fa-list"></i>
			</a>
			
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@section('scripts')
	
@stop