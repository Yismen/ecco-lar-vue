 
jQuery(document).ready(function($) {
    $(document).on('click', '.refresh-wrapper', function(event) {
        event.preventDefault();
        location.reload();
    });
});