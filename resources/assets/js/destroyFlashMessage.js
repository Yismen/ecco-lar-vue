(function($) {
  $(document).ready(function() {
		$.each($('.dismiss'), function(index, val) {
			 $(val).delay(10000).slideUp();
		});
	});
})(jQuery);