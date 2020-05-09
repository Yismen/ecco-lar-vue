@extends('layouts.main')

@section('content')
	<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
		<div class="well">
				{!! Form::model($article, ['route'=>'articles.store', 'method'=>'POST', 'class'=>'form-horizontal']) !!}
					<legend>Create Post</legend>

					@include( 'articles._form' )

				{!! Form::close() !!}
		</div>
	</div>

	{{-- @include('articles._modal_forms') --}}
@stop

@push('scripts')
	
	@include( 'layouts.tinyMce.basic', ['item'=>'#body'])		
	
@endpush


