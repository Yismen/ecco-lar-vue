@extends('layouts.app')

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					
					{!! Form::model($note, ['route'=>['admin.notes.store'], 'method'=>'POST', 'class'=>'', 'role'=>'form', 'autocomplete'=>"off"]) !!}		
						<div class="form-group">
							<legend>Create a Note @include('notes.admin.partials.link-to-list')</legend>
						</div>
					
						@include('notes.admin._form')

						<div class="form-group">
							<button class="btn btn-primary" type="submit">Save</button>
							<button class="btn btn-default" type="reset">Reset</button>
						</div>
					
					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
@endsection