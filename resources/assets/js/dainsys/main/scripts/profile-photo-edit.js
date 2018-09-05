
			$(document).on('click', '#modal_submit', function(event) {
				event.preventDefault();
				// {{ $profile }}
				$('#modal_form_upload').submit();
			});

			$(document).on('submit', '#modal_form_upload', function(event) {
				event.preventDefault();

				var action = $(this).prop('action');
				var method = $(this).prop('method');
				// return false;
				// $('modal_form_upload')
				$.ajax({
					url: action,
					type: method,
					dataType: 'json',
					data: new FormData(this),
					processData: false,
					contentType: false,
				})
				.done(function(results) {
					console.log(results)
					if (results.status == 1) {
						
						console.log(results.response);
						$('#modal-id').modal('hide');
						$('#profile-photo').prop('src', results.response +"?" + Math.random());
						bootbox.alert({
							title: 'Yupiiii!',
							message: 'Your profile\'photo has been changed!!',
							buttons: {
								ok: {
	            					className: 'btn-success'
								}	
							}
						})

					} else{
						displayError();
					};
				})
				.fail(function(results) {
					displayError();
				});

				function displayError ()
				{
					$('#modal-id').fadeTo(300, .5, function() {
						$('#modal-error').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <strong>Error!</strong> A file must be selected, it must be a image file and can not be bigger than 2MBs!!!</div>');
					}).fadeTo(300, 1, function() {
						
					});
				}
				
			});