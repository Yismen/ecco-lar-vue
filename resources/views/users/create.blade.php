@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="container ">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary pad">
				<div class="row">
					<div class="col-sm-12">
						{!! Form::open(['route'=>['admin.users.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
							<div class="col-sm-12 form-group">
								<legend>
									Create a New User 
									<a href="{{ route('admin.users.index') }}" class="pull-right">
										<i class="fa fa-list"></i>
									</a>
								</legend>
							</div>
						
							@include('users._form')

							<hr>

							{{-- {{ dd($rolesList) }} --}}
							<div class="form-group has-error">	
								{!! Form::label('notify', 'Notify:', ['class'=>'col-sm-2 control-label']) !!}
								<div class="col-sm-10">		
									<div class="checkbox">
										<label>
											{!! Form::checkbox('notify', 1, 1, []) !!}
											Notify the user
										</label>
									</div>
								</div>
							</div>
							<!-- /. Roles -->

							<hr>

							<div class="col-sm-10 col-sm-offset-2">
								<button type="submit" class="btn btn-primary form-control">Create</button>
							</div>
						
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
		
	</div>
@stop

@section('scripts')
	
@stop