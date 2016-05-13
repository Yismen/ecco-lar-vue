$(document).ready(function() {
        $(document)
            .on('submit', '#search_form', function(event) {
                event.preventDefault();
                /* Act on the event */
                var keywords  = $('#search').val();
                var form      = $(this);
                var container = $('.articles-content');

                /**
                 * Call the method
                 */
                up(keywords, container, form, 1);
            })
            .on('keyup', '#search', function(event) {
                event.preventDefault();
                /* Act on the event */
                var keywords  = $(this).val();
                var form      = $('#search_form');
                var container = $('.articles-content');

                /**
                 * Call the method
                 */
                up(keywords, container, form, 500);
            })
            .on('keydown', '#search', function(event) {
                // event.preventDefault();
                
                down();
            });

    function up(keywords, container, form, time)
    {   

        timer = setTimeout(function (){
            // console.log("searching");
            keywords = $.trim(keywords);
            if (keywords == prevKeywords) {
            // if (keywords.length > 0 && keywords == prevKeywords) {
                var data = $(form).serializeArray();
                var url = $(form).prop('action');
                var type = $(form).prop('method');

                $.ajax({
                    url: url,
                    type: type,
                    dataType: 'html',
                    data: data,
                })
                .success(function(results) {
                    // console.log("Success " + results);
                    $(container).html(results);
                    // $(container).fadeOut().html(results).fadeIn();
                })
                .fail(function(results){
                    console.log("Failed" + results)
                });

            };
        }, time);

        console.log("First Time="+ prevKeywords);

        prevKeywords = keywords;

        console.log("second time="+prevKeywords)

    }

    function down()
    {
        clearTimeout(timer);
    }

    var timer;
    var prevKeywords;
    var options = {
        delayTime: 500
    }
});