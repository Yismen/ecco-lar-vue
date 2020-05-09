@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Escalations Records', 'page_description'=>'Edit values for Escalations Records!'])

@section('content')
	<div class="container-fluid">	
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="row box box-primary pad">

					{!! Form::model($escalations_record, ['route'=>['admin.escalations_records.update',$escalations_record->tracking], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}

						<legend>Edit Escalations Record {{ $escalations_record->tracking }}</legend>
					
						@include('escalations_records._form')

						<div class="form-group">
							<div class="col-sm-8 col-sm-offset-2">
								<button class="btn btn-primary" type="submit">UPDATE</button>
								<button class="btn btn-default" type="reset">Reset Form</button>	
							</div>
						</div>
						
					{!! Form::close() !!}
					
					<hr>
					<form action="{{ url('/admin/escalations_records', $escalations_record->tracking) }}" method="POST" class="" style="display: inline-block;">	
					    {!! csrf_field() !!}
					    {!! method_field('DELETE') !!}
					
					    <button type="submit" id="delete-escalations_client" class="btn btn-danger"  name="deleteBtn">
					        <i class="fa fa-btn fa-trash"></i> Delete
					    </button>

					</form>
					
					<hr>
					<div class="form-group">
						<div class="col-sm-12">
							<a href="/admin/escalations_records/create">
								<i class="fa fa-list"></i> Back to the List.
							</a>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	
@stop

@push('scripts')

@endpush
