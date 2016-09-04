@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Donwtimes', 'page_description'=>'Edit downtime data.'])

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad big-box">
					<div class="row">
						{!! Form::model($downtime, ['route'=>['admin.downtimes.update', $downtime->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}	
							<div class="form-group">
								<legend>Edit Login {{ $downtime->name }}</legend>
							</div>
						
							@include('downtimes._form')

							<div class="col-sm-6 col-sm-offset-2">
								<button type="submit" class="btn btn-primary">Update</button>	
								<a href="{{ route('admin.downtimes.index') }}" class="btn btn-default">Cancel</a>				
							</div>
						
						{!! Form::close() !!}
						<hr>
						<div class="col-sm-10 col-sm-offset-2">
							<form action="{{ url('/admin/downtimes', $downtime->id) }}" method="POST" class="" style="display: inline-block;">
							    {!! csrf_field() !!}
							    {!! method_field('DELETE') !!}
							
							    <button type="submit" id="delete-downtime" class="btn btn-danger"  name="deleteBtn">
							        <i class="fa fa-btn fa-trash"></i> Delete
							    </button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
