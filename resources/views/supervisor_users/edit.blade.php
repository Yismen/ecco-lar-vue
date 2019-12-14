@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Supervisor User Relationships', 'page_description'=>'Edit supervisor_user item'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-warning">
					<div class="box-header with-border">
						<h4>Edit Supervisor User Relationship 
								{{-- {{ $assigned->name }} --}}
							<a href="{{ route('admin.supervisor_users.index') }}" class="pull-right">
								<i class="fa fa-home"></i>
                            	Return to List
							</a>
						</h4>
					</div>

					
					<div class="box-footer">
							UPDATE User: Supervisor:
					</div>
					{{-- <div class="box-footer">
						<delete-request-button
						    url="{{ route('admin.supervisor_users.destroy', $assigned->id) }}"
						    redirect-url="{{ route('admin.supervisor_users.index') }}"
						></delete-request-button>
					</div> --}}
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop
