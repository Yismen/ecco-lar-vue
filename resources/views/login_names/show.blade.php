@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Login Names', 'page_description'=>'Details for login.'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary">

					<div class="box-header with-border">
						<h4>
							Login Name: {{ $login->login }}
							<a href="{{ route('admin.login-names.index') }}" class="pull-right">
								<i class="fa fa-home"></i> List
							</a>
						</h4>
					</div>

					<div class="box-body">
						<table class="table table-condensed table-hover">
							<tbody>
								<tr>
									<th>Login Name: </th>
									<td>{{ $login->login }}</td>
								</tr>
								<tr>
									<th>Employee&rsquo;s Name: </th>
									<td>
										<a href="{{ route('admin.employees.show', $login->employee->id) }}">
											{{ ucwords(trim($login->employee->full_name)) }}
										</a>
									</td>
								</tr>
								{{-- /. Employee --}}
								<tr>
								</tr>
								{{-- /. Login Name --}}

							</tbody>
						</table>
					</div>
					{{-- /. box body --}}

					<div class="box-footer">
						<a href="{{ route('admin.login-names.edit', $login->id) }}" class="btn btn-warning">
							<i class="fa fa-edit"></i>
							Edit
						</a>
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection