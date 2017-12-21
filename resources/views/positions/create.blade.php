@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Positions', 'page_description'=>'Create a new position.'])

@section('content')
	<div class="container-fluid">
		<div class="col-sm-10 col-sm-offset-1">
			<div class="box box-success">
				<div class="box-header with-border">
					<h4>
						Adding a New Position
						<a href="{{ route('admin.positions.index') }}" class="pull-right" title="Back to the list"><i class="fa fa-list"></i></a>
					</h4>
				</div>
				<div class="box-body">
					{!! Form::open(['route'=>['admin.positions.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}

							@include('positions._form')

							<div class="col-sm-10 col-sm-offset-2">
								<button type="submit" class="btn btn-success form-control">CREATE</button>
							</div>

						{!! Form::close() !!}
				</div>

				{{-- // errors --}}
			</div>
		</div>

	</div>
	
@stop

@section('scripts')

@stop
