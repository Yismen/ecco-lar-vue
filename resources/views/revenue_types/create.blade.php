@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Revenue Types for Logins', 'page_description'=>'Create a new revenue_type.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h4>
							New Revenue Type
							<a href="{{ route('admin.revenue_types.create') }}" class="pull-rght">
								<i class="fa fa-plus"></i> Add
							</a>
						</h4>
					</div>
					{{-- .box-header --}}
					{!! Form::open(['route'=>['admin.revenue_types.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}
						<div class="box-body">
							@include('revenue_types._form')
						</div>
						{{-- .box-body --}}
						<div class="box-footer">
							<div class="col-sm-10 col-sm-offset-2">
								<button type="submit" class="btn btn-primary">CREATE</button>
							</div>
						</div>
					{!! Form::close() !!}


				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop