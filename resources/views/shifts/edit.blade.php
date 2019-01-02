@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Shifts', 'page_description'=>'Edit shift item'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-warning">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<div class="box-header with-border">
								<h4>Edit {{ $shift->name }}
									<a href="{{ route('admin.shifts.index') }}" class="pull-right">
										<i class="fa fa-home"></i>
                                    	Return to List
									</a>
								</h4>
							</div>

							{!! Form::model($shift, ['route'=>['admin.shifts.update', $shift->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}
								<div class="box-body">
									@include('shifts._form')
								</div>

								<div class="box-footer">

									<div class="col-sm-6 col-sm-offset-2">
										<button type="submit" class="btn btn-warning">UPDATE</button>
									</div>
								</div>

							{!! Form::close() !!}

							<div class="box-footer">
								<delete-request-button
								    url="{{ route('admin.shifts.destroy', $shift->id) }}"
								    redirect-url="{{ route('admin.shifts.index') }}"
								></delete-request-button>
							</div>


						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop
