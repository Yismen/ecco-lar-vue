import Store from './../store'
// import bootbox from 'bootbox';
//

axios.interceptors.sweetAlert = function(type, title, text) {
    Vue.swal({
        type: type,
        title: title,
        text: text,
        toast: true,
        showConfirmButton: false,
        position: 'top-end',
        timer: 10000,
        background: type == 'error' ? '#F2DEDE' : '#FCFCFC',
        padding: '5em',
    })
}

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

    // axios.interceptors.sweetAlert('success', 'Well Done!', "Process Completed!")

    return response;
}, function (error) {
    // Do something with response error
    let response = error.response;

    axios.interceptors.sweetAlert('error', 'Ohh Crap!', response.data.message)

    if(response.status == 405) {
        return window.location.assign(response.responseURL)
    }

    Store.dispatch("loading",["hideLoadingSpinner"]);

    return Promise.reject(error);
});
