@extends('layouts.app', ['page_header'=>'Notes', 'page_description'=>'Aproved notes for emails and chats'])

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					{!! Form::open(['route'=>['notes.search'], 'method'=>'GET', 'class'=>'', 'role'=>'form', 'autocomplete'=>"off", 'id'=>'search-notes-form']) !!}		

						<div class="form-group">
							<div class="form-group {{ $errors->has('search') ? 'has-error' : null }}">
								<div class="input-group">
								      <span class="input-group-btn">
								        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
								      </span>
									{!! Form::input('text', 'search', null, ['class'=>'form-control', 'placeholder'=>'Search Note', 'id'=>'search']) !!}
								</div>
								@if ($errors->has('search'))
									<span class="help-block text-danger">{{ $errors->first('search') }}</span>
								@endif
							</div>
							<!-- /. Search Note -->							
						</div>
					
					{!! Form::close() !!}

					<div id="results-div">	
						@include('notes._results')
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
	<script type="text/javascript">
	  (function($){
	  	$('#search-notes-form').first().on('submit', function(event){
	  		event.preventDefault();
	  		var form = $(this);
	  		var data = form.serializeArray();
	  		var url = form.prop('action');
	  		var resultsDiv = $('#results-div');

	  		resultsDiv.fadeOut('fast', function() {
	  			search(url, data, resultsDiv);
			  		resultsDiv.html(data);	  
	  		}).fadeIn('fast')


	  	});

	  	$('#search').on('keyup', function(event) {
	  		event.preventDefault();
	  		var form = $(this).parents('form').first();
	  		var data = form.serializeArray();
	  		var url = form.prop('action');
	  		var resultsDiv = $('#results-div');

	  		search(url, data, resultsDiv);

	  	});

	  	function search(url, data, resultsDiv)
	  	{
	  		return $.get(url, data, function(data, textStatus, xhr) {
			  	resultsDiv.html(data);	
	  		});
	  	}

	  })(jQuery)
	</script>
@stop