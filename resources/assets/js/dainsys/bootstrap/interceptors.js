import LoadingStore from './../core/stores/Loading.js';


export default {
    request: function(request) {
        LoadingStore.commit('show');
        return request;
    },
    response: function (response) {
        LoadingStore.commit('hide');
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
    },

}