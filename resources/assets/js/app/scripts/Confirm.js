export default {
	defaults: {
		message: "Are you sure?",
		title: "Please proceede carefully!",
        label: 'Delete',
        className: 'btn-danger'
	},
	confirmed: false,
	destroyConfirmation: function(callBack, options = null) {
		if (typeof(options) === 'object') {
			$.extend(true, this.defaults, options);
			
		}

		var vm = false;
		bootbox.confirm({ 
		    message: this.defaults.message, 
			title: this.defaults.title,
		    buttons: {
		        confirm: {
		            label: this.defaults.label,
		            className: this.defaults.className
		        }
		    },
		    callback: function(result, callBack){
		    	if (result) callBack
		    }
				    
		});

	}
}