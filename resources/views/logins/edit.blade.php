@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		{{-- {{ dd($employee) }} --}}
		<div class="well row">
			{!! Form::model($login, ['route'=>['logins.update', $login->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}	
				<div class="form-group">
					<legend>Edit Login {{ $login->login }}</legend>
				</div>
			
				@include('logins._form')

				<div class="col-sm-6 col-sm-offset-2">
					<button type="submit" class="btn btn-primary">Update</button>	
					<a href="{{ route('logins.index') }}" class="btn btn-default">Cancel</a>				
				</div>
			
			{!! Form::close() !!}
				
			{!! delete_button('logins.destroy', $login->id, ['class'=>'btn btn-danger ','label'=>'Delete <i class="fa fa-trash"></i>']) !!} 
				
		</div>
	</div>

@stop

@section('scripts')
	
@stop