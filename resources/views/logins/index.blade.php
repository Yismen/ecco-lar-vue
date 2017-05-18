@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Logins', 'page_description'=>'List of logins for all the users.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">

					<h3 class="page-header">
						Logins Items List
					 	<a href="{{ route('admin.logins.create') }}">
					 		<i class="fa fa-plus"></i>
					 	</a>
					</h3>

					@if ($logins->isEmpty())
						<div class="bs-callout bs-callout-warning">
							<h1>No Logins has been added yet, please add one</h1>
						</div>
					@else
						<table class="table table-condensed table-hover">
							<thead>
								<tr>
									<th>Login</th>
									<th>System</th>
									<th>Employee</th>
									<th class="col-xs-3">
										<a href="{{ route('admin.logins.create') }}">
									 		<i class="fa fa-plus"></i> Add
									 	</a>
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($logins as $login)
									<tr>
										<td>
											<a href="{{ route('admin.logins.show', $login->id) }}">{{ $login->login }}</a>
										</td>
										<td>
											<a href="{{ route('admin.systems.show', $login->system->id) }}">{{ ucwords(trim($login->system->name)) }}</a>
										</td>
										<td>
											<a href="{{ route('admin.employees.show', $login->employee->id) }}">
												{{ ucwords(trim($login->employee->first_name ))}} 
												{{ ucwords(trim($login->employee->last_name ))}}
											</a>
										</td>
										<td>
											<a href="{{ route('admin.logins.edit', $login->id) }}" class="btn btn-warning">
												<i class="fa fa-edit"></i>
											</a>
											{{-- {!! delete_button('logins.destroy', $login->id, ['class'=>'btn btn-danger','label'=>'<i class="fa fa-trash"></i>']) !!}  --}}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>

						<div class="text-center">
							{{ $logins->render() }}
						</div>
					@endif

				</div>
			</div>
		</div>
	</div>
@endsection