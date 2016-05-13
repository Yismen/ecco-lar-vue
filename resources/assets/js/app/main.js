var Vue = require('vue');
window.Vue = Vue;
/**
 * Required Components
 */
var NbaComponent = require('./components/Nba.vue');
var TaskComponent = require('./components/Task.vue');

/**
 * Require Libraries
 */
var VueResource = require('vue-resource');
// var progress = require('./app.js');

/**
 * Libraries to use. These libraries are added as part of the constructor.
 * Whithin the instance they can be referenced with the 'this' key
 */
Vue.use(VueResource);
// Vue.use(progress);

/**
 * Configuration session
 */
Vue.config.debug = true // Comment this line for production

Vue.http.interceptors.push({

    request: function (request) {
    	console.log(Vue.loadingResource)
        return request;
    },

    response: function (response) {
    	console.log('Response:', response);
    	switch (response.status){

    		case 401: 
    			// User is no authorized.
    			Vue.response_errors = response.statusText;
    			break;

    		case 404:
    			// Api route requested was not found
    			Vue.response_errors = response.statusText;
    			break;

    		case 405:
    			// Api returned method is not allowed
    			Vue.response_errors = response.statusText;
    			break;
    			
    		case 422:
    			// Validation Errors in the backend
    			Vue.response_errors = response.statusText;
    			break;
    			
    		case 500:
    			// Internal server error, most likely token error
    			Vue.response_errors = response.statusText;
    			break;
    	}

    	// this.loadingResource = false;
        return response;
    }

});

 
new Vue({
	el: 'body', 

	data: {
		response_errors: null,
		loadingResource: null
	},

	components: {
		nba: NbaComponent,
		tasks: TaskComponent,
		// progress: progress
	},

	ready: function() {
		// console.log()
	}

});