
@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Logins', 'page_description'=>'Create a new login.'])

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad big-box">
					<div class="row">
						{!! Form::open(['route'=>['admin.logins.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
							<div class="form-group">
								<legend>New Login</legend>
							</div>
						
							@include('logins._form')

							<div class="col-sm-10 col-sm-offset-1">
								<button type="submit" class="btn btn-primary form-control">Create</button>
								<hr>	
								<a href="{{ route('admin.logins.index') }}"><< Return to Logins List</a>
							</div>
						
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection