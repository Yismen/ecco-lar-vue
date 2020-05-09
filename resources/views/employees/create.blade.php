@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Employees', 'page_description'=>'Create a new employee!'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="box box-primary">
					<div class="box-header with-border">
						Create New Employee @include('punches._last_punch_id')
						<a href="{{ route('admin.employees.index') }}" class="pull-right" title="Return to the employees' list."><i class="fa fa-list"></i></a>
					</div>
					<create-employee :employee="{{ $employee }}"></create-employee>
					{{-- {!! Form::model($employee, ['route'=>['admin.employees.store'], 'method'=>'POST', 'class'=>'', 'role'=>'form']) !!}
						<div class="box-body">

							@include('employees._form')

						</div>


						<div class="box-footer">
							<button type="submit" class="btn btn-primary">Create</button>
							<button class="btn btn-default" type="reset">Undo Changes</button>

							<div class="col-sm-12">
								<a href="{{ route('admin.employees.index') }}">
									<i class="fa fa-angle-double-left"></i> Cancel and Return
								</a>
							</div>
						</div>
					{!! Form::close() !!} --}}

				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')

@endpush
