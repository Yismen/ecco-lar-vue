@extends('layouts.app')

@section('content')
		<div class="row">
			<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
	<div class="well">
				{!! Form::model($profile, ['route'=>['admin.profiles.store'], 'class'=>'', 'role'=>'form', 'autocomplete'=>"off", 'files' => true]) !!}		
					<div class="form-group">
						<legend>Create Your Profile</legend>
					</div>
				
					@include('profiles._form')

					<div class="row">
						<div class="col-xs-6">
							@include('profiles._photo')
						</div>
						<div class="col-xs-6">
								@include('profiles._photo-field')
								<!-- /. Your Photo -->
								
								<div class="form-group">
									
									<button type="subbmit" class="btn btn-primary">Create Profile</button>
									<button type="reset" class="btn btn-default">Cancel</button>
								</div>
						</div>
					</div>

					<div class="form-group">
					</div>
				
				{!! Form::close() !!}
				
				<div class="container-fluid">
					<div class="form-group">
						<a href="{{ route('admin.profiles.index') }}">
							<i class="fa fa-arrow-circle-left"></i>
							 Return to Your Profile
						</a>
					</div>
				</div>
				
			</div>
		</div>
	</div>
@endsection