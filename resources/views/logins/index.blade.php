@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Logins', 'page_description'=>'List of logins for all the users.'])

@section('content')
	<div class="container-fluid">
		<div class="">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-success">
				
					<div class="box-body">
						{!! Form::open(['url' => '/admin/logins/to_excel', 'method' => 'post', 'class'=>'', 'role' => 'form']) !!}

							<div class="col-sm-9">
								<div class="form-group {{ $errors->has('employee_id') ? 'has-error' : null }}">
									{!! Form::label('employee_id', 'Employee:', ['class'=>'col-sm-2 control-label']) !!}
									<div class="col-sm-10">
										{!! Form::select('employee_id', $employees, '%', ['class'=>'form-control select2']) !!}
									</div>
								</div>
							</div>

							<div class="col-sm-3">
								<div class="form-group">
									<button class="btn btn-primary" type="submit"><i class="fa fa-download"></i> EXPORT TO EXCEL</button>
								</div>
							</div>

						{!! Form::close() !!}	
					</div>			
					
				</div>
			</div>
		</div>
		{{--  /.Exporter Form  --}}
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">

					<div class="box-header with-border">
						<h3>
							Logins Items List
							<a href="{{ route('admin.logins.create') }}" class="pull-right">
								<i class="fa fa-plus"></i> Create
							</a>
						</h3>
					</div>

					<div class="box-body">
							@if ($logins->isEmpty())
							<div class="bs-callout bs-callout-warning">
								<h1>No Logins has been added yet, please add one</h1>
							</div>
						@else
							@include('logins.partials.results', ['logins', $logins])
						@endif
					</div>

					<div class="box-footer with-border">
						{{ $logins->render() }}
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection