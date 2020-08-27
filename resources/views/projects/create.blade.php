@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Projects', 'page_description'=>'Create a new project id.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				{!! Form::open(['route'=>['admin.projects.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
					<div class="box box-primary">
						<div class="box-header with-border">
							<h4>
								Create New Project
								<a href="{{ route('admin.projects.index') }}" class="pull-right">
									Projects List
									<i class="fa fa-list">	</i>
								</a>
							</h4>
						</div>
						
						<div class="box-body">
							@include('projects._form')

							<div class="form-group">
								<div class="col-sm-10 col-sm-offset-2">
									<button type="submit" class="btn btn-primary">Create</button>	
								</div>
							</div>	
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection
@push('scripts')

@endpush