@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		{{-- {{ dd($employee) }} --}}
		<div class="well row">
			{!! Form::model($card, ['route'=>['admin.cards.update', $card->card], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}	
				<div class="form-group">
					<legend>Edit Login {{ $card->card }}</legend>
				</div>
			
				@include('cards._form')

				<div class="col-sm-6 col-sm-offset-2">
					<button type="submit" class="btn btn-primary">Update</button>	
					<a href="{{ route('admin.cards.index') }}" class="btn btn-default">Cancel</a>				
				</div>
			
			{!! Form::close() !!}
				
		
				
		</div>
	</div>

@stop

@section('scripts')
	
@stop