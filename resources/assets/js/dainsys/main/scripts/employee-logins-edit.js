(function($){
			$(document).on('submit', '#logins_form', function(event) {
				event.preventDefault();
				
				var form = $(this);
				$('#create_login').first()
					.append(' <i class="spinner fa fa-circle-o-notch fa-spin"></i>');

				$.ajax({
					url: form.prop('action'),
					type: form.prop('method'),
					dataType: 'json',
					data: form.serializeArray(),
				})
				.done(function(results) {
					// console.log(results);
					$(form).fadeTo('fast', .5, function() {
						$(form)
							.children('.ajax-messages')
							.first()
							.html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Success!</strong> '+results.message+' ...</div>');
						$('.has-error').each(function(index, el) {
							$(el).removeClass('has-error');
						});

						var edit_link = "/admin/logins/"+results.newlogin.id+"/edit";
						var row = '';
						row = row+'<tr>';
						row = row+'<td>'+results.newlogin.login+'</td>';
						row = row+'<td><a href="'+results.newlogin.system.url+'">'+results.newlogin.system.display_name+'</a></td>';
						row = row+'<td><a href="'+edit_link+'"><i class="fa fa-edit"></i></a></td>';

						row = row+'</tr>';

						$('#login-body').append(row);
						

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

						if (results.responseJSON.login) {
							$(form)
							.children('.login-group')
							.first()
							.removeClass('has-error').addClass('has-error');
						} else {
							$(form)
							.children('.login-group')
							.first()
							.removeClass('has-error');
						}

						if (results.responseJSON.system_id) {
							$(form)
							.children('.system-group')
							.first()
							.removeClass('has-error').addClass('has-error');
						} else {
							$(form)
							.children('.system-group')
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