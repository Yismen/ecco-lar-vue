@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Employees', 'page_description'=>"Edit data for employee $employee->full_name."])

@section('content')
	<div class="container-fluid">
		<div class="col-sm-12 col-md-10 col-md-offset-1">
			<employee-index :employee="{{ $employee }}"></employee-index>
		</div><!-- /. Main box -->
	</div>
@endsection

@section('scripts')
	<script src="/js/dainsys/app.js"></script>
@stop

