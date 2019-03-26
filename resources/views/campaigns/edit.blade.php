@section('scripts')
	
@stop

@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Campaigns', 'page_description'=>'Edit Campaign.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-warning">
					<div class="box-header">
						<h4>
							Edit Campaign {{ $campaign->name }}
					    	<a href="{{ route('admin.campaigns.index') }}" class="pull-right">
						    	<i class="fa fa-list"></i> List
						    </a>
						</h4>
					</div>
						

					{!! Form::model($campaign, ['route'=>['admin.campaigns.update', $campaign->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}
						<div class="box-body">

							@include('campaigns._form')
						
						</div>

						<div class="box-footer">							
							<div class="col-sm-6 col-sm-offset-2">
								<button type="submit" class="btn btn-warning">Update</button>	
							</div>	
						</div>
					{!! Form::close() !!}

					<div class="box-footer">
						<delete-request-button
							url="{{ route('admin.campaigns.destroy', $campaign->id) }}"
							redirect-url="{{ route('admin.campaigns.index') }}"
						></delete-request-button>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop