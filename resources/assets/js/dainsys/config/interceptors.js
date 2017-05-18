export default {
    response: function (response) {
        console.log(response)
    	switch (response.status){
    		case 401:
    			// User is no authorized.
    			break;

    		case 404:
                // Route not found
    			break;

    		case 405:
    			// Api returned method is not allowed
    			break;
    			
    		case 422:
                // Validations error on the backend
                // console.log(form.error.errors)
                // return form.error.record(response.data);
                // console.log(form.error.errors)
    			break;
    			
    		case 500:
    			// Internal server error.errors, most likely token error.errors
                bootbox.confirm({
                    message: "An error ocurred at the backend. Reload the window?",
                    buttons: {
                        confirm: {
                            label: 'Yes',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-default'
                        }
                    },
                    callback: function (result) {
                        if(result) {
                             window.location.reload();
                        }
                    }
                });
    			break;
            case 200:
                // Positive response. Just continue to execute.
                break;
    	}
        return response;
    }

}