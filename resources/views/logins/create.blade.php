
@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Logins', 'page_description'=>'Create a new login.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h4>
							New Login
							<a href="{{ route('admin.logins.index') }}" class="pull-right small"><i class="fa fa-home"></i> Back to List</a>
						</h4>
					</div>
					{!! Form::open(['route'=>['admin.logins.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
											
						<div class="box-body">
							@include('logins._form')
						</div>

						<div class="box-footer">		
							<div class="col-sm-8 col-sm-offset-2">
								<div class="form-group">								
									<button type="submit" class="btn btn-primary form-control">Create</button>
								</div>
							</div>
						</div>
					
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection