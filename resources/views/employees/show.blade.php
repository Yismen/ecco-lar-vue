@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Employees', 'page_description'=>'Show Details'])

@section('content')
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2 col-xs-10 col-xs-offset-1">
			<div class="box box-primary">
				<div class="box-body">
					<div class="col-xs-12 ">
						<a href="{{ route('admin.employees.index') }}" class="pull-right" title="Back to List">
							<i class="fa fa-list"></i>
						</a>
					</div>

					<div class="col-md-6 animated fadeIn">
						@include('employees._details-personals')
						@if ($employee->termination)
							@include('employees._details-termination-info')
						@endif
					</div>
					{{-- /. Photo	 --}}
					<div class="col-md-6 animated fadeIn">
						@include('employees._details-tss-info')
						@include('employees._details-other-info')

					</div>

					<div class="col-md-6"></div>

					<div class="col-md-6">
						
						@include('employees._changes')
					</div>
				</div>
				{{-- /. Details --}}
			</div>
		</div>
	</div>
@endsection
