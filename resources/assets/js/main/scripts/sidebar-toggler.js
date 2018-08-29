/**
 * Use jQuery to hide the bar when the document loads;
 */
hideSideBar($('#main-wrapper'), 'menu-hidden');

/**
 * Triger the functions when the buttons are clicked
 */
$(document).on('click', '#toggler', function(event) {
	event.preventDefault();
	var element = $('#main-wrapper');
	var tClass = 'menu-hidden';

	// $(element).toggleClass(tClass, 1000);
	toggleAnimated(element, tClass);
});

function showSideBar(element, tClass) {
	// Menu is hidden, show it
		$('.main-content').animate({
			width: '80%'},
			0, function() {
				$(element).removeClass(tClass);
				$('.side-menu')
					.css('display', 'inline-block')
					.animate({width: '20%'}, 300);
		});		
}

function hideSideBar(element, tClass){
	$('.side-menu').animate({
			width: '-1px'},
			300, function() {
				$(element).addClass(tClass);;
				$('.main-content').animate({width: '100%'}, 0);
				$(this).css('display', 'none')
			/* stuff to do after animation is complete */
		});
}

function toggleAnimated( element, tClass) {
	if ($(element).hasClass(tClass)) {
		showSideBar(element, tClass);
	} else{
		// Menu is vissible, hide it
		hideSideBar(element, tClass);				
	}
}

	