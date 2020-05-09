@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Campaigns', 'page_description'=>'Create a new campaign.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="box box-primary">
					<div class="box-header">
						<h4>New Campaign
							<a href="{{ route('admin.campaigns.index') }}" class="pull-right">
								<i class="fa fa-home"></i> List
							</a>
						</h4>
					</div>
					{!! Form::open(['route'=>['admin.campaigns.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}

						<div class="box-body">
							@include('campaigns._form')
						</div>

						<div class="box-footer">
							<div class="col-sm-10 col-sm-offset-2">
								<button type="submit" class="btn btn-primary">Create</button>
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
