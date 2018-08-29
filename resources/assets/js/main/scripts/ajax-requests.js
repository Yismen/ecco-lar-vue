	(function($) {
	// perform ajax requests, return success or fail
	$.fn.ajaxRequest = function(options) {
	
	  if (!this.length) { return this; }
	
	  var opts = $.extend(true, {}, $.fn.ajaxRequest.defaults, options);
	
	  this.each(function() {
	    var $this = $(this);
	    // $this.preventDefault();
	    console.log($this);
	    $(document).on('submit', $this, function(event) {
	    	event.preventDefault();
	    	/* Act on the event */
	    	var ajax = $.ajax({
		    	url: $this.prop('action'),
		    	type: $this.prop('method'),
		    	dataType: opts.requestType,
		    	data: $this.serializeArray(),
		    })
		    .success(function(data) {
		    	if (opts.requestType == 'html') {
		    		$('#errors-div').remove(); // remove the errors
			    	$('#results').remove(); // remove previous existence of results
			    	$this.after('<hr/><div id="results"></div>'); // add new instance of results
			    	$('#results').html(data); // append the data to the results
			    	console.log($this);
			    	console.log("success" + data);
		    	} else if (opts.requestType == 'json' ) {
		    		return data;
		    	};

		    	//grag the destination container, use the form-parent if nothing provided
		    	//if result is html, addit, else return the json data

		    })
		    .fail(function(data) {

		    	$this.prepend(opts.errorTemplateOpen + 'Errors List' + opts.errorTemplateClose)

		    	console.log("fail ");
		    	console.log(data);
		    })
		    .then(function(data) {
		    	console.log("complete = " + opts.requestType);
		    });
	    });
		    
	    
	    	
	  });
	
	  return this;
	};
	
	// default options
	$.fn.ajaxRequest.defaults = {
	  errorTemplateOpen: '<div class="alert alert-warning" id="errors-div">'+
	  	'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
	  	'<strong>Oops!</strong>  There is something wrong with your inputs: ' ,
	  errorTemplateClose: '</div>',
	  requestType: 'html',
	  destinationContainer: this
	};
	
	})(jQuery);
	