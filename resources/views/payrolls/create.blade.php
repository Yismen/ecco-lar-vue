@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'No Description'])

@section('content')
	<div class="container-fluid">
		<div class="box box-primary pad">
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						Adding a New Payment
						<a href="{{ route('admin.payments.index') }}" class="pull-right">
							<i class="fa fa-arrow-circle-left"></i> 
							Back
						</a>
					</h3>
				</div>
				<div class="panel-body">
					<div class="col-sm-6 col-sm-offset-3">
						{!! Form::open(['route'=>['admin.payments.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}
							@include('payments._form')

							<div class="form-group">
								<div class="col-sm-10 col-sm-offset-2">
									<button type="submit" class="btn btn-primary">Create</button>
									<button type="reset" class="btn btn-default">Reset Form</button>
								</div>
							</div>

							<div class="form-group">
								<a href="/admin/payments">
									Return to list. <i class="fa fa-list"></i>
								</a>
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
