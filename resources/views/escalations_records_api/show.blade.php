@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Escalations Clients', 'page_description'=>'Details for Escalations Clients'])

@section('content')
	<div class="container-fluid">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary pad">
				<div class="small-box bg-aqua">
					<div class="inner">
						<p>Escalations Clients:</p>
						<h3>{{ $escalclient->name }}</h3>

					</div>
					<div class="icon">
						<i class="fa fa-flag"></i>
					</div>
					<a href="{{ route('admin.escalations_clients.edit', $escalclient->slug) }}" class="small-box-footer">
						Edit info <i class="fa fa-pencil"></i>
					</a>
				</div>
				<hr>
				<a href="{{ route('admin.escalations_clients.index') }}" class="">
					Escalations Clients List 
					<i class="fa fa-list"></i>
				</a>            
			</div>
		</div>
	</div>
@endsection
@push('scripts')

@endpush