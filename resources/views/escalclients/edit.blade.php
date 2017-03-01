@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Escalations Clients', 'page_description'=>'Edit values for Escalations Clients!'])

@section('content')
	<div class="container">
		<div class="row box box-primary pad">
			{!! Form::model($escalclient, ['route'=>['admin.escalations_clients.update',$escalclient->slug], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}

				<legend>Edit Escalations Client</legend>
			
				@include('escalclients._form')

				<div class="form-group">
					<div class="col-sm-8 col-sm-offset-2">
						<button class="btn btn-primary" type="submit">UPDATE</button>
						<button class="btn btn-default" type="reset">Reset Form</button>	
					</div>
				</div>
				
			{!! Form::close() !!}
			
			<hr>
			<form action="{{ url('/admin/escalations_clients', $escalclient->slug) }}" method="POST" class="" style="display: inline-block;">	
			    {!! csrf_field() !!}
			    {!! method_field('DELETE') !!}
			
			    <button type="submit" id="delete-escalations_client" class="btn btn-danger"  name="deleteBtn">
			        <i class="fa fa-btn fa-trash"></i> Delete
			    </button>

			</form>
			
			<hr>
			<div class="form-group">
				<div class="col-sm-12">
					<a href="/admin/escalations_clients">
						<i class="fa fa-list"></i> Back to the List.
					</a>
				</div>
			</div>
			
		</div>

	</div>
	
@stop

@section('scripts')

@stop
