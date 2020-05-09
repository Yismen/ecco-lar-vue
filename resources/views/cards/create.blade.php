@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Cards', 'page_description'=>'Create a new card.'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		<div class="box box-primary pad">
			{!! Form::open(['route'=>['admin.cards.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
				<legend>New Card ID</legend>
			
				@include('cards._form')

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<button type="submit" class="btn btn-primary">Create</button>
						
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-12">
						<a href="{{ route('admin.cards.index') }}"><< Back to Cards List</a>
					</div>
				</div>
			
			{!! Form::close() !!}
		</div>
	</div>
@stop

@push('scripts')
	
@endpush