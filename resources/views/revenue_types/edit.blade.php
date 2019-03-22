@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Systems', 'page_description'=>'Edit a current system.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h4>
							Edit Revenue Type {{ $revenue_type->name }}
							<a href="{{ route('admin.revenue_types.admin') }}" class="pull-right">
								<i class="fa fa-list"></i> List
							</a>
						</h4>
					</div>
					{!! Form::model($system, ['route'=>['admin.systems.update', $system->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}
						<div class="box-body">
							@include('systems._form')
						</div>

						<div class="box-footer">
							<button type="submit" class="btn btn-warning">UPDATE</button>
						</div>
					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop