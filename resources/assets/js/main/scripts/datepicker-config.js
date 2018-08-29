/**
 * Search thru every date field and apply the datepicker function
 * @param  {$} $ jquery Object
 */
(function($) {
  $(document).ready(function() {
		$.each($('input[type=date]'), function(index, val) {
			 $(val).datepicker({
			 	format: 'yyyy-mm-dd',
			 	todayHighlight: true,
			 	todayBtn: true,
			});
		});
	});
})(jQuery);