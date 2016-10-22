@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Users', 'page_description'=>'Edit user information and config.'])

@section('content')
	<div class="container ">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary pad">
				<div class="row">
					<div class="col-sm-12">
						{!! Form::model($user, ['route'=>['admin.users.update', $user->username], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
							<div class="form-groups">
								<legend>
									Edit user - {{ $user->name }}
									<a href="{{ route('admin.users.index') }}" class="pull-right"><i class="fa fa-list"></i></a>
								</legend>
							</div>
						
							@include('users._form')
							<hr>
							<div class="col-sm-10 col-sm-offset-2">
								<button type="submit" class="btn btn-primary form-control">Save</button>
							</div>
						
						{!! Form::close() !!}

						<hr>
					</div>
				</div>
			</div>
		</div>

	</div>
@stop

@section('scripts')
	
@stop