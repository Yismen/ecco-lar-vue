import Store from './../store'
// import bootbox from 'bootbox';

axios.interceptors.request.use(function (config) {
    /**
     * Shodo the The Spinner
     */
    Store.dispatch("loading/showLoadingSpinner");
    /**
     * Continue with the request
     */
    return config;
}, function (error) {
    Store.dispatch("loading/hideLoadingSpinner");
    // Do something with request error
    return Promise.reject(error);
});

axios.interceptors.response.use(function (response) {
    Store.dispatch("loading/hideLoadingSpinner");
    return response;
}, function (error) {
    // Do something with response error
    let response = error.response;
    if(response.status == 403) {
        Vue.swal({
            type: 'error',
            title: 'Rejected',
            text: response.data.message
        })
    }
    if(response.status == 405) {
        return window.location.assign(response.responseURL)
    }
    Store.dispatch("loading/hideLoadingSpinner");
    return Promise.reject(error);
});