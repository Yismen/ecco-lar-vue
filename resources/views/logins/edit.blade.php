@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Logins', 'page_description'=>'Edit a login.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h4>
							Edit Login {{ $login->login }}
							<a href="{{ route('admin.logins.index') }}" class="pull-right small"><i class="fa fa-home"></i> Back to List</a>

						</h4>
					</div>
					{!! Form::model($login, ['route'=>['admin.logins.update', $login->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}	
					
						<div class="box-body">
							@include('logins._form')
						</div>

						<div class="box-footer">
							<div class="col-sm-10 col-sm-offset-2">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Update</button>		
								</div>			
							</div>
						</div>
					
					{!! Form::close() !!}
					
					<div class="box-footer">
						<form action="{{ url('/admin/logins', $login->id) }}" method="POST" class="" style="display: inline-block;">
							{!! csrf_field() !!}
							{!! method_field('DELETE') !!}
						
							<button type="submit" id="delete-login" class="btn btn-danger"  name="deleteBtn">
								<i class="fa fa-btn fa-trash"></i> Delete
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection