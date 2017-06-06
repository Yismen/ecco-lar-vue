@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Supervisors', 'page_description'=>'Edit supervisor.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
						<div class="box-header with-border">Edit Supervisor {{ $supervisor->name }}</div>

						<div class="box-body">
							{!! Form::model($supervisor, ['route'=>['admin.supervisors.update', $supervisor->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}
							@include('supervisors._form')
						</div>

						<div class="box-footer">
							<div class="col-sm-12">
								<div class="form-group">
									<button type="submit" class="btn btn-success">UPDATE</button>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-12">
									<a href="{{ route('admin.supervisors.index') }}"><< Return to Supervisors List</a>
								</div>
							</div>
							{!! Form::close() !!}
							
							<form action="{{ url('/admin/supervisors', $supervisor->id) }}" method="POST" class="" >
							    {!! csrf_field() !!}
							    {!! method_field('DELETE') !!}
							
							    <button type="submit" id="delete-supervisor" class="btn btn-danger"  name="deleteBtn">
							        <i class="fa fa-btn fa-trash"></i> DELETE
							    </button>
							</form>
						</div>

						</div>
					</div>
				</div>
			</div>

			{{-- // errors --}}
		</div>

	</div>
	
@stop

@section('scripts')

@stop
