

{{-- Modals --}}

<div class="modal fade" id="modal-from-file">
	<div class="modal-dialog">
		<div class="modal-content">	
			{!! Form::open(['route' => ['articles.saveImageFromLocalFile'], 'method' => 'post', 'files' => true, 'id' => 'modal_form_upload_file']) !!}	
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Save Image From Local File</h4>
				</div>
				<div class="modal-body">
			
					<div class="form-group">
						{{-- {!! Form::label('slug', 'URL:', ['class'=>'']) !!} --}}
						{!! Form::input('text', 'slug', $article->slug, ['class'=>'form-control', 'placeholder'=>'slug', 'readonly'=>'readonly']) !!}
					</div>
					<!-- /. Slug -->
			
					<div class="form-group {{ $errors->has('file') ? 'has-error' : null }}">
						{!! Form::label('file', 'Select Image:', ['class'=>'']) !!}
						{!! Form::file('file', ['class'=>'form-control', 'placeholder'=>'Select Fhoto']) !!}
					</div>
					<!-- /. Select Image -->
					<div class="file-error-area"></div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="submit-file">Save changes</button>
				</div>
			
			{!! Form::close() !!}
		</div>
	</div>
</div>
{{-- /. Modal From FILE  --}}

<div class="modal fade" id="modal-from-url">
	<div class="modal-dialog">
		<div class="modal-content">	
			{!! Form::open(['route' => ['articles.saveImageFromURL'], 'method' => 'post', 'files' => true, 'id' => 'modal_form_upload_url']) !!}	
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Save Image From URL</h4>
				</div>
				<div class="modal-body">
			
					<div class="form-group {{ $errors->has('url') ? 'has-error' : null }}">
						{{-- {!! Form::label('slug', 'URL:', ['class'=>'']) !!} --}}
						{!! Form::input('text', 'slug', $article->slug, ['class'=>'form-control', 'placeholder'=>'slug', 'readonly'=>'readonly']) !!}
					</div>
					<!-- /. Slug -->
			
					<div class="form-group {{ $errors->has('url') ? 'has-error' : null }}">
						{!! Form::label('url', 'URL:', ['class'=>'']) !!}
						{!! Form::input('text', 'url', null, ['class'=>'form-control', 'placeholder'=>'URL']) !!}
					</div>
					<!-- /. URL -->

					<div class="url-error-area"></div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="submit-url">Save changes</button>
				</div>
			
			{!! Form::close() !!}
		</div>
	</div>
</div>
{{-- /. Modal From URL  --}}

<script>
	jQuery(document).ready(function($) {
		$(document).on('submit', '#modal_form_upload_file', function(event) {
			event.preventDefault();

			$('#submit-file').append(' <i class="spinner fa fa-circle-o-notch fa-spin"></i>');

			var action = $(this).prop('action');
			var method = $(this).prop('method');

			var form = $(event);
			$.ajax({
				url: action,
				type: method,
				dataType: 'json',
				data: new FormData(this),
				processData: false,
				contentType: false,
			})
			.done(function(results) {
				console.log("success", results.responseJSON);

				$('#modal-from-file').modal('hide');
				$('#main_image').val(results.data);
				bootbox.alert({
					title: 'Yupiiii!',
					message: 'Your image has been created',
					buttons: {
						ok: {
        					className: 'btn-success'
						}	
					}
				})
			})
			.fail(function(results) {
				console.log("error", results.responseJSON.file || 'Image too heave for me!');
				// console.log($.parseJSON(results));
				$('#modal-from-file').fadeTo('fast', .5, function() {
					$('.file-error-area').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Error!</strong> '+results.responseJSON.file+' ...</div>');
				}).fadeTo('slow', 1);
					
				
			})
			.complete(function(){
				$('.spinner').fadeOut('slow');;				
			});
		});

		$(document).on('submit', '#modal_form_upload_url', function(event) {
			event.preventDefault();

			$('#submit-url').append(' <i class="spinner fa fa-spinner fa-spin"></i>');

			var action = $(this).prop('action');
			var method = $(this).prop('method');
			var data = $(this).serializeArray();

			var form = $(event);

			$.ajax({
				url: action,
				type: method,
				dataType: 'json',
				data: data
			})
			.done(function(results) {
				console.log("success", results.responseJSON);
				// $('.modal-body').append(results.responseText)
				// console.log(results.response);
				$('#modal-from-file').modal('hide');
				$('#main_image').val(results.data);
				bootbox.alert({
					title: 'Yupiiii!',
					message: 'Your image has been created',
					buttons: {
						ok: {
        					className: 'btn-success'
						}	
					}
				})
			})
			.fail(function(results) {
				console.log("error", results);
				$('#modal-from-url').fadeTo('fast', .5, function() {
					$('.url-error-area').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Error!</strong> '+results.responseJSON.url+' ...</div>');
				}).fadeTo('slow', 1);
					
				
			})
			.complete(function(){
				$('.spinner').fadeOut('slow');;					
			});


		});
	});
</script>