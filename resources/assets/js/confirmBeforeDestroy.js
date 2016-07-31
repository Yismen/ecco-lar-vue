(function($){
	$(document).ready(function() {
		$('button[name="deleteBtn"]').on('click', function(event) {
			event.preventDefault();
			var parentForm = $(this).parents('form').first();
			
			bootbox.confirm({
			    title: 'Danger, Alert!!!',
			    message: 'Are you sure you want to delete this record?',
			    buttons: {
			        'confirm': {
			            label: 'Favor Confirmar',
			            className: 'btn-danger'
			        }
			    },
			    callback: function(result) 
			    {	       
					if (result == true) {
						
						$(parentForm).submit();	
					} 
			    }
			});	
		});
	});
})(jQuery);