@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Systems', 'page_description'=>'Show system details'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="box box-primary">
					<div class="box-body">
						{{ $revenue_type }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')

@endpush