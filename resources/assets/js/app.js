/**
 * Search thru every date field and apply the datepicker function
 * @param  {$} $ jquery Object
 */
(function($) {

    // $.fn.dataTable.ext.errMode = 'none';
    
    $('.main-spinner').hide();

  
  /**
   * Focus the cursor on the first input
   * @type {[type]}
   */
  $('form').first().find(':input').filter(':visible:first').focus();

	$.each($('select,input,textarea'), function(index, val) {
      var el = $(val);
      var elType = $(el).prop('localName');
      var inputType = $(el).prop('type');

      /**
       * Apply datetimepicker plugin to all the input with the type of date in the app
       */
      if(inputType == 'datetime-local') {
        $(el).prop('type', "text");
        el.datetimepicker({
          format: 'YYYY-MM-DD HH:mm:ss',
        });
      }

      /**
       * Apply datepicker plugin to all the input with the type of date in the app
       */
      if(inputType == 'date') {
        $(el).prop('type', "text");
        el.datepicker({
          format: 'yyyy-mm-dd',
          todayHighlight: true,
          todayBtn: true,
        });
      }

     if(inputType == 'time') {
        $(el).prop('type', "text");
        el.timepicker({
            showMeridian: false
        });
      }

      /**
       * Apply select2 plugin to all the selects in the app
       */
      if(elType == 'select') {
        el.select2({
          theme: "bootstrap",
          allowClear: true,
          placeholder: 'Select an option',
          width: '100%'
        });
      }

      /**
       * Apply iCheck plugin to all the inputs in the app.
       * The plugin will only pick checkboxes and radios
       */
      if(elType == 'input') {
        el.iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue'
        });
      }

      /**
       * Apply summernote plugin to all the textareas in the app
       */
      if(elType == 'textarea') {
        el.summernote();
      }
            
    });
})(jQuery);