@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Employees', 'page_description'=>"Edit data for employee $employee->full_name."])

@section('content')
	<div class="container-fluid">
		<div class="col-sm-10 col-sm-offset-1">
			<div class="box box-primary pad">

				<div class="row">
					
					<div class="col-sm-12">
						<employee-index :employee="{{ $employee }}"></employee-index>
					</div>
				</div><!-- /. sm 12 -->
			</div><!-- /. Primary box -->
		</div><!-- /. Main box -->
	</div>
@endsection

@section('scripts')
	<script src="/js/dainsys/app.js"></script>
@stop

