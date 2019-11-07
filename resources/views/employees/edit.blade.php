@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Employees', 'page_description'=>"Edit data for employee $employee->full_name."])

@section('content')
	<div class="container-fluid">
		<div class="col-sm-12">
			<edit-employee :employee="{{ $employee }}"></edit-employee>
		</div><!-- /. Main box -->
	</div>
@endsection

@section('scripts')

@stop

