/*
 *  Project: navToggler
 *  Description: toggle the navbar when the window is scrolled
 *  Author: Yismen Jorge
 *  License: Free 
 */

// the semi-colon before function invocation is a safety net against concatenated 
// scripts and/or other plugins which may not be closed properly.
;(function ( $, window, undefined ) {

  // Create the defaults once
  var pluginName = 'navToggler',
      document = window.document,
      defaults = {
		previousScroll: 0, //initiate the previousScroll value 
		headerOrgOffset: 0, //size of the navbar
		togglerClass: 'navbar-fixed-top',
		showEffect: 'fadeIn',
		hideEffect: 'fadeOut',
		effectSpeed: 'fast'
      };

  // The actual plugin constructor
  function Plugin( element, options ) {
    this.element = element;

    // jQuery has an extend method which merges the contents of two or 
    // more objects, storing the result in the first object. The first object
    // is generally empty as we don't want to alter the default options for
    // future instances of the plugin
    if ( typeof(options) == 'string') {
		this.defaults.togglerClass = options ;
    } else{
    	this.options = $.extend( {}, defaults, options) ;
    };

    this._defaults = defaults;
    this._name = pluginName;

    this.init();
  };

  Plugin.prototype.init = function () 
  {
    // Place initialization logic here
    // You already have access to the DOM element and the options via the instance, 
    // e.g., this.element and this.options
    // 
    if (this.options.effectSpeed != 'fast' && this.options.effectSpeed != 'slow' && this.options.effectSpeed < 0 ) {
    	this.options.effectSpeed = 'fast';
    };

   	this.scrollFunction(this);

  };

  Plugin.prototype.scrollFunction = function (obj) 
  {  	
     $(window).scroll(function() {
        var currentScroll = $(this).scrollTop();
        var opts = obj.options;
        var elem = obj.element;
        console.log("Current scroll: " + currentScroll + ", Previous scroll: " + opts.previousScroll + ", Navbar size: " + opts.headerOrgOffset);
        if(currentScroll > opts.headerOrgOffset) {
             $(elem).addClass(opts.togglerClass);
        } else {
             $(elem).removeClass(opts.togglerClass);
        }



        if (currentScroll > opts.previousScroll) {
          $(elem)[opts.hideEffect](opts.effectSpeed);
        } else {
          $(elem)[opts.showEffect](opts.effectSpeed);
            // $(elem)[opts.showEffect](opts.effectSpeed);
            // $(elem).addClass(opts.togglerClass);
        }
        opts.previousScroll = currentScroll;
    });
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