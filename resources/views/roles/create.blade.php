
@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Roles Management', 'page_description'=>'Add a new role.'])

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-header">
								Create Role 
								<a 
									href="{{ route('admin.roles.index') }}" 
									class="pull-right"
									title="Return to List"
								>
									<i class="fa fa-list"></i>
								</a>
							</h3>

							{!! Form::open(['route'=>['admin.roles.store'], 'method'=>'post', 'class'=>'form-horizontal', 'role'=>'form']) !!}	
							
								@include('roles._form')

								<div class="col-sm-10 col-sm-offset-2">
									<button type="submit" class="btn btn-primary form-control">Create</button>
									<br><br>
									<a href="{{ route('admin.roles.index') }}"><< Return to Roles List</a>
								</div>
							
							{!! Form::close() !!}
							
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop