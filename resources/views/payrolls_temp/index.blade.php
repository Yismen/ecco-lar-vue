@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Payrolls Temprary', 'page_description'=>'Dashboard.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					<div class="box-header with-boarder">
						Dashboard

						<a href="/admin/payrolls_temp/create" class="pull-right" title="Load Temprary Payroll"><i class="fa fa-upload"></i></a>
					</div>


				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')

@stop