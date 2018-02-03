@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Escalations Records', 'page_description'=>'Edit values for Escalations Records!'])

@section('content')
	<div class="container-fluid">	
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary">

				<div class="box-header with-border"><h4>Edit Escalations Record {{ $escalations_record->tracking }}</h4></div>
				{!! Form::model($escalations_record, ['route'=>['admin.escalations_records.update',$escalations_record->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}
					<div class="box-body">
					
						@include('escalations_records._form')

						<div class="box-footer with-border">
							<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
									<button class="btn btn-primary" type="submit">UPDATE</button>
									<button class="btn btn-default" type="reset">Reset Form</button>	
								</div>
							</div>
						</div>
						
					</div>
				{!! Form::close() !!}
				<div class="box-footer with-border">
					<form action="{{ url('/admin/escalations_records', $escalations_record->id) }}" method="POST" class="" style="display: inline-block;">	
						{!! csrf_field() !!}
						{!! method_field('DELETE') !!}
					
						<button type="submit" id="delete-escalations_client" class="btn btn-danger"  name="deleteBtn">
							<i class="fa fa-btn fa-trash"></i> Delete
						</button>

					</form>
				</div>
				
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
	
@stop

@section('scripts')

@stop
