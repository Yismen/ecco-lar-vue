@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'Showing Client '.$client->name.'\'s details'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		<div class="box box-primary">
			<div class="box-body">
				{{ $client }}
			</div>
		</div>
	</div>
@stop

@push('scripts')

@endpush