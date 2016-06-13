@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
		<div class="well row ">
				<h3 class="page-header">
					Users List
					 (
						 <small>
						 	<a href="{{ route('admin.users.create') }}">
						 		<i class="fa fa-plus"></i>
						 	</a>
						 </small>
					 )
				</h3>
			@if ($users->isEmpty())
				<div class="bs-callout bs-callout-warning">
					<h1>No Menus has been added yet, please add one</h1>
				</div>
			@else
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>User Item</th>
							<th class="col-xs-3">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
							<tr>
								<td>
									<a href="{{ route('admin.users.show', $user->username) }}">{{ $user->name }}</a>
								</td>
								<td>
									<a href="{{ route('admin.users.edit', $user->username) }}" class="btn btn-warning">
										<i class="fa fa-edit"></i>
									</a>
									{{-- {!! delete_button('admin.users.destroy', $user->username, ['class'=>'btn btn-danger','label'=>'<i class="fa fa-trash"></i>']) !!} --}}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
	</div>
@stop

@section('scripts')
	
@stop