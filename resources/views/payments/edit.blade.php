@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="container">
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
						{!! Form::model($payment, ['route'=>['admin.payments.store'], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}
							@include('payments._form')

							<div class="col-sm-10 col-sm-offset-2">
								<button type="reset" class="btn btn-default">Cancel</button>
								<button type="submit" class="btn btn-success">UPDATE</button>
							</div>

						{!! Form::close() !!}
					</div>
					
				</div>
			</div>
			

			{{-- // errors --}}
		</div>

	</div>
	
@stop

@section('scripts')

@stop
