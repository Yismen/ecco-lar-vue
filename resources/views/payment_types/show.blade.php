@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Payments', 'page_description'=>'Details for Payment Type'])

@section('content')
	<div class="container-fluid">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary pad">
				<div class="small-box bg-purple">
					<div class="inner">
						<p>Payment Type:</p>
						<h3>{{ $payment_type->name }}</h3>

					</div>
					<div class="icon">
						<i class="fa fa-flag"></i>
					</div>
					<a href="{{ route('admin.payment_types.edit', $payment_type->id) }}" class="small-box-footer">
						Edit info <i class="fa fa-pencil"></i>
					</a>
				</div>
				<hr>
				<a href="{{ route('admin.payment_types.index') }}" class="">
					Payment Type List 
					<i class="fa fa-list"></i>
				</a>            
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop