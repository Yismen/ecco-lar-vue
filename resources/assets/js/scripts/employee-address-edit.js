(function($){
	$(document).on('submit', '#address_form', function(event) {
		event.preventDefault();
		
		var form = $(this);
		$('#save_address').first()
			.append(' <i class="spinner fa fa-circle-o-notch fa-spin"></i>');

		$.ajax({
			url: form.prop('action'),
			type: form.prop('method'),
			dataType: 'json',
			data: form.serializeArray(),
		})
		.done(function(results) {
			console.log(results);
			$(form).fadeTo('fast', .5, function() {
				$(form)
					.children('.ajax-messages')
					.first()
					.html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Success!</strong> '+results.message+' ...</div>');
				$('.has-error').each(function(index, el) {
					$(el).removeClass('has-error');
				});

			}).fadeTo('slow', 1);
		})
		.fail(function(results) {
			$(form).fadeTo('fast', .5, function() {
				var template = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul>';

				$.each(results.responseJSON, function(index, val) {
					template += '<li>' + val + '</li>'
				});

				template += '</ul></div>';
				$(form)
					.children('.ajax-messages')
					.first()
					.html(template);

				if (results.responseJSON.sector) {
					$(form)
					.children('.sector-group')
					.first()
					.removeClass('has-error').addClass('has-error');
				} else {
					$(form)
					.children('.sector-group')
					.first()
					.removeClass('has-error');
				}

				if (results.responseJSON.street_address) {
					$(form)
					.children('.street_address-group')
					.first()
					.removeClass('has-error').addClass('has-error');
				} else {
					$(form)
					.children('.street_address-group')
					.first()
					.removeClass('has-error');
				}
				if (results.responseJSON.city) {
					$(form)
					.children('.city-group')
					.first()
					.removeClass('has-error').addClass('has-error');
				} else {
					$(form)
					.children('.city-group')
					.first()
					.removeClass('has-error');
				}

			}).fadeTo('slow', 1);

		})
		.always(function() {
			$('.spinner').fadeOut('fast');
		});
		
	});
})(jQuery);