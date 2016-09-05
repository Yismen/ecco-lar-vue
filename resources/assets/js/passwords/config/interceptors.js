export default {

    request: function (request) {
        return request;
    },

    response: function (response) {
    	switch (response.status){
    		case 401: 
    			// User is no authorized.
    			// location.reload();
                console.log(response);
                window.location.assign("/admin/login");
    			break;

    		case 404:
    			// Api route requested was not found
                console.log(response);
    			this.response_errors = response.statusText;
    			break;

    		case 405:
    			// Api returned method is not allowed
                console.log(response);
    			this.response_errors = response.statusText;
    			break;
    			
    		case 422:
    			// Validation Errors in the backend
                console.log(response);
    			this.response_errors = response.statusText;
    			break;
    			
    		case 500:
    			// Internal server error, most likely token error
                console.log(response);
                window.location.assign("/admin/login");
    			this.response_errors = response.statusText;
    			break;
            case 200:
                break;
    	}
        return response;
    }

}