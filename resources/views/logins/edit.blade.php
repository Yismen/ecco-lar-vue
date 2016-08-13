@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Logins', 'page_description'=>'Edit a login.'])

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad big-box">
					{!! Form::model($login, ['route'=>['admin.logins.update', $login->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}	
						<div class="form-group">
							<legend>Edit Login {{ $login->login }}</legend>
						</div>
					
						@include('logins._form')

						<div class="col-sm-10 col-sm-offset-2">
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Update</button>	
								<a href="{{ route('admin.logins.index') }}" class="btn btn-default">Cancel</a>	
							</div>			
						</div>
					
					{!! Form::close() !!}

					<hr>

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
@endsection