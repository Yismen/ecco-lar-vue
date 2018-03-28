import LoadingStore from './../stores/Loading.js';


export default {
    request: function(request) {
        LoadingStore.commit('show');
        return request;
    },
    response: function (response) {
        LoadingStore.commit('hide');
        switch (response.status) {
            case 401:
                // Internal server error.errors, most likely token error.errors
                bootbox.confirm({
                    message: "Either your session has expired or your request is unauthorized!",
                    buttons: {
                        confirm: {
                            label: '<i class="fa fa-refresh"></i> Reload Window',
                            className: 'btn-primary'
                        },
                        cancel: {
                            label: 'Cancel',
                            className: 'btn-default'
                        }
                    },
                    callback: function (result) {
                        if (result) {
                            window.location.reload();
                        }
                    }
                });

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