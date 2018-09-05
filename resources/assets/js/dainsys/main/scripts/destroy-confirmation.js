$(document).on('click', 'button[name="deleteBtn"]', function(event) {
	event.preventDefault();
	var parentForm = $(this).parents('form').first();
	
	bootbox.confirm({
	    title: 'Danger, Alert!!!',
	    message: 'This will remove this record from the database. Are you sure you want to continue?',
	    buttons: {
	        'confirm': {
	            label: 'Confirm Delete',
	            className: 'btn-danger'
	        }
	    },
	    callback: function(result) 
	    {	       
			if (result == true) {
				
				$(parentForm).submit();				
				// bootbox.confirm('Last confirmation. Are you realy sure you want to remove this record from the database?', function( result ){
				// 	if ( result == true) {
				// 		$(parentForm).submit();
				// 	};
				// });
			} 
	    }
	});	
});


// var Delete = function(options) {
// 	mergeOptions: {
		
// 	}, 

// 	init: function(){

// 	},

// 	options: {
		
// 	}
// }

// Delete.init();