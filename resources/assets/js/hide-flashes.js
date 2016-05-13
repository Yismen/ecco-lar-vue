(function($) {
  $(document).ready(function() {
		$.each($('.dismiss'), function(index, val) {
			 $(val).delay(5000).slideUp();
		});
	});
})(jQuery);