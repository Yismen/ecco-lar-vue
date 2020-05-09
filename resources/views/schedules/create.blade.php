@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Schedules', 'page_description'=>'Create a new schedule id.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">

					<div class="box-header">
						<h4>
							Create Schedule for Employees
							<a href="{{ route('admin.schedules.index') }}" class="pull-right" title="Back To Schedules List">
								<i class="fa fa-list"></i>
							</a>
						</h4>
						<span class="text-muted">Any previous schedule for this employee will be removed if the same days are selected...</span>
					</div>

					{!! Form::open(['route'=>['admin.schedules.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'novalidate' => true]) !!}

						<div class="box-body">
							@include('schedules._form')
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
