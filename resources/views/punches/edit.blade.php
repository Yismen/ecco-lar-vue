@push('scripts')

@stop

@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Punches', 'page_description'=>'Edit Punch ID.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					{!! Form::model($punch, ['route'=>['admin.punches.update', $punch->punch], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}
							<legend>Edit Punch {{ $punch->punch }}, {{ $punch->employee->fullName }}</legend>

							@include('punches._form')

							<div class="form-group">
								<div class="col-sm-6 col-sm-offset-2">
									<button type="submit" class="btn btn-primary">Update</button>
									<button type="reset" class="btn btn-default">Reset Form</button>
								</div>
							</div>


						{!! Form::close() !!}

						<form action="{{ url('/admin/punches', $punch->punch) }}" method="POST" class="" style="display: inline-block;">
						    {!! csrf_field() !!}
						    {!! method_field('DELETE') !!}

						    <button type="submit" id="delete-punch" class="btn btn-danger"  name="deleteBtn">
						        <i class="fa fa-btn fa-trash"></i> Delete
						    </button>
						</form>

					    <div class="form-group col-sm-offset-4">
					    	<a href="/admin/punches" class="push-right">
					    		Back to the list
						    	<i class="fa fa-list"></i>
						    </a>
					    </div>

				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')

@endpush
