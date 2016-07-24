<div class="col-sm-12">
	{!! Form::open(['route'=>['admin.employees.login.create', $employee->id], 'method'=>'POST', 'class'=>'form-', 'role'=>'form', 'autocomplete'=>"off", 'id'=>'logins_form']) !!}	<!-- logins.edit -->	
		<div class="form-group">
			<legend>Login</legend>
		</div>

		{{-- Display Errors --}}
		@if( $errors->any() )
			<div class="col-sm-12">
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			</div>
		@endif

		<div class="ajax-messages"></div>
		{{-- /. Errors --}}

		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('login') ? 'has-error' : null }} login-group">
				{!! Form::label('login', 'Login:', ['class'=>'']) !!}
				{!! Form::input('text', 'login', null, ['class'=>'form-control', 'placeholder'=>'Login']) !!}
			</div>
			<!-- /. Login -->
		</div>

		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('system_id') ? 'has-error' : null }} system-group">
				{!! Form::label('system_id', 'System:', ['class'=>'']) !!}
				{!! Form::select('system_id', $employee->systemsList, null, ['class'=>'form-control']) !!}
			</div>
			<!-- /. System -->
		</div>

		<div class="col-sm-12">
			<button class="btn btn-primary" id="create_login" type="submit">Create</button>
		</div>


		
	{!! Form::close() !!}

	<hr>
	<div id="logins_list">
		
		@include('employees.partials._logins')
		
	</div>

	
	
</div>