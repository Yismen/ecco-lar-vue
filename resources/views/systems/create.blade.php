@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Systems for Logins', 'page_description'=>'Create a new system.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					
					{!! Form::open(['route'=>['admin.systems.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}
						<legend>New System</legend>
					
						@include('systems._form')

						<div class="form-group">
							<div class="col-sm-10 col-sm-offset-2">
								<button type="submit" class="btn btn-primary">CREATE</button>
								<button type="reset" class="btn btn-default">Reset Form</button>
								<hr>	
								<a href="{{ route('admin.systems.index') }}"><< Return to Systems List</a>
							</div>
						</div>
					
					{!! Form::close() !!}
					
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop