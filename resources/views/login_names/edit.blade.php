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
							<a href="{{ route('admin.login-names.index') }}" class="pull-right">
								<i class="fa fa-home"></i> List
							</a>

						</h4>
					</div>

					{!! Form::model($login, ['route'=>['admin.login-names.update', $login->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}

						<div class="box-body">
							@include('login_names._form')
						</div>

						<div class="box-footer">
							<div class="col-sm-10 col-sm-offset-2">
								<div class="form-group">
									<button type="submit" class="btn btn-warning">UPDATE</button>
								</div>
							</div>
						</div>

					{!! Form::close() !!}

					<div class="box-footer">
		                <delete-request-button
		                    url="{{ route('admin.login-names.destroy', $login->id) }}"
		                    redirect-url="{{ route('admin.login-names.index') }}"
		                ></delete-request-button>
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection