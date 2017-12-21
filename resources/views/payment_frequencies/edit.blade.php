@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'No Description'])

@section('content')
	<div class="container-fluid">
		<div class="box box-primary pad">
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						Edit Payment - [{{ $payment_frequency->name }}]
						<a href="{{ route('admin.payment_frequencies.index') }}" class="pull-right">
							<i class="fa fa-arrow-circle-left"></i> 
							Back
						</a>
					</h3>
				</div>
				<div class="panel-body">
					<div class="col-sm-6 col-sm-offset-3">
						{!! Form::model($payment_frequency, ['route'=>['admin.payment_frequencies.update', $payment_frequency->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}
							@include('payment_frequencies._form')

							<div class="form-group">
								<div class="col-sm-10 col-sm-offset-2">
									<button type="submit" class="btn btn-success">UPDATE</button>
									<button type="reset" class="btn btn-default">Cancel</button>
								</div>
							</div>

						{!! Form::close() !!}

						<form action="{{ url('/admin/payment_frequencies', $payment_frequency->id) }}" method="POST" class="" style="display: inline-block;">
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

@section('scripts')

@stop
