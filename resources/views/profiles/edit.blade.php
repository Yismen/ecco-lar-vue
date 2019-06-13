@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h4>
							Update Your Profile
							<a href="{{ route('admin.profiles.index') }}" class="pull-right" title="Return to Your Profile">
								<i class="fa fa-arrow-circle-left"></i> Home
							</a>
						</h4>
					</div>

					{!! Form::model($profile, ['route'=>['admin.profiles.update', $profile->id], 'method'=>'PUT',  'class'=>'', 'role'=>'form', 'autocomplete'=>"off", 'files' => true]) !!}

						<div class="box-body">
							@include('profiles._form')
						</div>
						{{-- ./ .box-body --}}
						<div class="box-footer">
							<div class="form-group">
								<button type="subbmit" class="btn btn-warning">Update Your Profile</button>

								<button type="reset" class="btn btn-default">Cancel</button>
							</div>
						</div>
						{{-- /.box-footer --}}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection
