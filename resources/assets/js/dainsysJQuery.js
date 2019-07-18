(function($) {
    $('document').ready(function(){
        let section = $('section.content').first()
        //turn off autocomplete in all forms
        $(section).find('form').each(function(index, item) {
            $(item).attr('autocomplete', 'off')
        })
        // apply select to all selects
        // $(section).find('select').select2({
        //     theme: "bootstrap"
        // })
        // focus on first element
        $(section).find(':input').filter(':visible:first').focus()
    })
})(jQuery);
