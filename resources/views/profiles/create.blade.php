@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h4>
							Create Your Profile Info
						</h4>
					</div>
					{{-- /.box-header --}}
					{!! Form::model($profile, ['route'=>['admin.profiles.store'], 'class'=>'', 'role'=>'form', 'autocomplete'=>"off", 'files' => true]) !!}
						<div class="box-body">
							@include('profiles._form')
						</div>
						{{-- /.bpx-body --}}
						<div class="box-footer">
							<button type="subbmit" class="btn btn-primary">Create Profile</button>
						</div>
					{!! Form::close() !!}
				</div>
				{{-- /.box.box-primary --}}
			</div>
			{{-- /.col --}}
		</div>
		{{-- /.row --}}
	</div>
@endsection
