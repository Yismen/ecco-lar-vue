@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class=" col-sm-12">
		<div class="well row ">
				<h3 class="page-header">
					Logins Items List
					 (
						 <small>
						 	<a href="{{ route('logins.create') }}">
						 		<i class="fa fa-plus"></i>
						 	</a>
						 </small>
					 )
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
							<th class="col-xs-3">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($logins as $login)
							<tr>
								<td>
									<a href="{{ route('logins.show', $login->id) }}">{{ $login->login }}</a>
								</td>
								<td>
									<a href="{{ route('systems.show', $login->system->id) }}">{{ ucwords(trim($login->system->name)) }}</a>
								</td>
								<td>
									<a href="{{ route('admin.employees.show', $login->employee->id) }}">
										{{ ucwords(trim($login->employee->first_name ))}} 
										{{ ucwords(trim($login->employee->last_name ))}}
									</a>
								</td>
								<td>
									<a href="{{ route('logins.edit', $login->id) }}" class="btn btn-warning">
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
@stop

@section('scripts')
	
@stop