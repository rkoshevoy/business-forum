$(document).ready(function() {
	var cost = $('.cost');
	var costButton = $('.menu__item--modal');
	var costClose = $('.cost__close');


	$(costButton).click(function() {
		$(cost).removeClass('hide');
	})

	$(costClose).click(function() {
		$(cost).addClass('hide');
	})
});