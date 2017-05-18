@extends('layouts.main')

@section('content')
	<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
		<div class="well">

			{!! Form::model($contact, ['route'=>['contacts.update', $contact->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
					<div class="form-group">
						<legend>Edit contact</legend>
					</div>
				
					@include('contacts._form')
			
					
			
			{!! Form::close() !!}
			<hr>

			@if ( $contact->username == Auth::user()->username )
				{!! delete_form(["contacts.destroy", $contact->id]) !!}
			@endif
		</div>
	</div>
@stop

@section('scripts')
	