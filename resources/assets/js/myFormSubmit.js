/*
 *  Project: Perfor Ajax
 *  Description: Intercepts ajax calls from the given form
 *  Author: Yismen Jorge
 *  License: Free to use
 */

// the semi-colon before function invocation is a safety net against concatenated 
// scripts and/or other plugins which may not be closed properly.
;(function ( $, window, undefined ) {

  // undefined is used here as the undefined global variable in ECMAScript 3 is
  // mutable (ie. it can be changed by someone else). undefined isn't really being
  // passed in so we can ensure the value of it is truly undefined. In ES5, undefined
  // can no longer be modified.

  // window and document are passed through as local variables rather than globals
  // as this (slightly) quickens the resolution process and can be more efficiently
  // minified (especially when both are regularly referenced in your plugin).

  // Create the defaults once
    var pluginName = 'myFormSubmit',
        document = window.document,
        defaults = {
            before: null, // Function: a function to be called before the plugin executes
            callback: null, // Function: a function to be called after the plugin executes
            data: {},
            dataType: null, // (Other values: xml, json, script, or html)
            errorsDiv: '#errors', // the div where error messages will be displayed
            event: 'submit',
            method: 'GET', // Other values: POST
            resetForm: false, //if set to true, the inputs will be cleared.
            renderResults: true, // make it falsie if you will do something with the results
            resultsDiv: '#results', // the Div where the results will be displayed. Useful for htlm requests
            url: null,
        };

  // The actual plugin constructor
    function Plugin( element, options ) {
        this.element = element;

        this.options = $.extend( {}, defaults, options) ;

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    Plugin.prototype = {
        init: function() { 
            var _that = this;

            $(this.element).on(this.options.event, function(event) {
                if (typeof _that.options.before =='function') {
                    _that.before();
                }
                var el = this;

                event.preventDefault();

                _that._setUrlProp();
                _that._setMethodProp();
                _that._setDataProp();
                _that._setDivs();
                $(el).fadeTo('slow', 0.3);
                $('#results').fadeTo('slow', 0.3);

                _that.getResults(_that.getData()).then(function(response){
                    if (typeof _that.options.callback =='function') {
                        _that.callback();
                    }

                }, function(errors) {
                    
                }).always(function(){
                    $(el).fadeTo('slow', 1);
                    $('#results').fadeTo('slow', 1);
                });
                                    
            });
            
        },

        _setDivs: function(){
            var element =  $(this.element)
            var hasErrorDiv = $('div#errors').first().length;
            var hasResultsDiv = $('div#results').first().length;

            if (hasErrorDiv == 0) {
                element.before('<div class="row"><div class="col-sm-12" id="errors"></div></div>');
            }
            if (hasResultsDiv == 0) {
                element.after('<hr><div class="row"><div class="col-sm-12" id="results"></div></div>');
            }
        },

        _setUrlProp: function() {
            // you can get a form or the url itself.
            var url = this.options.url;

            if(url) {
                return this.options.url = url;
            }

            return this.options.url = $(this.element).prop('action');
        },

        _setMethodProp: function() {
            return this.options.method = $(this.element).prop('method');
        },

        _setDataProp: function() {
            return this.options.data = $(this.element).serializeArray();
        },

        getData: function() {

            var options = this.options;

            return $.ajax({
                url: options.url,
                type: options.method,
                dataType: options.dataType,
                data: options.data,
            });                              
            
        },

        getResults: function (response) {
            var _that = this;
            /**
             * Reset the submitted form.
             */
            if (this.options.resetForm) {$(this.element)[0].reset()}

            /**
             * proceed with the ajax methods
             * return a promise
             */
            return response
                .success(function(response){

                    _that.handleSuccess(response);

                }).error(function(errors){                           
                    var errorCode = errors.status;
                    var errorsObject = _that.parseErrorsObjet(errors); 
                    /**
                     * Validation errors
                     */
                    if (errorCode == 422) {
                        _that.displayValidationErrors(errorsObject);
                    }

                    /**
                     * Validation errors
                     */
                    if (errorCode == 404) {
                        _that.displayValidationErrors(errorsObject);
                    }
                });
        },

        clearErrorsDiv: function(){
            return $(this.options.errorsDiv).fadeOut('slow', function(){
                $(this).html('');
            });
        },

        handleSuccess: function(response) {
            this.clearErrorsDiv();
            if (this.options.renderResults == true) {
                return this.showHtmlSuccess(response);                
            }
            return response;
        },

        showHtmlSuccess: function(successHtml) {
            return $(this.options.resultsDiv).fadeIn('slow', function() {
                $(this).html(successHtml);
            });
        },

        parseErrorsObjet: function(errors) {
            // errorsObject = errors.responseJson;
            // we have json, just return it
            if (errors.responseJson != undefined) { return errors.responseJson; }

            //we have text, parse it to json
            if (errors.responseText != undefined) { 
                try {
                    return $.parseJSON(errors.responseText);
                } catch(e) {
                    return {response: errors.statusText}
                }
            }
        },

        displayValidationErrors: function(errorsObject) {
            var htmlOuput = '<div class="col-sm-12">';
            
            htmlOuput += '<div class="alert alert-danger">';
            htmlOuput += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            htmlOuput += '<strong>Craps! </strong>';
            htmlOuput += '<ul>';

            $.each(errorsObject, function(index, val) {
                htmlOuput += '<li>';
                htmlOuput += val;                        
                htmlOuput += '</li>';
            });

            htmlOuput += '</ul>';
            htmlOuput += '</div>';
            htmlOuput += '</div>';

            return $(this.options.errorsDiv).fadeIn('slow', function() {
                $(this).html(htmlOuput);
            }); 
                    
        }, 

        before: function() {
            return this.options.before.call(this);
        },

        callback: function(){
            return this.options.callback.call(this);
        },
        
    };

  // A really lightweight plugin wrapper around the constructor, 
  // preventing against multiple instantiations
    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new Plugin( this, options ));
            }
        });
    }

}(jQuery, window));