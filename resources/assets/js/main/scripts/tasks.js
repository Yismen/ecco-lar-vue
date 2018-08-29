 
$(document).ready(function() {
		$(document).on('change', 'input[name="completed"]', function(event) {
			event.preventDefault();
			
			var form = $(this).parents('form').first();
			var parent = $(this).parents('label').first();
			var parentId = parent.prop('id');
			var formData = form.serializeArray();
			var elemVal = $(this).prop('checked');

			elemVal = elemVal ? 1 : 0;

			$.ajax({
				url: form.prop('action'),
				type: form.prop('method'),
				data: {
					parentId: parentId,
					elemVal: elemVal
				},
			})
			.done(function( results ) {
				console.log( results );
				if (results.completed == 1) {
					$(parent).addClass('completed');
				} else{					
					$(parent).removeClass('completed');
				};
			})
			.fail(function ( results ){
				console.log( results );
				if ( results.responseText == "Unauthorized." ||  results == 'Unauthorized.' ) {
					location.reload();					
				};	
			});
		});
		
		
		
		/**
		 * Delete all tasks
		 */
		

		$(document).on('click', '#removeAll', function(event) {
			event.preventDefault();

			var elem = $(this);

			bootbox.confirm({
				title: 'Alert!!!', 
				buttons: {
			        'confirm': {
			            label: 'Confirm Remove All Dones',
			            className: 'btn-danger'
			        }
			    },
				message: "This will remove all of your tasks marked as complete, are you sure you want to continue?", 
				callback: function(result) {
					if ( result == true) {
						var parent = $(elem).parents('.well').first(); // Fade the Whole table to 0.5 oppacity
						$(parent).children('table').fadeTo('slow', 0.5);
						$.ajax({
							url: elem.prop('href'),
							type: 'GET',
	        				async: false,
							data: {
								removeAll: true
							},
						}).done(function( results ) {
							if ( results > 0) {
								$.each($('.completed'), function(index, val) {
									 $(val).parents('tr').first().fadeOut();
								});								
								bootbox.alert({
									message:"Your taks has been removed",
									buttons: {
								        'ok': {
								            label: 'OK',
								            className: 'btn-success'
								        }
								    },

								});

							} else{
								bootbox.alert({									
									message:"Seems like you don't have any task marked as completed. Please try again!",
									buttons: {
								        'ok': {
								            label: 'OK',
								            className: 'btn-warning'
								        }
								    }
								});
							};						
						});				
						$(parent).children('table').fadeTo('fast', 1); // return the table to its default fade
					} /* /. If results */				
				}

			});
		});
	});