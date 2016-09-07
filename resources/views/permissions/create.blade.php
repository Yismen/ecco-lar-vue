@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Permissions', 'page_description'=>'Create a new permission for your app.'])

@section('content')
	<div class="container">
		<div class="box box-primary pad">
			<div class="row">
				<div class="col-sm-12">
					<div class="page-header">New Permission</div>
					
					{!! Form::open(['route'=>['admin.permissions.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}
					
						@include('permissions._form')

						<div class="col-sm-10 col-sm-offset-2">
							<button type="submit" class="btn btn-primary form-control">Create</button>
							<br><br>
							<a href="{{ route('admin.permissions.index') }}"><< Return to Permissions List</a>
						</div>
					
					{!! Form::close() !!}

				</div>
			</div>
			{{-- // errors --}}
		</div>
		
	</div>
@stop

@section('scripts')
	
@stop