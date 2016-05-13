(function($){
	$(document).on('submit', '#photo_form', function(event) {
		event.preventDefault();
		var form = $(this);
		$('.save-photo').append(' <i class="spinner fa fa-circle-o-notch fa-spin"></i>');

		var ajax = $.ajax({
			url: $(form).prop('action'),
			type: $(form).prop('method'),
			dataType: 'json',
			data: new FormData(this),
			processData: false,
			contentType: false,
		})
		.progress(function(data){
			alert(data);
			console.log(data.total);
		})
		.done(function(results) {
			console.log(results);
			$(form).fadeTo('fast', .5, function() {
				$('.errors-area').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Success!</strong> '+results.message+' ...</div>');
				$('#photo_form_group')
					.removeClass('has-error');
				$('#show-photo').prop('src', results.photo +"?" + Math.random());

			}).fadeTo('slow', 1);

		})
		.fail(function(results) {
			console.log(results.responseText);
			$(form).fadeTo('fast', .5, function() {
				$('.errors-area').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Error!</strong> '+results.responseJSON.photo+' ...</div>');
				$('#photo_form_group')
					.removeClass('has-error')
					.addClass('has-error');
			}).fadeTo('slow', 1);
		})
		.complete(function() {
			$('.spinner').fadeOut('fast');
		});
		
		console.log(ajax);
		
	});
})(jQuery);