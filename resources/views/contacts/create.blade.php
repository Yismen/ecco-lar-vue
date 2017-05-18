@extends('layouts.main')

@section('content')
	<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 ">
		<div class="well">
			{!! Form::open(['route'=>['contacts.store'], 'class'=>'form-horizontal', 'role'=>'form']) !!}		
				<div class="form-group">
					<legend>Create new contact</legend>
				</div>
			
				@include('contacts._form')
			
			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('scripts')
	
@stop