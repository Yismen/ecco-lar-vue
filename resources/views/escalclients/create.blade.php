@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Escalations Clients', 'page_description'=>'Add a new Escalations Client!'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-4">
				<div class="box box-primary pad">		
					@include('escalations_admin.partials.links')
				</div>
			</div>
			<div class="col-sm-8">
				<div class="box box-primary pad">
					
					{!! Form::open(['route'=>['admin.escalations_clients.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}		
						<legend>Create a New Escalations Client</legend>
					
						@include('escalclients._form')

						<div class="form-group">
							<div class="col-sm-8 col-sm-offset-2">
								<button class="btn btn-primary" type="submit">SAVE</button>
								<button class="btn btn-default" type="reset">Reset Form</button>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<a href="/admin/escalations_clients">
									<i class="fa fa-arrow-left"> Back to List</i>
								</a>
							</div>
						</div>
					
					{!! Form::close() !!}
					
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')

@endpush