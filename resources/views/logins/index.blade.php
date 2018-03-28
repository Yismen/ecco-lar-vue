@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Logins', 'page_description'=>'List of logins for all the users.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">

					<div class="box-header with-border">
						<h3>
							<div class="col-xs-6">
								Logins Items List
							</div>
							<div class="col-xs-3">
								<small>
									{!! Form::open(['url' => '/admin/logins/to_excel', 'method' => 'post', 'class'=>'', 'role' => 'form']) !!}

									<div class="col-sm-3">
										<div class="form-group">
											<button class="btn btn-primary" type="submit"><i class="fa fa-download"></i> Download</button>
										</div>
									</div>

								{!! Form::close() !!}
									{{--  <a href="/admin/logins/to_excel"><i class="fa fa-download"></i> Download</a>  --}}
								</small>
							</div>
							<div class="col-xs-3">
								<a href="{{ route('admin.logins.create') }}" class="pull-right">
									<small><i class="fa fa-plus"></i> Create</small>
								</a>
							</div>
						</h3>
					</div>

					<div class="box-body">
							@if ($employees->isEmpty())
							<div class="bs-callout bs-callout-warning">
								<h1>No Logins has been added yet, please add one</h1>
							</div>
						@else
							@include('logins.partials.results', ['logins', $employees])
						@endif
					</div>

					<div class="box-footer with-border">
						{{ $employees->render() }}
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection