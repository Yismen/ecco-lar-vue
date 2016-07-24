/**
 * Search thru every date field and apply the datepicker function
 * @param  {$} $ jquery Object
 */
(function($) {
  	$(document).ready(function() {

  		/**
  		 * Apply iCheck plugin to all the inputs.
  		 * The plugin will select the checkboxes and radios.
  		 */
		$.each($('input'), function(index, val) {
			 $(val)
			 	.iCheck({
				    checkboxClass: 'icheckbox_square-blue',
				    radioClass: 'iradio_square-blue'
				 });
			 	
		});

  		/**
  		 * Apply select2 plugin to all the selects.
  		 */
		$.each($('select'), function(index, val) {
             $(val)
                .select2({
                    theme: "bootstrap",
                    allowClear: true,
                    placeholder: 'Select an option',
                    dropdownAutoWidth: 'true',
                });
                
        });
	});
})(jQuery);