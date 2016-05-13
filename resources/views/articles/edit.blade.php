@extends('layouts.main')

@section('content')
<br>
	<div class="container">
		<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
			<div class="well">
				{!! Form::model($article, ['route'=>['articles.update', $article->slug], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
					<legend>Update Article {{ $article->title }}</legend>

					@include( 'articles._form' )

				{!! Form::close() !!}
				
				@if ( $article->username == Auth::user()->username )
					<hr>
					<div class="form-group">
						<div class="col-xs-offset-1">
							{!! delete_form(['articles.destroy', $article->slug ]) !!}
						</div>
					</div>
				@endif
				
			</div>
		</div>
	</div>
	@include('articles._modal_forms', ['slug' => $article->slug])
@stop
@section('scripts')
	@include( 'layouts.tinyMce.basic', ['item'=>'#body'])	
{{-- 	<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/select2/select2-bootstrap.css') }}">
	<script src="{{ asset('plugins/select2/dist/js/select2.full.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$("#category_id").select2();
		});
	</script> --}}
@stop

