@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Contacts', 'page_description'=>'Create a New Contact.'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 ">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h4>
					Edit Contact {{ $contact->name }} 
					<a href="{{ route('admin.contacts.index') }}" title="Back to List"	class="pull-right"><i class="fa fa-home"></i> Back</a>
				</h4>
			</div>
			{!! Form::model($contact, ['route'=>['admin.contacts.update', $contact->id], 'class'=>'form-horizontal', 'role'=>'form', 'method'=>'PUT']) !!}		

				<div class="box-body">
					@include('contacts._form')					
				</div>

				<div class="box-footer">
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-2">
							<button class="btn btn-warning"><i class="fa fa-floppy-o"></i> UPDATE</button>
						</div>
					</div>
				</div>
			
			{!! Form::close() !!}
			<hr>			
			{!! Form::open(['route'=>['admin.contacts.destroy', $contact->id], 'method'=>'DELETE']) !!}
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="form-group">
							<button class="btn btn-danger" name="deleteBtn"><i class="fa fa-trash"></i> DELETE</button>
						</div>
					</div>
				</div>
			{!! Form::close() !!}
			
			
		</div>
	</div>
@stop

@section('scripts')
	
@stop