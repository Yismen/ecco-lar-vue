@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Users', 'page_description'=>'Edit user information and config.'])

@section('content')
	<div class="container ">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary pad">
				<div class="row">
					<div class="col-sm-12">
						{!! Form::model($user, ['route'=>['admin.users.update', $user->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
							<div class="form-groups">
								<legend>
									Edit user - {{ $user->name }}
									<a href="{{ route('admin.users.index') }}" class="pull-right"><i class="fa fa-list"></i></a>
								</legend>
							</div>
						
							@include('users._form')
							<hr>
							<div class="form-group">
								<div class="col-sm-10 col-sm-offset-2">
									<button type="submit" class="btn btn-primary">SAVE UPDATES</button>
									<a href="/admin/users" class="btn btn-default">
										<i class="fa fa-home"></i> Cancel
									</a>
								</div>

							</div>
						
						{!! Form::close() !!}

						<hr>

						<div class="form-group">
							<div class="col-sm-10 col-sm-offset-2">

								<form action="{{ url('/admin/users', $user->id) }}" method="POST" class="" style="display: inline-block;">
								    {!! csrf_field() !!}
								    {!! method_field('DELETE') !!}
								
								    <button type="submit" id="delete-user" class="btn btn-danger"  name="deleteBtn">
								        <i class="fa fa-btn fa-trash"></i> Delete User
								    </button>
								</form>

								<a href="/admin/users/force_reset/{{ $user->id }}" class="btn btn-warning pull-right">
									<i class="fa fa-pencil"></i> Forcely reset password
								</a>

							</div>
						</div>
					</div>
				</div>


						
			</div>
		</div>

	</div>
@stop

@section('scripts')
	
@stop