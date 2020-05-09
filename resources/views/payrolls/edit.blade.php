@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'No Description'])

@section('content')
	<div class="container-fluid">
		<div class="box box-primary pad">
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						Edit Payment - [{{ $payment->payment_type }}]
						<a href="{{ route('admin.payments.index') }}" class="pull-right">
							<i class="fa fa-arrow-circle-left"></i> 
							Back
						</a>
					</h3>
				</div>
				<div class="panel-body">
					<div class="col-sm-6 col-sm-offset-3">
						{!! Form::model($payment, ['route'=>['admin.payments.update', $payment->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}
							@include('payments._form')

							<div class="form-group">
								<div class="col-sm-10 col-sm-offset-2">
									<button type="submit" class="btn btn-success">UPDATE</button>
									<button type="reset" class="btn btn-default">Cancel</button>
								</div>
							</div>

						{!! Form::close() !!}

						<form action="{{ url('/admin/payments', $payment->id) }}" method="POST" class="" style="display: inline-block;">
						    {!! csrf_field() !!}
						    {!! method_field('DELETE') !!}
						
						    <button type="submit" id="delete-payment" class="btn btn-danger"  name="deleteBtn">
						        <i class="fa fa-btn fa-trash"></i> DELETE
						    </button>
						</form>
					</div>
					
				</div>
			</div>
			

			{{-- // errors --}}
		</div>

	</div>
	
@stop

@push('scripts')

@endpush
