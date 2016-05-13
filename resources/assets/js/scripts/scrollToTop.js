 
$(function(){
 
    $(document).on( 'scroll', function(){
 
        if ($(window).scrollTop() > 100) {
            $('.scroll-top-wrapper').addClass('show');
        } else {
            $('.scroll-top-wrapper').removeClass('show');
        }

        // var cHeight = $('.navber').first().height()
        // console.log(cHeight);
        // if ($(window).scrollTop() > 50) {
        //     $('.navbar-static-top').addClass('navbar-fixed-top ');
        // } else {
        //     $('.navbar-static-top').removeClass('navbar-fixed-top ');
        // }

    });
 
    $('.scroll-top-wrapper').on('click', scrollToTop);
});
 
function scrollToTop() {
    verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
    element = $('body');
    offset = element.offset();
    offsetTop = offset.top;
    $('html, body').animate({scrollTop: offsetTop}, 200, 'linear');
}