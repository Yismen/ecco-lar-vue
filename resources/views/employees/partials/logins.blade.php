<div class="col-sm-12">
	
	<h1>Logins... Under construction...</h1>
	{{ $employee->logins }}
	{!! Form::open(['route'=>['admin.employees.edit', $employee->id], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}	<!-- logins.edit -->	
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
		{{-- /. Errors --}}
		<h1>Esto se esta volviendo interesante. Es probable que sea preferible no hacer esto aqui...</h1>
		@foreach ($employee->logins as $login)
			<!-- Login -->
			<div class="form-group {{ $errors->has('login') ? 'has-error' : null }}">
				{!! Form::label('login', 'Login:', ['class'=>'col-sm-2 control-label']) !!}
				<div class="col-sm-10">
					{!! Form::input('text', 'login', null, ['class'=>'form-control', 'placeholder'=>'Login']) !!}
				</div>
			</div>
			<!-- /. Login -->

			<!-- System -->
			<div class="form-group {{ $errors->has('system_id') ? 'has-error' : null }}">
				{!! Form::label('system_id', 'System:', ['class'=>'col-sm-2 control-label']) !!}
				<div class="col-sm-10">
					{!! Form::select('system_id', $employee->systemsList, null, ['class'=>'form-control input-sm']) !!}
				</div>
			</div>
			<!-- /. System -->							
		@endforeach
	{!! Form::close() !!}
</div>