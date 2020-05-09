@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Projects', 'page_description'=>'Create a new project id.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					
					{!! Form::open(['route'=>['admin.projects.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
						<legend>New Project ID</legend>
					
						@include('projects._form')

						<div class="form-group">
							<div class="col-sm-10 col-sm-offset-2">
								<button type="submit" class="btn btn-primary">Create</button>	
							</div>
						</div>
						<div class="form-group">	
							<div class="col-sm-12">
								<a href="{{ route('admin.projects.index') }}">
									Projects List
									<i class="fa fa-list">	</i>
								</a>
							</div>
						</div>
					
					{!! Form::close() !!}
					
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')

@endpush