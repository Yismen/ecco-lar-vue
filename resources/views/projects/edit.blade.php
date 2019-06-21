@section('scripts')

@stop

@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Projects', 'page_description'=>'Edit Project ID.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-warning">
					<div class="box-header">
						<h4>
							Edit Project
							<a href="{{ route('admin.projects.show', $project->id) }}">{{ $project->name }}</a>
						</h4>
					</div>


					<div class="box-body">
						{!! Form::model($project, ['route'=>['admin.projects.update', $project->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}

							@include('projects._form')

							<div class="form-group">
								<div class="col-sm-6 col-sm-offset-2">
									<button type="submit" class="btn btn-warning">Update</button>
									<button type="reset" class="btn btn-default">Reset Form</button>
								</div>
							</div>


						{!! Form::close() !!}
					</div>

					<div class="box-footer">
						<delete-request-button
							url="{{ route('admin.projects.destroy', $project->id) }}"
							redirect-url="{{ route('admin.projects.index') }}"
						></delete-request-button>
					</div>

					    <div class="form-group col-sm-offset-4">
					    	<a href="/admin/projects" class="push-right">
					    		Back to the list
						    	<i class="fa fa-list"></i>
						    </a>
					    </div>

				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop
