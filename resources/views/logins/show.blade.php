@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Logins', 'page_description'=>'Details for login.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					<table class="table table-condensed table-hover">
						<tbody>
							<tr>
								<th>Login: </th>
								<td>{{ $login->login }}</td>
							</tr>
							{{-- /. Login --}}
							<tr>
								<th>Employee's Name: </th>
								<td>
									<a href="{{ route('admin.employees.show', $login->employee->id) }}">{{ ucwords(trim($login->employee->first_name)) }} {{ ucwords(trim($login->employee->last_name)) }}</a>
									
								</td>
							</tr>
							{{-- /. Employee --}}
							<tr>
								<th>System: </th>
								<td>
									@if ($login->system)
										<a href="{{ route('admin.systems.show', $login->system->id) }}">{{ $login->system->name }}</a>
									@else
										System not assigned
									@endif
								</td>
							</tr>
							{{-- /. Login --}}

						</tbody>
					</table>
					<a href="{{ route('admin.logins.edit', $login->id) }}" class="btn btn-warning"> Edit </a>
					<hr>
					<a href="{{ route('admin.logins.index') }}" class=""> << Return to Logins List </a>
				</div>
			</div>
		</div>
	</div>
@endsection