;(function($){
    /**
     * Config all ajax requestes before they are executed.
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        beforeSend: function(xhr) {

            // $('.main-spinner').parent('.content').hide();
            $('.main-spinner').show();

            // attacheBearer(xhr);
           
        },//beforeSend
      /**
       * This is executed once the ajax request is completed
       */
       complete: function(xhr) {
            // Interact with the ajax response.
            switch (xhr.status) {
                case 401:
                    reloadPage();
                    break;

                case 500:
                    // bootbox.alert({
                    //     "message": "<h4>An error ocurred in the backend. Please contact the adminitrator.</h4>"
                    // }); 
                    
                    reloadPage();
                    break;

                case 501: 
                    bootbox.alert(xhr.status);
                    console.log("501 error: ", xhr);
                    break;
            }

            // $('.main-spinner').parent('.content').show();
            $('.main-spinner').hide();
        //complete
        }
    });

    function reloadPage() {
        bootbox.dialog({
            message: "<h4>Oups. Looks like you are not logged in. Click ok to be redirected to home page!</h4>",
            buttons: {
                'Refresh your session! <i class="fa fa-refresh"></i>': {
                    onEscape: function() {},
                    className: 'btn-warning',
                    callback: function() {
                        window.location.reload();
                    }
                },
            }
        });
    }

    function attacheBearer(xhr) {
         console.log("before it sends: ");

            var xsrf;
            var tokenName = 'XSRF-TOKEN';

            if (localStorage.getItem(tokenName)) {xsrf = localStorage.getItem(tokenName)}
            if (sessionStorage.getItem(tokenName)) {xsrf = sessionStorage.getItem(tokenName)}
            if (Cookies.get(tokenName)) {xsrf = Cookies.get(tokenName)}

            xhr.setRequestHeader('Authorization', 'Bearer ' + xsrf);
    }
})(jQuery);